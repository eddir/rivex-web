@extends('back.bugs.template')

@section('form-open')
    <form method="post" action="{{ route('bugs.update', [$bug->id]) }}">
        {{ method_field('PUT') }}
@endsection
