@extends('shop.layout')

@section('main')

  <form method="post" action="{{ route('shop.order') }}">
    {{ csrf_field() }}
    <input type="text" name="username" value="test">
    <label for="username">@lang('Username')</label>
    <input type="text" name="email" value="test@email.com">
    <label for="email">@lang('Email')</label>
    <input type="text" name="product" value="2">
    <label for="product">@lang('Product')</label>
    <input type="text" name="server" value="19132">
    <label for="server">@lang('Server')</label>
    <input type="text" name="discount">
    <label for="discount">@lang('Discount')</label><br>
    <input type="submit" value="@lang('Submit')">
  </form>

@endsection
