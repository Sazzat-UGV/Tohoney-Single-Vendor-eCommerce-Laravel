<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Customercontroller extends Controller
{
    public function dashboard(){
        $user=Auth::user();
        return view('frontend.pages.customer-dashboard',compact('user'));
    }
}
