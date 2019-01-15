@extends('back.scores.template')

@section('form-open')
    <form method="post" action="{{ route('scores.store') }}">
@endsection
