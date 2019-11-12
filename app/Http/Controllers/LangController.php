<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LangController extends Controller
{
     /**
     * Switch the language
     * 
     * @return redirect()->back()
     */
    public function switchLang(Request $request)
    {
        Session::set('locale', $request->locale);
        return redirect()->back();
    }
    
}