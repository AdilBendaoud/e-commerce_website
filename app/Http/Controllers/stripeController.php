<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stripeController extends Controller
{
    public function index(){
        return view('user.stripe');
    }
}
