@extends('layouts.pdf')

@section('content')

    <div class="text-center">
        Universidade Estadual de Ciências da Saúde <br>
        Almoxarifado Central <br><br><br>

        <h4>Recibo Nº {{ $pedido->requisicao }}</h4>
    </div>

    <br>


        Tipo: {{ $pedido->estoque->descricao }} <br>
        Para: {{ $pedido->setor->setor }} <br>
        Data: {{ $pedido->datapedido }} <br>


    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Código</th>
            <th>Produto</th>
            <th>Unidade</th>
            <th>Lote</th>
            <th>Qtd</th>
        </tr>
        </thead>
        @foreach ($produtosaidas as $produtosaida)
         <tbody>
            <tr>
                <td>{{ $produtosaida->produto->codigo  }}</td>
                <td>{{ $produtosaida->produto->produto }}</td>
                <td>{{ $produtosaida->produto->unidade }}</td>
                <td>{{ $produtosaida->obs  }}</td>
                <td>{{ $produtosaida->qtd }}</td>
            </tr>
         </tbody>
        @endforeach
    </table>
    <br><br>
    Recebido por: ________________________________________________
@endsection