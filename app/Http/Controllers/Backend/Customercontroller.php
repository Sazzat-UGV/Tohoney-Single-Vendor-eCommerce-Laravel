<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class Customercontroller extends Controller
{
    public function index(){
        $customers=User::where('role_id',2)->select(['id','name','email','phone','created_at'])->latest('id')->paginate();
        return view('backend.pages.customer.index',compact('customers'));
    }

    public function deleteCustomer($email)
    {
       User::whereEmail($email)->delete();
       Toastr::success('Customer Delete Successfully!');
       return redirect()->route('admin.customerlist');
    }
}
