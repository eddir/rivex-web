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
                    <b>@lang('Title')</b> <a class="pull-right">{{ $bug->title }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('Author')</b> <a class="pull-right">{{ $bug->user->name }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('Important')</b> <a class="pull-right">{{ $bug->important->title }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('Type')</b> <a class="pull-right">{{ $bug->type->title }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('Progress')</b> <a class="pull-right">{{ $bug->progress }}%</a>
                  </li>
                  <li class="list-group-item">
                    <b>@lang('Date')</b> <a class="pull-right">{{ $bug->created_at }}</a>
                  </li>
                </ul>
                {!! $bug->body !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="fa fa-comments-o"></i>
            <h3 class="box-title">@lang('comments')</h3>
          </div>
          <div class="box-body">
          @foreach($bug->comments as $comment)
            <!-- chat item -->
            <div class="item">
              <p class="message">
                <a href="#" class="name">
                  <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</small>
                  {{ $comment->user->name }}
                </a>
                {{ $comment->body }}
              </p>
            </div>
            <!-- /.item -->
          @endforeach
          </div>
          <!-- /.chat -->
          <div class="box-footer">
            <form method="post" action="{{ route('bugcomments.store', [$bug->id]) }}">
              {{ csrf_field() }}
              <div class="input-group">
                <input name="body" class="form-control" placeholder="@lang('Type message')">
                <div class="input-group-btn">
                  <input type="submit" class="btn btn-success"><i class="fa fa-plus"></i>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection
