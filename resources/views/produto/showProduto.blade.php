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
<b> ENTRADAS </b>
    <table class="table table-striped">
    <thead>
    <tr>
        <th>Fornecedor</th>
        <th>Entrada</th>
        <th>@sortablelink('created_at','Data de Entrada')</th>
        <th>@sortablelink('qtd','Qtd')</th>
        <th>@sortablelink('lote','Lote')</th>
        <th>@sortablelink('validade','Validade')</th>
        <th>@sortablelink('created_by','Usuário')</th>
    </tr>
    </thead>
@foreach($produtos->produtoentrada as $entproduto)
    {{--{{ dd($entproduto) }}--}}
            <tbody>
                <td>{{ $entproduto->entrada->empresa->nome or 'UNCISAL' }}</td>
                <td><a href="{{ route('entrada.show',$entproduto->entrada_id) }}">{{ $entproduto->entrada->numeroentrada or ''}}</a></td>
                <td>{{ $entproduto->entrada->dataentrada or $entproduto->created_at}}</td>
                <td>{{ $entproduto->qtd }}
                <td>{{ $entproduto->lote }}
                <td>{{ $entproduto->validade }}
                <td>{{ $entproduto->user->name }}</td>

            </tbody>
@endforeach
    </table>
<b>Total de Entradas:</b> {{ $produtos->produtoentrada->sum('qtd') }}
  @if($produtos->unidade == 'Grama')
    {{' | ' . ($produtos->produtoentrada->sum('qtd'))/1000 . 'Kg'}}
  @endif
    <hr>

<b> SAÍDAS </b>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('setor_id','Setor')</th>
            <th>Requisição</th>
            <th>@sortablelink('created_at','Data de Saída')</th>
            <th>@sortablelink('qtd','Qtd')</th>
            <th>@sortablelink('obs','Lote/Obs')</th>
            <th>@sortablelink('created_by','Usuário')</th>
        </tr>
        </thead>
        @foreach($produtos->produtosaida as $saiproduto)
            <tbody>
                @if($saiproduto->qtd > 0)
                    <td>{{ $saiproduto->setor->setor }}</td>
                    <td><a href="{{ route('pedido.show',$saiproduto->pedido_id) }}"> {{ $saiproduto->pedido->requisicao }} </a></td>
                    <td>{{ $saiproduto->pedido->datapedido or $saiproduto->created_at }}</td>
                    <td>{{ $saiproduto->qtd }}
                    <td>{{ $saiproduto->obs }}
                    <td>{{ $saiproduto->user->name }}</td>
                @endif
            </tbody>
        @endforeach
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
