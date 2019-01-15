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
                    <b>ID</b> <a class="pull-right">{{ $violation->id }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('location')</b> <a class="pull-right">{{ $violation->location }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('violator')</b> <a class="pull-right">{{ $violation->violator }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('author')</b> <a class="pull-right">{{ $violation->user->name }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('law')</b> <a class="pull-right">{{ $violation->law->title }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('term start')</b> <a class="pull-right">{{ $violation->term_start }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('term end')</b> <a class="pull-right">{{ $violation->term_end }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('date')</b> <a class="pull-right">{{ $violation->created_at }}</a>
                  </li>
                </ul>
                {!! $violation->cause !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection
