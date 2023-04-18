<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function dashboard(){
        $total_earning=Order::sum('total');
        $total_order_count=Order::count();
        $total_categories=Category::count();
        $total_products=Product::count();
        $total_customers=User::where('role_id',2)->count();
        $orders=Order::with(['billing','orderdetails'])->latest('id')->paginate();
        $order_on_2021=Order::whereBetween('created_at',['2021-01-01','2021-12-31'])->count();
        $order_on_2022=Order::whereBetween('created_at',['2022-01-01','2022-12-31'])->count();
        $order_on_2023=Order::whereBetween('created_at',['2023-01-01','2023-12-31'])->count();

        $order_yearwise=[ $order_on_2021, $order_on_2022, $order_on_2023];
        return view('backend.pages.dashboard',compact(
            'total_earning',
            'total_order_count',
            'total_categories',
            'total_products',
            'total_customers',
            'orders',
            'order_yearwise'

        ));
    }
}
