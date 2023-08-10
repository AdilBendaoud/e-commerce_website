<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.orders',compact('orders'));
    }

    public function switchStatusProcessing(Order $order){
        $order->status = 'processing';
        $order->save();
        return redirect()->back()->with('success','Status changed successfully');
    }

    public function switchStatusShipped(Order $order){
        $order->status = 'shipped';
        $order->shipping_date = date('Y-m-d');
        $order->save();
        return redirect()->back()->with('success','Status changed successfully');
    }
}
