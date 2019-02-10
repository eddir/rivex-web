<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title>@lang('Payment')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!--<link rel="shortcut icon" href="/favicon.ico">-->
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="stylesheet" href="/veneto/css/bootstrap.min.css">
    <link rel="stylesheet" href="/veneto/css/veneto-admin.min.css">
    <link rel="stylesheet" href="/veneto/assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/css/shop.css">

    <!--[if lt IE 9]>
    <script src="/veneto/assets/libs/html5shiv/html5shiv.min.js"></script>
    <script src="/veneto/assets/libs/respond/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    @yield('main')

    <script src="/veneto/assets/libs/jquery/jquery.min.js"></script>
    <script src="/veneto/assets/bs3/js/bootstrap.min.js"></script>
    <script src="/veneto/assets/plugins/jquery-navgoco/jquery.navgoco.js"></script>
    <script src="/veneto/js/main.js"></script>
    <script src="/veneto/assets/plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="/js/shop.js?v={{ time() }}"></script>
  </body>
</html>
