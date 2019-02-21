@extends('back.layout')

@section('main')

<div class="row">
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>
                <h3 class="box-title">@lang('Online graph')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="online-chart" style="height: 250px;">
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>
                <h3 class="box-title">@lang('Memory graph')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="memory-chart" style="height: 250px;">
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>
                <h3 class="box-title">@lang('Tick usage graph')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="ticks-chart" style="height: 250px;">
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>
                <h3 class="box-title">@lang('Tps graph')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="tps-chart" style="height: 250px;">
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid bg-teal-gradient">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-th"></i>
                <h3 class="box-title">@lang('Sales graph')</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="sales-chart" style="height: 250px;">
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('Latest orders')</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>@lang('ID')</th>
                                <th>@lang('Username')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Product')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Coupon')</th>
                                <th>@lang('Server')</th>
                                <th>@lang('Method')</th>
                                <th>@lang('Date')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="#">{{ $order->id }}</a></td>
                                <td>{{ $order->username }}</td>
                                <td>
                                    @switch($order->status)
                                    @case(1)
                                    <span class="label label-warning">@lang('Not paid')</span>
                                    @break
                                    @case(2)
                                    <span class="label label-danger">@lang('Not issued')</span>
                                    @break
                                    @case(3)
                                    <span class="label label-success">@lang('Success')</span>
                                    @break
                                    @endswitch
                                </td>
                                <td>{{ $order->product->title }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->coupon->name ?? "" }}</td>
                                <td>{{ $order->server->port }}</td>
                                <td>{{ $order->method->name ?? ""}}</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@endsection

@section('js')
    <script type="text/javascript" src="/veneto/assets/plugins/raphael/raphael-min.js"></script>
    <script type="text/javascript" src="/adminlte/plugins/morris/morris.min.js"></script>
    <script type="text/javascript" src="/js/statistics.js"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="/adminlte/plugins/morris/morris.css?1">
@endsection
