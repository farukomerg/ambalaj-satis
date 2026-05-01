<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'userCount' => User::where('role', 'user')->count(),
            'pendingOrders' => Order::where('status', 'pending_approval')->count(),
            'latestOrders' => Order::with('user')->latest()->take(6)->get(),
        ]);
    }
}
