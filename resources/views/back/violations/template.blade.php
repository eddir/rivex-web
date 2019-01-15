@extends('back.layout')

@section('css')
    <style>
        textarea { resize: vertical; }
    </style>
    <link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">
    <link href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endsection

@section('main')

    @yield('form-open')
        {{ csrf_field() }}

        <div class="row">

            <div class="col-md-8">
                @if (session('violation-ok'))
                    @component('back.components.alert')
                        @slot('type')
                            success
                        @endslot
                        {!! session('violation-ok') !!}
                    @endcomponent
                @endif
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Violator'),
                    ],
                    'input' => [
                        'name' => 'violator',
                        'value' => isset($violation) ? $violation->violator : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Law'),
                    ],
                    'input' => [
                        'name' => 'law_id',
                        'value' => isset($violation) ? $violation->law_id : '',
                        'input' => 'option',
                        'options' => $laws,
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Term'),
                    ],
                    'input' => [
                        'name' => 'term',
                        'value' => [
                            'start' => isset($violation) ? $violation->term_start : '',
                            'end' => isset($violation) ? $violation->term_end : ''
                        ],
                        'input' => 'datetimerange',
                        'required' => true
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Location'),
                    ],
                    'input' => [
                        'name' => 'location',
                        'value' => isset($violation) ? $violation->location : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Cause'),
                    ],
                    'input' => [
                        'name' => 'cause',
                        'value' => isset($violation->cause) ? $violation->cause : '',
                        'input' => 'textarea',
                        'rows' => 10,
                        'required' => true,
                    ],
                ])
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
            </div>

            <div class="col-md-4">

        </div>
        </div>
        <!-- /.row -->
    </form>

@endsection

@section('js')

    <script src="{{ asset('adminlte/plugins/colorbox/jquery.colorbox-min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/voca/voca.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>

        CKEDITOR.replace('cause', {customConfig: '/adminlte/js/ckeditor.js'})

        $('.slider').slider()

        $('.popup_selector').click( function (event) {
            event.preventDefault()
            var updateID = $(this).attr('data-inputid')
            var elfinderUrl = '/elfinder/popup/'
            var triggerUrl = elfinderUrl + updateID
            $.colorbox({
                href: triggerUrl,
                fastIframe: true,
                iframe: true,
                width: '70%',
                height: '70%'
            })
        })

        function processSelectedFile(filePath, requestingField) {
            $('#' + requestingField).val('\\' + filePath)
            $('#img').attr('src', '\\' + filePath)
        }

        $('#slug').keyup(function () {
            $(this).val(v.slugify($(this).val()))
        })

        $('#title').keyup(function () {
            $('#slug').val(v.slugify($(this).val()))
        })

    </script>

    <script type="text/javascript">
        $(function() {
            var input_start = $('#datetimerange [name="term_start"]').val()
            var input_end = $('#datetimerange [name="term_end"]').val()

            var start = input_start ? input_start : moment();
            var end = input_end ? input_end : moment().add(1, 'days');

            function cb(start, end) {
                $('#datetimerange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#datetimerange [name="term_start"]').val(start);
                $('#datetimerange [name="term_end"]').val(end);
            }

            $('#datetimerange').daterangepicker({
                startDate: start,
                endDate: end,
                timePicker: true,
                timePicker24Hour: true,
                ranges: {
                   '1 Day': [moment(), moment().add(1, 'days')],
                   '3 Days': [moment(), moment().add(3, 'days')],
                   '1 week': [moment(), moment().add(1, 'weeks')],
                   '1 month': [moment(), moment().add(1, 'months')],
                }
            }, cb);

            cb(start, end);

        });
    </script>

@endsection
