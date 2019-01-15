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
                @if (session('law-ok'))
                    @component('back.components.alert')
                        @slot('type')
                            success
                        @endslot
                        {!! session('law-ok') !!}
                    @endcomponent
                @endif
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Title'),
                    ],
                    'input' => [
                        'name' => 'title',
                        'value' => isset($law) ? $law->title : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Location'),
                    ],
                    'input' => [
                        'name' => 'location',
                        'value' => isset($law) ? $law->location : '',
                        'input' => 'text',
                        'required' => true,
                    ],
                ])
                @include('back.partials.boxinput', [
                    'box' => [
                        'type' => 'box-primary',
                        'title' => __('Body'),
                    ],
                    'input' => [
                        'name' => 'description',
                        'value' => isset($law) ? $law->description : '',
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

        CKEDITOR.replace('description', {customConfig: '/adminlte/js/ckeditor.js'})

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
