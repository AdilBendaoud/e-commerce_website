<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Product $product,Request $request){
        $comment = new Comment();
        $comment->product_id = $product->id;
        $comment->user_id = auth()->user()->id;
        $comment->rating = $request->rating;
        $comment->comment_body = $request->comment_body;
        $comment->save();

        return back()->with('success','review added successfully');
    }
}
