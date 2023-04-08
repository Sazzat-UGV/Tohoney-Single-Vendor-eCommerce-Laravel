<?php

namespace App\Http\Controllers\Backend;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\testimonialRequest;
use App\Http\Requests\TestimonialStoreRequest;
use App\Http\Requests\TestimonialUpdateRequest;
use Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials=Testimonial::latest('id')->select(['id','client_name','client_name_slug','client_designation','client_message','client_image','updated_at'])->paginate();

        return view('backend.pages.testimonial.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialStoreRequest $request)
    {
        $testimonial=Testimonial::create([
            'client_name'=>$request->client_name,
            'client_name_slug'=>Str::slug($request->client_name),
            'client_designation'=>$request->client_designation,
            'client_message'=>$request->client_message,
            'is_active'=>$request->filled('is_active')

        ]);

        $this->image_upload($request, $testimonial->id);

        Toastr::success('Testimonial Store Successfully!');
        return redirect()->route('testimonial.index');
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
    public function edit($id)
    {
        $testimonial=Testimonial::whereclient_name_slug($id)->first();
        return view('backend.pages.testimonial.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialUpdateRequest $request, string $id)
    {
        $testimonial=Testimonial::whereclient_name_slug($id)->first();
        $testimonial->update([
            'client_name'=>$request->client_name,
            'client_name_slug'=>Str::slug($request->client_name),
            'client_designation'=>$request->client_designation,
            'client_message'=>$request->client_message,
            'is_active'=>$request->filled('is_active')
        ]);

        $this->image_upload($request, $testimonial->id);
        Toastr::success('Testimonial Update Successfully!');
        return redirect()->route('testimonial.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial=Testimonial::whereclient_name_slug($id)->first();
        if($testimonial->client_image != 'default-client.jpg'){
            //delete old photo
            $photo_location='public/uploads/testimonial/';
            $old_photo_location=$photo_location .$testimonial->client_image;
            unlink(base_path($old_photo_location));
        }
        $testimonial->delete();
        Toastr::success('Testimonial Delete Successfully!');
        return redirect()->route('testimonial.index');

    }


    public function image_upload($request, $item_id){
        $testimonial=Testimonial::findorFail($item_id);

        if($request->hasFile('client_image')){
            if($testimonial->client_image != 'default-client.jpg'){
                //delete old photo
                $photo_location='public/uploads/testimonial/';
                $old_photo_location=$photo_location .$testimonial->client_image;
                unlink(base_path($old_photo_location));

            }
                $photo_loation='public/uploads/testimonial/';
                $uploaded_photo=$request->file('client_image');
                $new_photo_name=$testimonial->id .'.'.$uploaded_photo->getClientOriginalExtension();
                $new_photo_location= $photo_loation. $new_photo_name;
                Image::make($uploaded_photo)->resize(105,105)->save(base_path($new_photo_location),40);
                $check=$testimonial->update([
                    'client_image'=>$new_photo_name,
                ]);

        }
    }
}
