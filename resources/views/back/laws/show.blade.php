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
                    <b>ID</b> <a class="pull-right">{{ $law->id }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('title')</b> <a class="pull-right">{{ $law->title }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('author')</b> <a class="pull-right">{{ $law->user->name }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('location')</b> <a class="pull-right">{{ $law->location }}</a>
                  </li>
                {!! $law->description !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection
