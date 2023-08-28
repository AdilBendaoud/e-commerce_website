<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Stripe;
use PragmaRX\Countries\Package\Countries;

class stripeController extends Controller
{
    public function index(){
        $countries = Countries::all()->pluck('name.common')->toArray();
        $cart = session()->get('cart', []);
        return view('user.stripe',compact('countries','cart'));
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $total = (int)$request->total;

        Stripe\Charge::create ([
            "amount" => $total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test"
        ]);

        $address = new ShippingAddress();
        $address->country = $request->country;
        $address->city = $request->city;
        $address->street = $request->street;
        $address->post_code = $request->postCode;
        $address->save();

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->shipping_addresses_id = $address->id;
        $order->order_date = now();
        $order->total = $request->total;
        $order->save();

        $cart = session()->get('cart', []);
        
        foreach($cart as $item){
            $orderProd = new OrderProduct();
            $orderProd->product_id = $item['product']->id;
            $orderProd->order_id = $order->id;
            $orderProd->quantity = $item['quantity'];
        }

        session(['cart'=>[]]);
        if(session()->has('coupon')){
            session()->forget('coupon');
        }
        return back()->with('success', 'Payment successful!');
        
    }

    public function getCities($country){
        $countries = new Countries();
        $cities = $countries->where('name.common', $country)->first()->hydrateCities()->cities->toArray();
        return response()->json(['cities'=>array_keys($cities)]);
    }
}
