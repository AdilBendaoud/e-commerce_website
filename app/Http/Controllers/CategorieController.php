<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index(){
        $categories = Categorie::withCount('products')->get();
        return view('admin.categories',compact('categories'));
    }

    public function store(Request $request){
        $category = new Categorie();
        $category->name = $request->category_name;
        $category->save();
        return back()->with('success', 'category created successfully');
    }

    public function update($id,Request $request){
        $category=Categorie::find($id);
        $category->name = $request->category_name;
        $category->save();
        return back()->with('success', 'category edited successfully');
    }

    public function destroy($id){
        Categorie::destroy($id);
        return back()->with('success', 'category deleted successfully');
    }
}
