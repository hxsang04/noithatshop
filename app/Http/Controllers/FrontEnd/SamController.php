<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SamController extends Controller
{
    public function Logout(){
        Auth::logout();

        return redirect()->route('home.index');
    }

    public function Contact(){
        return view('User.contact');
    }
}
