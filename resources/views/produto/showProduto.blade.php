@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $produtos->codigo . ' - ' . $produtos->produto }}</h3>
    </div>

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <a target="_blank" class = "btn btn-sm btn-default" title="IMPRIMIR ETIQUETA" href="{{ route('pdfproduto',$produtos->id)}}">
        <span class="glyphicon glyphicon-print"></span>
    </a>
{{--    {!! QrCode::size(100)->generate(Request::url(),'../public/qrcodes/qrcode.svg'); !!}--}}
    <br><br>
    
    <p><b>Descrição:</b> {{ $produtos->codigo . ' - ' . $produtos->produto }}</p>
    <p><b>Unidade:</b> {{ $produtos->unidade }}</p>
    <p><b>Categoria:</b> {{ $produtos->categoria->descricao }}</p>
    <p><b>Saldo: </b>{{ $produtos->produtoentrada->sum('qtd') - $produtos->produtosaida->sum('qtd') }}
              @if($produtos->unidade == 'Grama')
                   {{ '  |  ' . ($produtos->produtoentrada->sum('qtd') - $produtos->produtosaida->sum('qtd'))/1000 .'kg' }}</p>
              @endif

    <hr>
@if($produtos->lote == 1)
<div class="panel panel-default">
    <div class="panel-heading">
      <class="panel-title"><b>SALDO POR LOTE</b></class>
    </div>
    <div class="panel-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Lote</th>
                <th>Validade</th>
                <th>Quantidade</th>
                <th>Imprimir</th>
            </tr>
        </thead>
@foreach($produtos->lotes->sortBy('validade') as $lote)
        @if($lote->qtd != 0)
            <tbody>
                <td>{{ $lote->lote }}</td>
                <td>{{ $lote->validade_format }}</a></td>
                <td>{{ $lote->qtd }}</td>
                <td>
                    <a target="_blank" class = "btn btn-sm btn-default" title="IMPRIMIR COM LOTE" href="{{ route('pdfprodutolote',$lote->id)}}">
                        <span class="glyphicon glyphicon-print"></span>
                    </a>
                </td>
        @endif
            </tbody>
@endforeach
    </table>
</div>
<div class="panel-footer">
    <b>Total Lotes:</b> {{ $produtos->lotes->sum('qtd') }}
</div>
</div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
      <class="panel-title"><b>DEMANDA POR UNIDADE</b></class>
    </div>
    <div class="panel-body">
    <table data-order='[[ 0, "asc" ]]' id="demandas" class="table table-striped">
        <thead>
        <tr>
            <th>Setor</th>
            <th>Demanda Anual</th>
            <th>Demanda Mensal</th>
            <th>Demanda Semanal</th>
        </tr>
        </thead>
        <tbody>
@foreach($produtos->demanda as $demanda)
        <tr>
            <td>{{ $demanda->setor->setor }}</td>
            <td>{{ $demanda->qtd }}</td>
            <td>{{ ceil($demanda->qtd / 12) }}</td>
            <td>{{ ceil($demanda->qtd / 52) }}</td>
        </tr>
@endforeach
        </tbody>
    </table>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
      <class="panel-title"><b>ENTRADAS</b></class>
    </div>
    <div class="panel-body">
    <table data-order='[[ 2, "desc" ]]' id="entradas" class="table table-striped">
    <thead>
    <tr>
        <th>Fornecedor</th>
        <th>Entrada</th>
        <th>Data de Entrada</th>
        <th>Qtd</th>
        <th>Preço de Compra</th>
        <th>Lote</th>
        <th>Validade</th>
        <th>Usuário</th>
    </tr>
    </thead>
        <tbody>
    @foreach($produtos->produtoentrada as $entproduto)
    {{--{{ dd($entproduto) }}--}}
            <tr>
                <td>{{ $entproduto->entrada->empresa->nome or 'UNCISAL' }}</td>
                <td><a href="{{ route('entrada.show',$entproduto->entrada_id) }}">{{ $entproduto->entrada->numeroentrada or ''}}</a></td>
                <td>{{ $entproduto->entrada->dataentrada or $entproduto->created_at}}</td>
                <td>{{ $entproduto->qtd }}</td>
                <td>{{ 'R$ ' . $entproduto->preco }}</td>
                <td>{{ $entproduto->lote }}</td>
                <td>{{ $entproduto->validade }}</td>
                <td>{{ $entproduto->user->name }}</td>
            </tr>
@endforeach
        </tbody>
    </table>

    </div>
    <div class="panel-footer">
        <b>Total de Entradas:</b> {{ $produtos->produtoentrada->sum('qtd') }}
  @if($produtos->unidade == 'Grama')
    {{' | ' . ($produtos->produtoentrada->sum('qtd'))/1000 . 'Kg'}}
  @endif
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
      <class="panel-title"><b>SAÍDAS</b></class>
    </div>
    <div class="panel-body">
    <table data-order='[[ 2, "desc" ]]' id="saidas" class="table table-striped">
        <thead>
        <tr>
            <th>Setor</th>
            <th>Requisição</th>
            <th>Data de Saída</th>
            <th>Qtd</th>
            <th>Lote</th>
            <th>Validade</th>
            <th>Usuário</th>
        </tr>
        </thead>
        <tbody>
    @foreach($produtos->produtosaida as $saiproduto)
            <tr>
                    <td>
                        @if($saiproduto->pedido->tipopedido == 'unidade')
                            {{ $saiproduto->setor->setor }}
                        @else
                            {{ $saiproduto->pedido->externo }}
                        @endif
                    </td>
                    <td><a href="{{ route('pedido.show',$saiproduto->pedido_id) }}"> {{ $saiproduto->pedido->requisicao }} </a></td>
                    <td>{{ $saiproduto->pedido->datapedido or $saiproduto->created_at }}</td>
                    <td>{{ $saiproduto->qtd }}</td>
                    <td>{{ $saiproduto->obs or $saiproduto->lote }}</td>
                    <td>{{ $saiproduto->validade }}</td>
                    <td>{{ $saiproduto->user->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <div class="panel-footer">
    <b>Total de Saídas:</b> {{ $produtos->produtosaida->sum('qtd') }}
    @if($produtos->unidade == 'Grama')
        {{' | ' .  ($produtos->produtosaida->sum('qtd'))/1000 . 'Kg' }}
    @endif
    </div>
</div>

    
    {{--{!! $produtos->appends(\Request::except('page'))->render() !!}--}}
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#entradas').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                columnDefs: [
                    { type: 'date-eu', targets: 2 }
                ]
            } );
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('#saidas').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                columnDefs: [
                    { type: 'date-eu', targets: 2 }
                ]
            } );
        } );
    </script>
    <script>
        $(document).ready(function() {
            $('#demandas').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            } );
        } );
    </script>
@endsection