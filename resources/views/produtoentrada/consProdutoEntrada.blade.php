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

            <a href="{{route('estoque.entrada',$estoque_id)}}">
                <i class="fa fa-fw fa-truck fa-2x"></i>
            </a>

            <a href="{{route('estoque.saida',$estoque_id)}}">
                <i class="fa fa-fw fa-cart-arrow-down fa-2x"></i>
            </a>

            <a href="{{route('relposicaoestoque',$estoque_id)}}">
                <i class="fa fa-fw fa-file-text fa-2x"></i>
            </a>
        @else
        @endif
    @endforeach
    <br><br>
{{-- @permission('ver') --}}
    <a href="{{ route('createentrada',$estoque_id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
{{-- @endpermission --}}

    <br><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('produto.produto','Produto')</th>
            <th>@sortablelink('qtd','Qtd')</th>
            <th>@sortablelink('lote','Lote')</th>
            <th>@sortablelink('validade','Validade')</th>
            <th>@sortablelink('created_at','Data de Entrada')</th>
            <th>@sortablelink('obs','Observação')</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        @foreach ($produtoentradas as $produtoentrada)
            <tbody>
                <td>{{ $produtoentrada->produto->produto . ' (Cód. ' . $produtoentrada->produto->codigo . ')' }}</td>
                <td>{{ $produtoentrada->qtd }}</td>
                <td>{{ $produtoentrada->lote }}</td>
                <td>{{ $produtoentrada->validade }}</td>
                <td>{{ $produtoentrada->created_at }}</td>
                <td>{{ $produtoentrada->obs  }}</td>

                <td>
                    {{--@shield('produtoentrada.editar')--}}
                    {{--<a class = "btn btn-sm btn-default" href="{{ route('entrada.edit',$produtoentrada->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-pencil"></span>--}}
                    {{--</a>--}}
                    {{--@endshield--}}
                    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$produtoentrada->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>

                    <!-- Modal EXCLUIR-->
                    <div class="modal fade" id="excluir{{$produtoentrada->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    <div align="center">
                                        <b>{{ $produtoentrada->produto->produto }}</b>
                                        <br><br>
                                        Total: {{ $produtoentrada->qtd }}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['route'=> ['entrada.destroy',$produtoentrada->id], 'method'=>'DELETE']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tbody>

        @endforeach
    </table>
    {!! $produtoentradas->appends(\Request::except('page'))->render() !!}
@endsection
