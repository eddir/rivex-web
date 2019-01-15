@extends('back.laws.template')

@section('form-open')
    <form method="post" action="{{ route('laws.store') }}">
@endsection
