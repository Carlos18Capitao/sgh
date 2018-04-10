@extends('layouts.pdf')
{{--<style type="text/css">--}}
    {{--table {--}}
        {{--border-color:black;--}}
        {{--border-style: solid;--}}
        {{--border-bottom-width: 1px;--}}
        {{--border-top-width: 1;--}}
        {{--border-right-width: 1;--}}
        {{--border-left-width: 1;--}}
        {{--padding: 1px;--}}
        {{--border-collapse: collapse;--}}
        {{--width: 700px;--}}

    {{--}--}}
    {{--table td, table th {--}}
        {{--border-color:black;--}}
        {{--border-style: solid;--}}
        {{--border-bottom-width: 1px;--}}
        {{--border-top-width: 1;--}}
        {{--border-right-width: 1;--}}
        {{--border-left-width: 1;--}}
        {{--padding: 1px;--}}
        {{--border-collapse: collapse;--}}
    {{--}--}}

{{--</style>--}}

@section('content')

    <div class="text-center">
        <font size="1">
            Universidade Estadual de Ciências da Saúde <br>
            Almoxarifado Central
        </font>

        <hr>
    @if($pedido->tipopedido == 'unidade')
        <font size="2">Requisição Nº {{ $pedido->requisicao }}</font>
    @else
        <font size="2">Recibo  {{ strtoupper($pedido->tipopedido) }}</font>
    @endif
    </div>

    <br>
    <font size="2">
        Tipo: {{ $pedido->estoque->descricao }} <br>
        Para:
        @if($pedido->tipopedido == 'unidade')
            {{ $pedido->setor->setor }}
        @else
            {{ $pedido->externo }}
        @endif

        <br>
        Data: {{ $pedido->datapedido }} <br>
    </font>
    <font size="2">
        Observações: {!! nl2br($pedido->obs) !!}
    </font>

    <table width="100%" class="table-sm table-bordered">
        <thead>
        <tr>
            <th align="center"><font size="1"> Código </font></th>
            <th align="center"><font size="1"> Produto </font></th>
            <th align="center"><font size="1"> Unidade </font></th>
            <th align="center"><font size="1"> Lote </font></th>
            <th align="center"><font size="1"> Qtd </font></th>
        </tr>
        </thead>
        @foreach ($produtosaidas as $produtosaida)
         <tbody>
            <tr>
                <td align="center"><font size="1">{{ $produtosaida->produto->codigo  }}</font></td>
                <td><font size="1">{{ $produtosaida->produto->produto }}</font></td>
                <td><font size="1">{{ $produtosaida->produto->unidade }}</font></td>
                <td align="center"><font size="1">{{ $produtosaida->obs  }}</font></td>
                <td align="center"><font size="1">{{ $produtosaida->qtd }}</font></td>
            </tr>
         </tbody>
        @endforeach
    </table>
    <br><br>
    <font size="1">
        Recebido por: ________________________________________________
    </font>
@endsection