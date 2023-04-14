<?php

namespace App\Http\Controllers\Backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\couponStoreRequest;
use App\Http\Requests\couponUpdateRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons=Coupon::latest('id')->paginate();
        return view('backend.pages.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(couponStoreRequest $request)
    {
        Coupon::create([
            'coupon_name'=>$request->coupon_name,
            'discount_amount'=>$request->discount_percentage,
            'minimum_purchase_amount'=>$request->perchase_amount,
            'validity_till'=>$request->validity_till,
            'is_active'=>filled($request->is_active),
        ]);

        Toastr::success('Coupon Added Successfully!');
        return redirect()->route('coupon.index');
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
    public function edit(string $id)
    {
        $coupon=Coupon::find($id);
        return view('backend.pages.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(couponUpdateRequest $request, string $id)
    {
        $coupon=Coupon::find($id);
        $coupon->update([
            'coupon_name'=>$request->coupon_name,
            'discount_amount'=>$request->discount_percentage,
            'minimum_purchase_amount'=>$request->perchase_amount,
            'validity_till'=>$request->validity_till,
            'is_active'=>filled($request->is_active),
        ]);

        Toastr::success('Coupon Update Successfully!');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coupon::find($id)->delete();
        Toastr::success('Coupon Delete Successfully!');
        return redirect()->route('coupon.index');
    }
    
}
