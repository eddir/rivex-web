@extends('back.layout')

@section('css')
    <style>
        textarea { resize: vertical; }
    </style>
    <link href="{{ asset('adminlte/plugins/colorbox/colorbox.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-slider/slider.css') }}">
@endsection

@section('main')

    @yield('form-open')
        {{ csrf_field() }}

        <div class="row">

            <div class="col-md-8">
                @if (session('bug-ok'))
                    @component('back.components.alert')
                        @slot('type')
                            success
                        @endslot
                        {!! session('bug-ok') !!}
                    @endcomponent
                @endif
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Title'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($bug) ? $bug->title : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Type'),
                    ],
                    'input' => [
                        'name' => 'bug_type',
                        'value' => isset($bug) ? $bug->bug_type : '',
                        'input' => 'option',
                        'options' => $types,
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Important'),
                    ],
                    'input' => [
                        'name' => 'bug_important',
                        'value' => isset($bug) ? $bug->bug_important : '',
                        'input' => 'option',
                        'options' => $importants,
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                     'box' => [
                         'type' => 'box-primary',
                         'title' => __('Front'),
                     ],
                     'input' => [
                         'title' => __('Progress'),
                         'name' => 'progress',
                         'value' => 0,
                         'input' => 'slider',
                         'min' => 0,
                         'max' => 100,
                     ],
                 ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Active'),
                    ],
                    'input' => [
                        'name' => 'type',
                        'value' => isset($bug) ? $bug->active : 1,
                        'input' => 'checkbox',
                        'title' => __('Status'),
                        'label' => __('Active'),
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Body'),
                    ],
                    'input' => [
                        'name' => 'body',
                        'value' => isset($bug) ? $bug->body : '',
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
    <script>

        CKEDITOR.replace('body', {customConfig: '/adminlte/js/ckeditor.js'})

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

@endsection
