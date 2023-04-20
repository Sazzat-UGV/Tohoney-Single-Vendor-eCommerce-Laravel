<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{



    public function home(){
        $testimonials=Testimonial::where('is_active', 1)->latest('id')->limit(3)->select(['id','client_name','client_designation','client_message','client_image'])->get();

        $categories=Category::where('is_active',1)->latest('id')->limit(5)->select(['id','title','slug','category_image'])->get();

        $products=Product::where('is_active',1)->latest('id')->select(['id','name','slug','product_price','product_stock','product_rating','product_image'])->paginate(12);

        $latest_product=Product::where('is_active',1)->latest('product_rating')->select(['id','name','product_price','product_rating','product_image'])->paginate(4);
        return view('frontend.pages.home',compact('testimonials','categories','products','latest_product'));
    }




    public function shopPage(){
        $allproduct=Product::where('is_active',1)->latest('id')->select(['id','name','slug','product_price','product_stock','product_rating','product_image'])->paginate(12);

        $categories=Category::where('is_active',1)->with('products')->latest('id')->limit(5)->select(['id','title','slug'])->get();

        return view('frontend.pages.shop',compact('allproduct','categories'));
    }




    public function productdetails($product_slug){
        $product=Product::whereSlug($product_slug)->with('category','product_images')->first();

        $releted_product=Product::whereNot('slug',$product_slug)->select(['id','name','slug','product_price','product_image'])->limit(4)->get();

        return view('frontend.pages.single-product',compact('product','releted_product'));
    }
}
