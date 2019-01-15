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
    <a class="btn btn-primary" href="{{ route('laws.create') }}">@lang('New Law')</a>
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
                        <th>@lang('Title')<span id="title" class="fa fa-sort pull-right"
                                                        aria-hidden="true"></span></th>
                        <th>@lang('Location')<span id="location" class="fa fa-sort pull-right"
                                                        aria-hidden="true"></span></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                      <tr>
                            <th>@lang('Id')<span id="id" class="fa fa-sort pull-right" aria-hidden="true"></span></th>
                            <th>@lang('Title')<span id="title" class="fa fa-sort pull-right" aria-hidden="true"></span></th>
                            <th>@lang('Location')<span id="location" class="fa fa-sort pull-right" aria-hidden="true"></span></th>

                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody id="pannel">
                        @include('back.laws.table', compact('laws'))
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
    <script>

        var law = (function () {

            var url = '{{ route('laws.index') }}'
            var swalTitle = '@lang('Really destroy law ?')'
            var confirmButtonText = '@lang('Yes')'
            var cancelButtonText = '@lang('No')'
            var errorAjax = '@lang('Looks like there is a server issue...')'

            var onReady = function () {
                $('#pagination').on('click', 'ul.pagination a', function (event) {
                    back.pagination(event, $(this), errorAjax)
                })
                $('#pannel').on('change', ':checkbox[name="seen"]', function () {
                        back.seen(url, $(this), errorAjax)
                    })
                    .on('change', ':checkbox[name="status"]', function () {
                        back.status(url, $(this), errorAjax)
                    })
                    .on('click', 'td a.btn-danger', function (event) {
                        back.destroy(event, $(this), url, swalTitle, confirmButtonText, cancelButtonText, errorAjax)
                    })
                $('th span').click(function () {
                    back.ordering(url, $(this), errorAjax)
                })
                $('.box-header :radio, .box-header :checkbox').click(function () {
                    back.filters(url, errorAjax)
                })
            }

            return {
                onReady: onReady
            }

        })()

        $(document).ready(law.onReady)

    </script>
@endsection
