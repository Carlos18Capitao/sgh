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

    {{--@shield('produtosaida.cadastrar')--}}
    <a href="{{ route('create',$estoque_id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    {{--@endshield--}}
    <br><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('produto_id','Produto')</th>
            <th>@sortablelink('qtd','Qtd')</th>
            <th>@sortablelink('setor_id','Setor')</th>
            <th>@sortablelink('created_at','Data de Saída')</th>
            <th>@sortablelink('obs','Observação')</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        @foreach ($produtosaidas as $produtosaida)
            <tbody>
                <td>{{ $produtosaida->produto->produto }}</td>
                <td>{{ $produtosaida->qtd }}</td>
                <td>{{ $produtosaida->setor->setor }}</td>
                <td>{{ $produtosaida->created_at }}</td>
                <td>{{ $produtosaida->obs  }}</td>
                <td>
                    {{--@shield('produtosaida.editar')--}}
                    <a class = "btn btn-sm btn-default" href="{{ route('saida.edit',$produtosaida->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    {{--@endshield--}}
                    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$produtosaida->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>

                    <!-- Modal EXCLUIR-->
                    <div class="modal fade" id="excluir{{$produtosaida->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    <div align="center">
                                        <b>{{ $produtosaida->produtosaida }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['route'=> ['saida.destroy',$produtosaida->id], 'method'=>'DELETE']) !!}
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
    {!! $produtosaidas->appends(\Request::except('page'))->render() !!}
@endsection
