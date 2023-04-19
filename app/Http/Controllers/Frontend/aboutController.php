<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class aboutController extends Controller
{
    public function aboutPage(){
        return view('frontend.pages.about');
    }
}
