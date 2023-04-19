<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\ContactStoreRequest;

class contactController extends Controller
{
    public function contactPage()
    {
        return view('frontend.pages.contact');
    }

    public function contactData(ContactStoreRequest $request)
    {
        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);
        Toastr::success('Your message Sent Successfully!');
        return redirect()->route('contactPage');
    }
}
