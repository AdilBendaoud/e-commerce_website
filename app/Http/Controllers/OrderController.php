<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();
        $filterDate = $request->input('filter_date');
        $filterStatus = $request->input('orderStatus');

        if ($filterDate == 'today') {
            $query->whereDate('created_at', now());
        } elseif ($filterDate == 'month') {
            $query->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month);
        } elseif ($filterDate == 'year') {
            $query->whereYear('created_at', now()->year);
        } elseif ($filterDate == 'custom' && $request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')]);
        }

        if($request->has('orderStatus') && $filterStatus != 'allStatus'){
            $query->where('status',$filterStatus);
        }

        $orders = $query->get();    

        return view('admin.orders',compact('orders','filterDate','filterStatus'));
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
