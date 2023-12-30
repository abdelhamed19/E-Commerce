<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $products = Product::latest()->filter(request(["name","status"]))->paginate(10);
        $allproducts = Product::all();
        return view("adminpanel.products.index", compact("products","allproducts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product=new Product();
        $stores=Store::all();
        $categories=Category::all();
        return view("adminpanel.products.create", compact("product","stores","categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             // 1- Validation
             $request->validate(Product::rules());

             // 2- Adding Slug
             $request->merge([
                 "slug"=>Str::slug($request->name),
                 "store_id"=>Auth::user()->id]);
     
             // 3- Exepting the request image, and allow all
             $data=$request->except("image");
     
             // 4- Add the path to the request
             $data['image']=$this->uploadimage($request);
     
             // 5- Save the request into DB
             Product::create($data);
     
             return redirect()->route("products.index")->with("success","Category Add Successfully");
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
        $product = Product::findorFail($id);
        $stores=Store::all();
        $categories=Category::all();
        return view("adminpanel.products.edit", compact("product","stores","categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
    {
        // 1- Validation
        $request->validate(Product::rules($product->id));

        // 2- Get the Old Path of the image
        $old_image=$product->image;

        // 3- Exepting the request image, and allow all
        $data=$request->except("image");

        // 5- Get the New Path of the image
        $new_image_path=$this->uploadimage($request);
        if ($new_image_path)
        {
            $data["image"]=$new_image_path;
        }

        $product->update($data);

        if ($old_image && $new_image_path)
        {
            Storage::disk("public")->delete($old_image);
        }
        return redirect()->route("products.index")->with("success","Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product= Product::findorFail($id);
        $product->delete();
        $old_image=$product->image;
       if ($product->image)
       {
           Storage::disk("public")->delete($old_image);
       }
        return redirect()->route("products.index")->with("success","Product Deleted Successfully");
    }
    protected function uploadimage(Request $request)
    {
        if (!$request->hasFile("image"))
        {
            return;
        }
        $file=$request->file("image");
        $path = $file->store("product","public");
        return $path;
    }
}
