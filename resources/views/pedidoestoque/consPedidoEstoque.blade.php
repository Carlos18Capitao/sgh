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

    <a href="{{ route('create',$estoque_id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>

    <br><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('id','Código')</th>
            <th>@sortablelink('datapedido','Data')</th>
            <th>@sortablelink('setor_id','Setor')</th>
            <th>@sortablelink('created_by','Usuário')</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        @foreach ($pedidos as $pedido)
            <tbody>
            <td><a href="{{ route('pedido.show',$pedido->id) }}">{{ $pedido->id }}</a></td>
            <td>{{ $pedido->datapedido }}</td>
            <td>{{ $pedido->setor_id  }}</td>
            <td>{{ $pedido->created_by  }}</td>
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
