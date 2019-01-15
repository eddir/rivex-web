@extends('back.violations.template')

@section('form-open')
    <form method="post" action="{{ route('violations.update', [$violation->id]) }}">
        {{ method_field('PUT') }}
@endsection
