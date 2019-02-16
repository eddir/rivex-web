@extends('back.scores.template')

@section('form-open')
    <form method="post" action="{{ route('scores.update', [$score->id]) }}">
        {{ method_field('PUT') }}
@endsection
