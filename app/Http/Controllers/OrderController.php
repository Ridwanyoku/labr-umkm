<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'quantity' => 'required|integer|min:1',
        ]);

        Order::create($request->all());

        return redirect('/')->with('success', 'Pesanan anda telah dikirim!');
    }

    public function index()
    {
        $confirmedOrders = Order::with('product')->where('status', 'confirmed')->latest()->get();
        $pendingOrders = Order::with('product')->where('status', 'pending')->latest()->get();

        return view('orders', compact('confirmedOrders', 'pendingOrders'));
    }

    // public function index()
    // {
    //     $orders = Order::with('product')->latest()->get();
    //     return view('orders', compact('orders'));
    // }

    public function dashboardSummary()
    {
        $totalProducts = Product::count();
        $totalConfirmed = Order::where('status', 'confirmed')->count();
        $totalPending = Order::where('status', 'pending')->count();

        return view('dashboard', compact('totalProducts', 'totalConfirmed', 'totalPending'));
    }


    public function confirm(Order $order)
    {
        $order->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Order confirmed!');
    }
}
