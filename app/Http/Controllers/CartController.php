<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(){
        $cart = session()->get('cart', []);
        return view('user.cart',compact('cart'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        $productWithImg = Product::with(['images' => function ($query) {
            $query->where('cover', true);
        }])->findOrFail($product->id);;
    
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        }else{
            $cart[$product->id] = [
                'product'=>$productWithImg,
                'quantity' => 1
            ];
        };

        session(['cart' => $cart]);
        
        return redirect()->back()->with('success','product added successfully to Cart');
    }

    public function removeFromCart(Product $product){
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);
        return redirect()->back();
    }

    public function changeQuantity($id,Request $request){
        $cart = session()->get('cart',[]);
        $cart[$id]['quantity'] = $request->quantity;
        $subTotal = $cart[$id]['quantity'] * $cart[$id]['product']->sale_price;
        $total = 0;

        foreach($cart as $item){
            $total+=  $item['quantity'] * $item['product']->sale_price;
        }
        
        if(session()->has('coupon')){
            if(session('coupon')->type === 'percentage'){
                $newTotal = (1-(session('coupon')->value/100))*$total;
            }else{
                $newTotal = $total-session('coupon')->value;
            }
        }

        session(['cart' => $cart]);
        return response()->json([
            'message'=>'product quantity changed successfully',
            'subTotal'=>$subTotal,
            'total'=>$total,
            'newTotal'=>$newTotal]);
    }
}
