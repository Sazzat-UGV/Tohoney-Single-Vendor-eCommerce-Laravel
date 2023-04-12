<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;


class cardController extends Controller
{

    public function cardPage()
    {
        $carts=Cart::content();
        $carts_total=Cart::subtotal();
        return view('frontend.pages.shopping-card',compact('carts','carts_total'));
    }

    public function addTocard(Request $request)
    {
        $product_slug=$request->product_slug;
        $order_quantity=$request->order_quantity;

        $product=Product::whereslug($product_slug)->first();

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->product_price,
            'weight' => 0,
            'product_stock' => $product->product_stock,
            'qty' => $order_quantity,
            'options' => [
                'product_image' => $product->product_image
            ]
        ]);

        Toastr::success('Product Added into Cart');
        return back();
    }

    public function removeFromCard($Card_id){
        Cart::remove($Card_id);
        Toastr::success('Product Removed from Cart!!');
        return back();
    }
}
