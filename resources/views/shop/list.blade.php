@extends('shop.layout')

@section('main')

    <h1>@lang('List of privilages')</h1>

    @foreach ($products as $product)
        <h2>{{ $product->title }} <i>({{ $product->price }} @lang('rub'))</i></h2>
        {!! $product->body !!}
    @endforeach

@endsection
