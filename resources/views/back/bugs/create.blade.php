@extends('back.bugs.template')

@section('form-open')
    <form method="post" action="{{ route('bugs.store') }}">
@endsection
