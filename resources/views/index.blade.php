@extends('layouts.app')

@section('content')
    <div class="alert alert-primary">

        <div class="container">
            <h1>Погода в Брянске</h1>
            <div class="row">
                <div class="col-6">Дата</div>
                <div class="col-6">{{\Carbon\Carbon::parse($data->now_dt)}}</div>
                <div class="col-6">Температура</div>
                <div class="col-6">{{$data->fact->temp}} градусов</div>
                <div class="col-6">Ощущается как</div>
                <div class="col-6">{{$data->fact->feels_like}} градусов</div>
            </div>
        </div>

    </div>

    <div class="container text-center mt-5">
        <a class="text-decoration-none text-dark" href="/orders">
            <h1>ПЕРЕЙТИ К СТРАНИЦЕ ЗАКАЗОВ
                <span>&#10142;</span>
            </h1>
        </a>
    </div>



@endsection
