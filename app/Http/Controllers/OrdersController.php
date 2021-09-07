<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use App\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::with('partner', 'products')->get();


        $orders = $orders->each(function ($order) {
            $order->status_name = Order::getStatusName($order->status);
            $order->total = Order::getTotal($order);
        });

        return view('orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function edit($id)
    {
        $order = Order::with('partner', 'products')
            ->where('id', $id)
            ->get();

        $status_types = [
            '0' => 'новый',
            '10' => 'подтвержден',
            '20' => 'завершен',
        ];

        $partners = Partner::get();
        $products = Product::get();

        $data = [
            'order_info' => $order,
            'partners' => $partners,
            'products' => $products,
            'status_types' => $status_types
        ];


        return view('detail', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
