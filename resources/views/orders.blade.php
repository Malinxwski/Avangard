@extends('layouts.app')

@section('content')


    <table class="table">
        <thead>
        <tr>
            <th scope="col">Номер</th>
            <th scope="col">Партнер</th>
            <th scope="col">Стоимость</th>
            <th scope="col">Состав заказа</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)
            <tr>
                <th scope="row">
                    <a href="/order/{{$order->id}}">{{$order->id}}</a></th>
                <td>{{$order->partner->name}}</td>
                <td>{{$order->total}}</td>
                <td>
                    @foreach($order->products as $product)

                        {{$product->name}}  x <span class="text-danger">{{$product->pivot->quantity}}</span> <br>
                    @endforeach
                </td>

                <td>{{$order->status_name}}</td>
            </tr>

        @endforeach

        </tbody>
    </table>


@endsection
