@extends('layouts.app')

@section('content')


    <order-detail
            :order="{{$order}}"
            :products="{{$products}}"
            :partners="{{$partners}}"
            :status_types="{{$status_types}}"
    ></order-detail>

@endsection

