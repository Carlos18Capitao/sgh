@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
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

    <b> SALDO POR LOTE </b>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Lote</th>
                <th>Validade</th>
                <th>Quantidade</th>
            </tr>
        </thead>
@foreach($produtos->lotes->sortBy('validade') as $lote)
        @if($lote->qtd != 0)
            <tbody>
                <td>{{ $lote->lote }}</td>
                <td>{{ $lote->validade_format }}</a></td>
                <td>{{ $lote->qtd }}</td>
        @endif
            </tbody>
@endforeach
    </table>

    <hr>
<b> ENTRADAS </b>
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
<b>Total de Entradas:</b> {{ $produtos->produtoentrada->sum('qtd') }}
  @if($produtos->unidade == 'Grama')
    {{' | ' . ($produtos->produtoentrada->sum('qtd'))/1000 . 'Kg'}}
  @endif
    <hr>

<b> SAÍDAS </b>
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
    <b>Total de Saídas:</b> {{ $produtos->produtosaida->sum('qtd') }}
    @if($produtos->unidade == 'Grama')
        {{' | ' .  ($produtos->produtosaida->sum('qtd'))/1000 . 'Kg' }}
    @endif
    <br><br>

    {{--@shield('produto.cadastrar')--}}
    {{--<a href="{{ route('produto.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>--}}
    {{--@endshield--}}
    {{--<br><br>--}}
    {{--<table class="table table-striped">--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>@sortablelink('produto','Produto')</th>--}}
            {{--<th>@sortablelink('categoria_id','Categoria')</th>--}}
            {{--<th>@sortablelink('unidade','Unidade')</th>--}}
            {{--<th width="100px">Ações</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--@foreach ($produtos as $produto)--}}
            {{--<tbody>--}}
                {{--<td><a href="{{ route('produto.show',$produto->id) }}">{{ $produto->produto }}</a></td>--}}
                {{--<td>{{ $produto->unidade }}</td>--}}
                {{--<td>{{ $produto->categoria->descricao  }}</td>--}}
                {{--<td>--}}
                    {{--@shield('produto.editar')--}}
                    {{--<a class = "btn btn-sm btn-default" href="{{ route('produto.edit',$produto->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-pencil"></span>--}}
                    {{--</a>--}}
                    {{--@endshield--}}
                    {{--<button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$produto->id}}">--}}
                        {{--<span class="glyphicon glyphicon-trash"></span>--}}
                    {{--</button>--}}
{{----}}
                    {{--<!-- Modal EXCLUIR-->--}}
                    {{--<div class="modal fade" id="excluir{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">--}}
                        {{--<div class="modal-dialog modal-lg" role="document">--}}
                            {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}
{{----}}
                                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                    {{--<h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>--}}
                                {{--</div>--}}
                                {{--<div class="modal-body">--}}
                                    {{--<div align="center">--}}
                                        {{--<b>{{ $produto->produto }}</b>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="modal-footer">--}}
                                    {{--{!! Form::open(['route'=> ['produto.destroy',$produto->id], 'method'=>'DELETE']) !!}--}}
                                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>--}}
                                    {{--<button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>--}}
                                    {{--{!! Form::close() !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</td>--}}
            {{--</tbody>--}}
{{----}}
        {{--@endforeach--}}
    {{--</table>--}}
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
@endsection