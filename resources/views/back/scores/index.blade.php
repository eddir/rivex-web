@extends('back.layout')

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">
    <style>
        input, th span {
            cursor: pointer;
        }
        #message {
            background-color: #a2cce4;
        }
        #message.box-footer {
            margin: 10px;
        }
    </style>
@endsection

@section('button')
    <a class="btn btn-primary" href="{{ route('scores.create') }}">@lang('New score')</a>
@endsection

@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive">
                <table id="users" class="table table-striped table-bordered">
                    <thead>
                  <tr>
                        <th>@lang('Id')<span id="id" class="fa fa-sort pull-right"
                                                        aria-hidden="true"></span></th>
                        <th>@lang('User')<span id="user" class="fa fa-sort pull-right"
                                                        aria-hidden="true"></span></th>
                        <th>@lang('Score')<span id="score" class="fa fa-sort pull-right"
                                                        aria-hidden="true"></span></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                      <tr>
                            <th>@lang('Id')<span id="id" class="fa fa-sort pull-right" aria-hidden="true"></span></th>
                            <th>@lang('User')<span id="user" class="fa fa-sort pull-right" aria-hidden="true"></span></th>
                            <th>@lang('Score')<span id="score" class="fa fa-sort pull-right" aria-hidden="true"></span></th>

                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody id="pannel">
                        @include('back.scores.table', compact('scores'))
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div id="pagination" class="box-footer">
                {{ $links }}
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

@endsection

@section('js')
    <script src="{{ asset('adminlte/js/back.js') }}"></script>
@endsection
