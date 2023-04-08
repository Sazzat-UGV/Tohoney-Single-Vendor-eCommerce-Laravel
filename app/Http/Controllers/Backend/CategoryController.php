<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories=Category::latest('id')->select(['id','category_image','title','slug','updated_at'])->paginate();
       return view('backend.pages.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category=Category::create([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title)
        ]);

        $this->image_upload($request, $category->id);
        Toastr::success('Category Store Successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $category=Category::whereSlug($slug)->first();
        return view('backend.pages.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $slug)
    {
        $category=Category::whereSlug($slug)->first();
        $category->update([
            'title'=>$request->title,
            'slug'=>Str::slug($request->title),
            'is_active'=>$request->filled('is_active')
        ]);
        $this->image_upload($request, $category->id);
        Toastr::success('Category Update Successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $category=Category::whereSlug($slug)->first();
        if($category->category_image != 'default-image.jpg'){
            //delete old photo
            $photo_location='public/uploads/category/';
            $old_photo_location=$photo_location .$category->category_image;
            unlink(base_path($old_photo_location));

        }
        $category->delete();

        Toastr::success('Category Deleted Successfully!');
        return redirect()->route('category.index');
    }

    public function image_upload($request, $item_id){
        $category=Category::findorFail($item_id);

        if($request->hasFile('category_image')){
            if($category->category_image != 'default-image.jpg'){
                //delete old photo
                $photo_location='public/uploads/category/';
                $old_photo_location=$photo_location .$category->category_image;
                unlink(base_path($old_photo_location));

            }
                $photo_loation='public/uploads/category/';
                $uploaded_photo=$request->file('category_image');
                $new_photo_name=$category->id .'.'.$uploaded_photo->getClientOriginalExtension();
                $new_photo_location= $photo_loation. $new_photo_name;
                Image::make($uploaded_photo)->resize(300,260)->save(base_path($new_photo_location),40);
                $check=$category->update([
                    'category_image'=>$new_photo_name,
                ]);

        }
    }
}
