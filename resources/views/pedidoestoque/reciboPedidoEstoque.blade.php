@extends('layouts.pdf')
<style type="text/css">
    table {
        border-color:black;
        border-style: solid;
        border-bottom-width: 1px;
        border-top-width: 1;
        border-right-width: 1;
        border-left-width: 1;
        padding: 1px;
        border-collapse: collapse;
        width: 700px;

    }
    table td, table th {
        border-color:black;
        border-style: solid;
        border-bottom-width: 1px;
        border-top-width: 1;
        border-right-width: 1;
        border-left-width: 1;
        padding: 1px;
        border-collapse: collapse;
    }

</style>

@section('content')

    <div class="text-center">
        <font size="1">
            Universidade Estadual de Ciências da Saúde <br>
            Almoxarifado Central
        </font>

        <hr>

        <font size="4">Recibo Nº {{ $pedido->requisicao }}</font>
    </div>

    <br>
    <font size="2">
        Tipo: {{ $pedido->estoque->descricao }} <br>
        Para: {{ $pedido->setor->setor }} <br>
        Data: {{ $pedido->datapedido }} <br>
    </font>

    <table>
        <thead>
        <tr>
            <th align="center"><font size="2"> Código </font></th>
            <th align="center"><font size="2"> Produto </font></th>
            <th align="center"><font size="2"> Unidade </font></th>
            <th align="center"><font size="2"> Lote </font></th>
            <th align="center"><font size="2"> Qtd </font></th>
        </tr>
        </thead>
        @foreach ($produtosaidas as $produtosaida)
         <tbody>
            <tr>
                <td align="center"><font size="2">{{ $produtosaida->produto->codigo  }}</font></td>
                <td><font size="2">{{ $produtosaida->produto->produto }}</font></td>
                <td><font size="2">{{ $produtosaida->produto->unidade }}</font></td>
                <td align="center"><font size="2">{{ $produtosaida->obs  }}</font></td>
                <td align="center"><font size="2">{{ $produtosaida->qtd }}</font></td>
            </tr>
         </tbody>
        @endforeach
    </table>
    <br><br>
    <font size="2">
        Recebido por: ________________________________________________
    </font>
@endsection