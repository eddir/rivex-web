@extends('back.violations.template')

@section('form-open')
    <form method="post" action="{{ route('violations.store') }}">
@endsection
