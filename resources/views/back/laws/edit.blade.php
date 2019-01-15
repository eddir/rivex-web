@extends('back.laws.template')

@section('form-open')
    <form method="post" action="{{ route('laws.update', [$law->id]) }}">
        {{ method_field('PUT') }}
@endsection
