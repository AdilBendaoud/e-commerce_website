<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons',compact('coupons'));
    }

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

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success','Coupon deleted successfully');
    }

    public function applyCoupon(Request $request){
        $coupon = Coupon::where('code',$request->coupon_code)->first();
        if($coupon == null){
            return redirect()->back()->with('error',"Coupon deosn't existe");
        }

        if ($coupon->expiry_date && now() > $coupon->expiry_date) {
            return redirect()->back()->with('error', 'Coupon has expired.');
        }
            
        if ($coupon->usage_limite == '0') {
            return redirect()->back()->with('error', 'Coupon has reached its usage limit.');
        }
        
        $newLimite = (int)$coupon->usage_limite-1;
        $coupon->usage_limite = (string)$newLimite;
        $coupon->save();
        session()->put('coupon', $coupon);
        return redirect()->back()->with('success','Coupon applied successfully');
        
    }
}
