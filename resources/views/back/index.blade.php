@extends('back.layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <ul class="timeline">
            @foreach($bug_comments as $comment)
                <li>
                    @if ($comment->type == 0)
                    <i class="fa fa-comments bg-yellow"></i>
                    @elseif ($comment->type == 1)
                    <i class="fa fa-envelope bg-blue"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i>{{ $comment->created_at }}</span>

                        @if ($comment->type == 0)
                        <h3 class="timeline-header"><a href="#">{{ $comment->user->name }}</a> @lang('Left a comment')</h3>
                        @elseif ($comment->type == 1)
                        <h3 class="timeline-header"><a href="#">{{ $comment->user->name }}</a> @lang('Posted a record')</h3>
                        @endif

                        <div class="timeline-body">
                            {{ str_limit($comment->body, 100) }}
                        </div>

                        <div class="timeline-footer">
                            <a href="{{ route('bugs.show', ['id' => $comment->bug->id ]) }}" class="btn btn-primary btn-xs">@lang('Read more')</a>
                        </div>
                    </div>
                </li>
            @endforeach
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @admin
        <br>
        <div class="row">
            @each('back/partials/pannel', $pannels, 'pannel')
        </div>
    @endadmin
@endsection
