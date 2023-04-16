<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Models\Upazila;
use App\Models\District;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Mail\PurchaseConfirm;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\orderStoreRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckourController extends Controller
{
    public function checkoutPage()
    {
        $carts=Cart::content();
        $total_price=Cart::subtotal();
        $districts=District::select('id','name','bn_name')->get();
        return view('frontend.pages.checkout',compact('carts','total_price','districts'));
    }


    public function loadUpazillaAjax($district_id)
    {
        $upazilas = Upazila::where('district_id', $district_id)->select('id','name')->get();
        return response()->json($upazilas, 200);
    }

    public function placeOrder(orderStoreRequest $request){


        $billing=Billing::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone,
            'district_id'=>$request->district_id,
            'upazila_id'=>$request->upazila_id,
            'address'=>$request->address,
            'order_notes'=>$request->order_note,
        ]);

        $order=Order::create([
            'user_id'=>Auth::id(),
            'billing_id'=>$billing->id,
            'sub_total'=>Session::get('coupon')['cart_total']??round(Cart::subtotalFloat()),
            'discount_amount'=>Session::get('coupon')['discount_amount']?? 0,
            'coupon_name'=>Session::get('coupon')['name'] ?? '',
            'total'=>Session::get('coupon')['balance'] ?? round(Cart::subtotalFloat()),
        ]);

        foreach(Cart::content() as $cartitem){
            OrderDetails::create([
                'order_id' =>$order->id,
                'user_id'=>Auth::id(),
                'product_id'=>$cartitem->id,
                'product_qty'=>$cartitem->qty,
                'product_price'=>$cartitem->price,
            ]);

            Product::findorFail($cartitem->id)->decrement('product_stock',$cartitem->qty);

        }
        Cart::destroy();
        Session::forget('coupon');

        $order=Order::whereId($order->id)->with(['billing','orderdetails'])->get();

        Mail::to($request->email)->send(new PurchaseConfirm(($order)));


        Toastr::success('Your Order Placed successfully!!!', 'Success');
        return redirect()->route('card.page');


    }
}
