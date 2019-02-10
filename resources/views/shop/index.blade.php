@extends('shop.layout')

@section('main')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-heading page-heading-md">
            <h2>Донат</h2>
        </div>

        <div class="container-fluid-md">
            <div class="row">
                <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="http://{{ env('APP_DOMAIN') }}" class="btn btn-primary btn-block"><i class="fa fa-fw fa-home"></i>Главная</a>
                            <a href="https://vk.com/rivex_server" class="btn btn-white btn-block">Группа ВКонтакте</a>
                        </div>
                    </div>
                    <form id="form-buy" action="{{ route('shop.order') }}" method="post">
                        @csrf
                        <div class="wizard-container" id="wizard-1">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active nowrap"><a data-toggle="tab" href="#wizard1-1"><span>Шаг 1:</span> выбор сервера</a></li>
                                <li><a data-toggle="tab" href="#wizard1-2"><span>Шаг 2:</span> выбор привилегии</a></li>
                                <li><a data-toggle="tab" href="#wizard1-3"><span>Шаг 3:</span> выбор никнейма</a></li>
                                <li><a data-toggle="tab" href="#wizard1-4" onclick="getSum()"><span>Шаг 4:</span> оплата</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="wizard1-1" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <p>Укажите адрес сервера, на котором хотите приобрести привилегию. Привилегия будет выдана на неограниченный срок.</p>
                                                <select class="form-control form-selectboxit" id="gameserver" name="gameserver">
                                                    <option>Выберите сервер</option>
                                                    <optgroup label="Minecraft PE">
                                                    @foreach ($servers as $server)
                                                        <option value="{{ $server->id }}"
                                                        @if ($loop->first)
                                                            selected
                                                        @endif
                                                        >{{ $server->title }}</option>
                                                    @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="wizard1-2" class="tab-pane">
                                    <div class="form-group">
                                        <p>Укажите нужную привилегию. Сумму к оплате Вы увидите после указания ника. Если Вы ранее покупали привилегию ниже уровня, то будет произведён перерасчёт. </p><a class="btn btn-link" href="{{ route('shop.list') }}">Описание привилегий.</a>
                                        <select class="form-control form-chosen" data-placeholder="Выберите привилегию..." id="product" name="product">
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="wizard1-3" class="tab-pane">
                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            <label class="control-label" for="username">Никнейм</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Ник в игре">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            <label class="control-label" for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            <label class="control-label" for="coupon">Скидочный купон</label>
                                            <input type="text" class="form-control" id="coupon" name="coupon" placeholder="Если есть">
                                        </div>
                                    </div>
                                    <p>Нажимая "Готово" Вы соглашаетесь с <a href="{{ route('shop.conditions') }}">Правилами пользования</a> и <a href="{{ route('shop.privacy') }}">Политикой конфиденциальности</a>.</p>
                                </div>
                                <div id="wizard1-4" class="tab-pane bg-danger text-center">
                                    <h1 class="thin" style="margin-bottom: 18px">Упс...</h1>
                                    <i class="fa fa-exclamation-circle fa-5x"></i>

                                    <h2 class="semi-bold">Проверьте работу своего броузера или смените его. Если ошибка не устранилась, обратитесь к администратору.</h2>
                                </div>
                            </div>
                            <ul class="pager wizard">
                                <li class="previous disabled"><a href="/nojs">Назад</a></li>
                                <li class="next"><a href="/nojs">Вперёд</a></li>
                                <li class="next finish" style="display:none;"><a href="/nojs" target="_blank" onclick="getSum()">Готово</a></li>
                            </ul>
                        </div>
                    </form>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>Возникли вопросы? Свяжитесь с нами в социальной сети или по почте: <code>admin@rivex.online</code></p>

                            <script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>

                            <!-- VK Widget -->
                            <div id="vk_contact_us"></div>
                            <script type="text/javascript">
                            VK.Widgets.ContactUs("vk_contact_us", {text: "Задать вопрос"}, -132955372);
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--[if lt IE 9]>
<script src="dist/assets/plugins/flot/excanvas.min.js"></script>
<![endif]-->

@endsection
