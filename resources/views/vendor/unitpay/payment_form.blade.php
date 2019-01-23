@extends('shop.layout')

@section('main')

  <form method="post" action="https://unitpay.ru/pay/{{ $payment_fields['PUB_KEY'] }}">
    <input type="hidden" name="sum" value="{{ $payment_fields['PAYMENT_AMOUNT'] }}">
    <input type="hidden" name="account" value="{{ $payment_fields['PAYMENT_NO'] }}">
    <input type="hidden" name="desc" value="{{ $payment_fields['ITEM_NAME'] }}">
    <input type="hidden" name="currency" value="{{ $payment_fields['CURRENCY'] }}">
    <input type="hidden" name="locale" value="{{ $payment_fields['LOCALE'] }}">
    <input type="hidden" name="signature" value="{{ $payment_fields['SIGN'] }}">
    <input type="hidden" name="hideOtherMethods" value="{{ config('unitpay.hideOtherMethods','false') }}">
    <button type="submit" class="btn btn_order">@lang('Type to continue')</button>
  </form>

@endsection
