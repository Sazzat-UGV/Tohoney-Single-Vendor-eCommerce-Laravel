<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class contactController extends Controller
{
    public function contactIndex()
    {
        $contacts=Contact::latest('id')->select('id','name','email','subject','message','created_at')->paginate();
        return view('backend.pages.contact.index',compact('contacts'));
    }
}
