<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class faqController extends Controller
{
    public function faqPage()
    {
       return view('frontend.pages.faq');
    }
}
