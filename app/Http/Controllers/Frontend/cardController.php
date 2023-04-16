<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class cardController extends Controller
{

    public function cardPage()
    {
        $carts = Cart::content();
        $carts_total = Cart::subtotal();
        return view('frontend.pages.shopping-card', compact('carts', 'carts_total'));
    }

    public function addTocard(Request $request)
    {
        $product_slug = $request->product_slug;
        $order_quantity = $request->order_quantity;

        $product = Product::whereslug($product_slug)->first();

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

    public function removeFromCard($Card_id)
    {
        Cart::remove($Card_id);
        Toastr::success('Product Removed from Cart!!');
        return back();
    }

    public function couponApply(Request $request)
    {
        if (!Auth::check()) {
            Toastr::error('You must need to login first!!!');
            return redirect()->route('login.page');
        }


        $check = Coupon::where('coupon_name', $request->coupon_name)->first();

        // check coupon validity

        //if session got existing coupon, then don't allow double coupon
        if (Session::get('coupon')) {
            Toastr::error('Already applied coupon!!!', 'Info!!!');
            return redirect()->back();
        }

        //if valid coupon found
        if ($check != null) {
            // Check coupon validity
            $check_validity =  $check->validity_till > Carbon::now()->format('Y-m-d');
            // if coupon date is not expried
            if ($check_validity) {
                // check coupon discount type
                Session::put('coupon', [
                    'name' => $check->coupon_name,
                    'discount_amount' => round((Cart::subtotalFloat() * $check->discount_amount) / 100),
                    'cart_total' => Cart::subtotalFloat(),
                    'balance' => round(Cart::subtotalFloat() - (Cart::subtotalFloat() * $check->discount_amount) / 100)
                ]);
                Toastr::success('Coupon Percentage Applied!!', 'Successfully!!');
                return redirect()->back();
            } else {
                Toastr::error('Coupon Date Expire!!!', 'Info!!!');
                return redirect()->back();
            }
        } else {
            Toastr::error('Invalid Coupon! Check, Empty Cart');
            return redirect()->back();
        }
    }



    public function removeCoupon($coupon_name)
    {
        Session::forget('coupon');
        Toastr::success('Coupon Removed', 'Successfully!!');
        return redirect()->back();
    }
}
