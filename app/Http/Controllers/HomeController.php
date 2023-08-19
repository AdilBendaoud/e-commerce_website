<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
        if(Auth::user()->isAdmin ?? false){
            return view('admin.home');
        }else{
            return redirect()->route('/');
        }
    }

    public function userHome(){
        $products = Product::with(['images' => function ($query) {
            $query->where('cover', true);
        }])->take(4)->get();
        return view('user.home',compact('products'));
    }
}
