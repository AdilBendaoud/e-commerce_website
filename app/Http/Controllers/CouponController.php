<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons',compact('coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->usage_limite = $request->usage_limite;
        $coupon->user_id = auth()->user()->id;
        $coupon->save();
        return redirect()->back()->with('success','Coupon created successfully');
    }

    public function show(Coupon $coupon){
        return response()->json(['coupon'=>$coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->usage_limite = $request->usage_limite;
        $coupon->save();
        return redirect()->back()->with('success','Coupon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success','Coupon deleted successfully');
    }
}
