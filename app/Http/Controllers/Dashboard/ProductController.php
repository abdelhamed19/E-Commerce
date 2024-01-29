<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductSTore;
use App\Http\Requests\Products\ProductUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user=Auth::user();
        // if($user->store_id)
        // {
        //     $products=Product::where("store_id","=",$user->store_id)->paginate(10);
        // }
        // else
        // {
        // $products = Product::paginate(10);
        // }

        //$products = Product::theproducts()->filter(request(["name","status"]))->paginate(10);
        $products = Product::latest()->filter(request(["name", "status"]))->paginate(10);
        $allproducts = Product::all();
        return view("adminpanel.products.index", compact("products", "allproducts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $stores = Store::all();
        $categories = Category::all();
        return view("adminpanel.products.create", compact("product", "stores", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductSTore $request)
    {
        // 1- Adding Slug
        $request->merge([
            "slug" => Str::slug($request->name),
            "store_id" => Auth::user()->store_id
        ]);

        // 2- Excepting the request image, and allow all
        $data = $request->except("image", "tags");

        if ($request->tags) {
            $tags = json_decode($request->tags);
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate([
                    "slug" => Str::slug($tagName->value),
                    "name" => $tagName->value
                ]);
                $tagIds[] = $tag->id;
            }

            // 3- Add the path to the request
            $data['image'] = $this->uploadImage($request);

            // 4- Save the request into DB
            $product = Product::create($data);
            $product->tags()->sync($tagIds);
        }

        // 5- Add the path to the request
        $data['image'] = $this->uploadImage($request);

        // 6- Save the request into DB
        Product::create($data);

        return redirect()->route("products.index")->with("success", "Category Add Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // dd($product);
        $product->get();
        return view("adminpanel.products.show", compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        // The way
        //$tags=implode(',',$product->tags->pluck("name")->toArray());

        // The details of the way
        $tags = $product->tags->pluck("name")->toArray();
        $tags = implode(",", $tags);


        return view("adminpanel.products.edit", compact("product", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdate $request, Product $product)
    {
        // 1- Get the Old Path of the image
        $old_image = $product->image;

        // 2- Exepting the request image, and allow all
        $data = $request->except("image", "tags");

        // 3- Get the New Path of the image
        $new_image_path = $this->uploadImage($request);
        if ($new_image_path) {
            $data["image"] = $new_image_path;
        }

        $product->update($data);

        $tags = json_decode($request->tags);
        $tagIds = [];
        if ($tags) {
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate([
                    "slug" => Str::slug($tagName->value),
                    "name" => $tagName->value
                ]);
                $tagIds[] = $tag->id;
            }
        }
        $product->tags()->sync($tagIds);

        if ($old_image && $new_image_path)
        {
            Storage::disk("public")->delete($old_image);
        }

        return redirect()->route("products.index")->with("success", "Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findorFail($id);
        $product->delete();
        $old_image = $product->image;
        if ($product->image) {
            Storage::disk("public")->delete($old_image);
        }
        return redirect()->route("products.index")->with("success", "Product Deleted Successfully");
    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile("image")) {
            return;
        }
        $file = $request->file("image");
        $path = $file->store("product", "public");
        return $path;
    }
}
