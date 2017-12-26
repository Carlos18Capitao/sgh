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


    {{--@shield('produto.cadastrar')--}}
    {{--<a href="{{ route('produto.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>--}}
    {{--@endshield--}}
    <br><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('categoria_id','Categoria')</th>
            <th>@sortablelink('produto','Produto')</th>
            <th>@sortablelink('unidade','Unidade')</th>
            <th>Estoque Atual</th>
            {{--<th width="100px">Ações</th>--}}
        </tr>
        </thead>
{{-- {{ $estoque_id }} --}}
        {{-- {{ dd($estoques) }} --}}
        @foreach ($produtos as $produto)

            @foreach ($produto->produtoentrada as $entrada)
            @foreach ($produto->produtosaida as $saida)

              @if($entrada->estoque_id == $estoque_id && $saida->estoque_id == $estoque_id or $produto->id !== $entrada->estoque_id)
                  {{-- {{$entrada->estoque_id}} --}}

            {{-- @endif --}}

            <tbody>
            <td>{{ $produto->categoria->descricao  }}</td>
            <td><a href="{{ route('produto.show',$produto->id) }}">{{ $produto->produto }}</a></td>
            <td>{{ $produto->unidade }}</td>
            <td>{{ $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') }}</td>
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
            </tbody>
          @endif

        @endforeach
        @endforeach

        @endforeach
    </table>
    {{-- {!! $produtos->appends(\Request::except('page'))->render() !!} --}}
@endsection