<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Produto</title>

    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    {{--<link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">--}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

</head>
<body>
    <div class="text-center">
{{--        <h3>{{ $title }} - {{ $est->pluck('descricao') }}</h3>--}}
        @foreach($est as $es)
            <h4>{{ $title }} - {{ $es->descricao }}</h4>
            {{ $es->now() }}
        @endforeach
    </div>

    <table class="table-striped table-condensed">
        <tr>
            <th>Código</th>
            <th>Produto</th>
            <th>Unidade</th>
            <th>Estoque Atual</th>
        </tr>
        @foreach ($estoques as $estoque)

          @foreach ($estoque->produto->sortBy('produto') as $produto)
              @if(($produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') )> 0)
              <tr>
                <td>{{ $produto->codigo }}</td>
                <td>{{ $produto->produto }}</td>
                <td>{{ $produto->unidade }}</td>
                <td align="left">{{ $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') }}</td>
              </tr>
                @endif
          @endforeach

        @endforeach
    </table>
</body>
</html>