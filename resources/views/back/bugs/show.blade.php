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
                    <b>ID</b> <a class="pull-right">{{ $bug->id }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('title')</b> <a class="pull-right">{{ $bug->title }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('author')</b> <a class="pull-right">{{ $bug->user->name }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('important')</b> <a class="pull-right">{{ $bug->important->title }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('type')</b> <a class="pull-right">{{ $bug->type->title }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('progress')</b> <a class="pull-right">{{ $bug->progress }}%</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('date')</b> <a class="pull-right">{{ $bug->created_at }}</a>
                  </li>
                </ul>
                {!! $bug->body !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection
