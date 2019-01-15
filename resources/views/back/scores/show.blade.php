@extends('back.layout')

@section('css')
<style>
.box-body hr+p {
  font-size: x-large;
}
</style>
@endsection


@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>ID</b> <a class="pull-right">{{ $score->id }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('User')</b> <a class="pull-right">{{ $score->user->name }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('score')</b> <a class="pull-right">{{ $score->score }}</a>
                  </li>
                {!! $score->description !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection
