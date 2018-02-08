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
    <a href="{{ route('create',$estoque_id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>

    <br><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('id','Código')</th>
            <th>@sortablelink('datapedido','Data')</th>
            <th>@sortablelink('setor_id','Unidade')</th>
            <th>@sortablelink('requisicao','SIAPNET/e-SIS')</th>
            {{--<th>@sortablelink('created_by','Usuário')</th>--}}
            <th width="100px">Ações</th>
        </tr>
        </thead>
        @foreach ($pedidos as $pedido)
            <tbody>
            <td><a href="{{ route('pedido.show',$pedido->id) }}">{{ $pedido->id }}</a></td>
            <td>{{ $pedido->datapedido }}</td>
            <td>{{ $pedido->setor->setor  }}</td>
            <td>{{ $pedido->requisicao  }}</td>
{{--            <td>{{ $pedido->created_by  }}</td>--}}
            <td>
                <a class = "btn btn-sm btn-default" href="{{ route('pedido.edit',$pedido->id)}}">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$pedido->id}}">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>

                <!-- Modal EXCLUIR-->
                <div class="modal fade" id="excluir{{$pedido->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                            </div>
                            <div class="modal-body">
                                <div align="center">
                                    <b>Código do Pedido: {{ $pedido->id }}</b>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!! Form::open(['route'=> ['produto.destroy',$pedido->id], 'method'=>'DELETE']) !!}
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
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-setor').select2()
            ;
        });
    </script>
@endsection
