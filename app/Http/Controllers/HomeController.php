<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
        if(Auth::user()->isAdmin ?? false){
            $recentProducts = Product::orderBy('created_at', 'desc')->take(5)->get();
            $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();
            $monthRevenue = Order::whereYear('created_at',date('Y'))->whereMonth('created_at',date('m'))->sum('total');
            $monthOrders =count(Order::whereYear('created_at',date('Y'))->whereMonth('created_at',date('m'))->get());
            $totalproduct = count(Product::all());
            $newUsers = count(User::whereYear('created_at',date('Y'))->whereMonth('created_at',date('m'))->get());

            $ordersData = Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as total'))
                ->where('status','shipped')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();
            $monthOrdersLabels = [];
            $monthOrdersData = [];
            
            foreach ($ordersData as $order) {
                $monthOrdersLabels[] = Carbon::create()->month($order->month)->monthName;;
                $monthOrdersData[] = $order->total;
            }
            
            $orderStatus=[
                count(Order::where('status','on hold')->get()),
                count(Order::where('status','shipped')->get()),
                count(Order::where('status','preparing')->get())
            ];

            $salesByCategory = DB::select(" SELECT categories.id, categories.name as category_name, SUM(order_product.quantity*products.sale_price) as total
                                            From categories
                                            JOIN products on categories.id = products.categorie_id
                                            JOIN order_product on order_product.product_id = products.id
                                            JOIN orders on orders.id = order_product.order_id
                                            WHERE YEAR(order_date) = YEAR(CURRENT_DATE)
                                            AND MONTH(order_date) = MONTH(CURRENT_DATE)
                                            GROUP BY categories.id , categories.name");
            $salesByCategoryLabel = [];
            $salesByCategoryData = [];
            
            foreach ($salesByCategory as $line) {
                $salesByCategoryLabel[] = $line->category_name;
                $salesByCategoryData[] = $line->total;
            }
            $tasks = Task::all();

            $newUsersData = User::where('isAdmin',0)->orderBy("created_at")->take(5)->get();

            return view('admin.home',compact(
                'recentProducts','recentOrders','tasks',
                'monthRevenue','totalproduct','newUsers',
                'monthOrders','newUsersData',
                'monthOrdersLabels','monthOrdersData',
                'orderStatus',
                'salesByCategoryLabel','salesByCategoryData'));
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
