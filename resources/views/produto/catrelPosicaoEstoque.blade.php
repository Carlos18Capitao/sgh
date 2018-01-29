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

    {{--@foreach($estoques as $estoque)--}}
        {{--{{ $estoque->produto . ' - ' . $estoque->saldo }} <br>--}}
    {{--@endforeach--}}


    {{--{{ dd($estoques) }}--}}
    <ul class="nav nav-pills">

        <li role="presentation" class="active"><a href="{{ route('relposicaoestoque',$estoque_id) }}">Todos</a></li>
        @foreach ($categorias as $categoria)
            <li role="presentation"><a href="{{ url('estoque/' . $estoque_id . '/catrelposicaoestoque/' . $categoria->id) }}">{{ $categoria->descricao }}</a></li>
        @endforeach
    </ul>
    {{--@shield('produto.cadastrar')--}}
    {{--<a href="{{ route('produto.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>--}}
    {{--@endshield--}}
    <br><br>
    <table class="table table-striped">
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
        @foreach ($estoques as $estoque)

            <tbody>
            <td>{{ $estoque->descricao  }}</td>
            <td>{{ $estoque->codigo  }}</td>
            <td><a href="{{ route('produto.show',$estoque->produto_id) }}">{{ $estoque->produto }}</a></td>
            <td>{{ $estoque->unidade }}</td>
            <td>{{ $estoque->entradas - $estoque->saidas }} - {{ $estoque->entradas }} - {{ $estoque->saidas }}
                @if($estoque->unidade == 'Grama')
{{--                    {{ '  |  ' . ($estoque->saldo)/1000 .'kg' }}--}}
                @endif
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

                    <!-- Modal EXCLUIR-->
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
                    <!-- Modal EXCLUIR-->
                {{--</td>--}}
            </tbody>
          @endforeach
    </table>
    {{-- {!! $produtos->appends(\Request::except('page'))->render() !!} --}}
@endsection
