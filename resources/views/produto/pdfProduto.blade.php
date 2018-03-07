<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Produto</title>

    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
<style>
        .container {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #FFFFFF;
        }

        .content {
        position: absolute;
        top: 50%;
        /*left: 25%;*/
        /*width: 50%;*/
        text-align: center;
        -webkit-transform: translateY( -50% );
        -moz-transform: translateY( -50% );
        transform: translateY( -50% );
        }
</style>
</head>
<body>

    <div class="container">
        <div class="content">
{{--            <h1>{{ $produtos->codigo . ' - ' . $produtos->produto }}</h1>--}}
            <font size="10"><b>{{ $produtos->codigo . ' - ' . $produtos->produto }}</b></font>
            <br><br><br><br>
            <p><font size="7"><b> - {{ $produtos->unidade }} - </b></font></p>
        </div>
    </div>

</body>
