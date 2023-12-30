<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        //$category=Category::all();                                                       // to get all data
        //$category=Category::paginate(2);                                                 // to get all data paginted
        //$category=Category::latest()->paginate(2);

        //$category=$query->get();                                                       // to Get all data
        //$category=$query->paginate(2);                                                 // to Paginate data using query


        //$category=Category::active()->paginate();                                       // Local Scope active ()

        $category=Category::with(["products","parent"])
        // ->withCount("products")
        ->withCount([
            "products"=> function ($query) {
                $query->where("status","active");
            }
        ])
        ->filter(request()->query())
        ->latest()
        ->paginate(5);    // Local Scope filter ()

        //$category=Category::latest()->paginate(3);  //Global Scope


        $category_number=count(Category::all());  // to Get the number of all categories
        return view("adminpanel.categories.index",compact("category","category_number"));
    }

    public function create()
    {
        $parent=Category::all();
        $category=new Category();
        return view("adminpanel.categories.create",compact("parent","category"));
    }

    public function store(Request $request)
    {
        // 1- Validation
        $request->validate(Category::rules());

        // 2- Adding Slug
        $request->merge([
            "slug"=>Str::slug($request->name)]);

        // 3- Exepting the request image, and allow all
        $data=$request->except("image");

        // 4- Add the path to the request
        $data['image']=$this->uploadimage($request);

        // 5- Save the request into DB
        Category::create($data);

        return redirect()->route("categories.index")->with("success","Category Add Successfully");
    }

    public function show(Category $category)
    {

        return view("adminpanel.categories.show",compact("category"));
    }

    public function edit(string $id)
    {
        $category= Category::findOrFail($id);
        //$parent= Category::where("id","<>",$id)->where("parent_id","=",$id)->get();
        $parent= Category::where("id","<>",$id)->where(function ($query) use ($id)
        {
            $query->whereNull("parent_id")->orWhere("parent_id","<>",$id);
        })->get();
        return view("adminpanel.categories.edit",compact("category","parent"));
    }


    public function update(CategoryRequest $request, string $id)
    {
        // 1- Validation
        //$request->validate(Category::rules($id));

        // 2- Find The Category
        $category= Category::findorFail($id);

        // 3- Get the Old Path of the image
        $old_image=$category->image;

        // 4- Exepting the request image, and allow all
        $data=$request->except("image");

        // 5- Get the New Path of the image
        $new_image_path=$this->uploadimage($request);
        if ($new_image_path)
        {
            $data["image"]=$new_image_path;
        }

//        if ($request->hasFile("image"))
//        {
//            $file=$request->file("image");
//            $path = $file->store("category","public");
//            $data['image']=$path;
//        }

        $category->update($data);

        if ($old_image && $new_image_path)
        {
            Storage::disk("public")->delete($old_image);
        }

        return redirect()->route("categories.index")->with("success","Category Updated Successfully");
    }

    public function destroy(string $id)
    {
        $category= Category::findorFail($id);
        $category->delete();
        //$old_image=$category->image;
//        if ($category->image)
//        {
//            Storage::disk("public")->delete($old_image);
//        }
        return redirect()->route("categories.index")->with("success","Category Deleted Successfully");
    }
    protected function uploadimage(Request $request)
    {
        if (!$request->hasFile("image"))
        {
            return;
        }
        $file=$request->file("image");
        $path = $file->store("category","public");
        return $path;
    }

    public function trashed()
    {
        $category=Category::onlyTrashed()->filter(request(["name","status"]))->latest()->paginate();
        $category_number=count(Category::onlyTrashed()->get());  // to Get the number of all categories

        return view("adminpanel.categories.trashed",compact("category","category_number"));

    }
    public function restore($id)
    {

        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route("categories.index")->with("success","Category Restored Successfully");
    }
    public function forceDelete($id)
    {
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        $old_image=$category->image;
        if ($category->image)
        {
            Storage::disk("public")->delete($old_image);
        }
        return redirect()->route("categories.trashed")->with("success","Category Deleted Successfully");
    }
}
