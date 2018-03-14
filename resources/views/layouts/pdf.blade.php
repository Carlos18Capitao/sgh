<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>

    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    {{--<link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">--}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

</head>
<body>

        @yield('content')


</body>