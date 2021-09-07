<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use App\Product;
use Dotenv\Exception\ValidationException;
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


    public function edit($id)
    {
        $order = Order::findOrFail($id);

        $order = $order->with('partner', 'products')
            ->where('id', $id)->first();

        $status_types = json_encode(Order::STATUS_TYPES);

        $partners = Partner::get();
        $products = Product::get();

        return view('detail', compact(['order', 'partners', 'products', 'status_types']));
    }


    public function update(Request $request, $id)
    {

        try {

            $this->validate($request, [
                'status' => 'required|numeric',
                'partner_id' => 'required|numeric',
                'client_email' => 'required|email'
            ]);

        } catch (ValidationException $exception) {
            return response()->json($exception->getMessage());
        }

        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status,
            'partner_id' => $request->partner_id,
            'client_email' => $request->client_email
        ]);

        $order->save();

        return response()->json(['msg' => 'Запись успешно обновлена'],
            200, [], JSON_UNESCAPED_UNICODE);

    }


}
