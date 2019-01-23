<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title>@lang('Payment')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  	<!-- mobile specific metas
  	================================================== -->
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  </head>
  <body>
   @yield('main')
  </body>
</html>
