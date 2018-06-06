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

    @foreach (Auth::user()->estoques as $stoq)
        @if ($estoque_id == $stoq->pivot->estoque_id)

            {{-- @if($estoque->id == Auth::user()->user_estoques->id) --}}
                <a href="{{route('estoque.menu',$estoque_id)}}">
                    <i class="glyphicon glyphicon-th-large fa-2x"></i>
                </a>

                <a href="{{route('estoque.entrada',$estoque_id)}}">
                    <i class="fa fa-fw fa-truck fa-2x"></i>
                </a>

                <a href="{{route('estoque.saida',$estoque_id)}}">
                    <i class="fa fa-fw fa-cart-arrow-down fa-2x"></i>
                </a>

                <a href="{{route('relposicaoestoque',$estoque_id)}}">
                    <i class="fa fa-fw fa-file-text fa-2x"></i>
                </a>
            <a title="IMPRIMIR" href="{{ route('pdfposicaoestoquesemzero',$estoque_id)}}">
                <i class="fa fa-fw fa-print fa-2x"></i>
            </a>
           @else
        @endif
    @endforeach
    <div align = "right"><b><a href="{{ route('relposicaoestoque',$estoque_id) }}">Exibir todos os itens</a></b></div>

    {{--@shield('produto.cadastrar')--}}
    {{--<a href="{{ route('produto.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>--}}
    {{--@endshield--}}
    <br>
    <table id="estoques" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Categoria</th>
            <th>Código</th>
            <th>Produto</th>
            <th>Unidade</th>
            <th>Estoque Atual</th>
            {{--<th width="100px">Ações</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach ($estoques as $estoque)

          @foreach ($estoque->produto as $produto)
            @if(($produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd')) > 0)
            <tr>
            <td>{{ $produto->categoria->descricao  }}</td>
            <td>{{ $produto->codigo }}</td>
            <td><a href="{{ route('produto.show',$produto->id) }}">{{ $produto->produto }}</a></td>
          {{--  <td>{{ $produto->produto }}</td>--}}
            <td>{{ $produto->unidade }}</td>
            <td>{{ $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') }}
            </td>
                {{--<td>--}}
                    {{--@shield('produto.editar')--}}
                    {{--<a class = "btn btn-sm btn-default" href="{{ route('produto.edit',$produto->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-pencil"></span>--}}
                    {{--</a>--}}
                    {{--@endshield--}}
                    {{--<button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$produto->id}}">--}}
                        {{--<span class="glyphicon glyphicon-trash"></span>--}}
                    {{--</button>--}}

                    {{--<!-- Modal EXCLUIR-->--}}
                    {{--<div class="modal fade" id="excluir{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">--}}
                        {{--<div class="modal-dialog modal-lg" role="document">--}}
                            {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}

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
                                </tr>
            @endif
          @endforeach

        @endforeach
        </tbody>        
    </table>
    {{-- {!! $produtos->appends(\Request::except('page'))->render() !!} --}}
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#estoques').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            } );
        } );
    </script>
@endsection