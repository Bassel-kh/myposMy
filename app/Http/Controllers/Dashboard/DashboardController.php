<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index(){

        $categories = Category::count();
        $products = Product::count();
        $clients = Client::count();
        $orders = Order::count();
//        $users_count = User::whereRoleIs('admin')->count();

        return view('dashboard.index' ,compact('categories', 'products', 'clients' ,'orders'));
    }
}
