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

    <a href="{{ route('tipoalta.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    <br><br>
    <table class="table table-striped">
        <thead>
        <tr>
            {{-- <th width="50px">@sortablelink('id','#')</th> --}}
            <th width="80px">@sortablelink('codigo','Código')</th>
            <th>@sortablelink('descricao','Descrição')</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        @foreach ($tipoaltas as $tipoalta)
            <tbody>
                {{-- <td>{{ $tipoalta->id }}</td> --}}
                <td>{{ $tipoalta->codigo }}</td>
                <td>{{ $tipoalta->descricao }}</td>
                <td>
                    {{--@shield('tipoalta.editar')--}}
                    <a class = "btn btn-sm btn-default" href="{{ route('tipoalta.edit',$tipoalta->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    {{--@endshield--}}
                    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$tipoalta->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>

                    <!-- Modal EXCLUIR-->
                    <div class="modal fade" id="excluir{{$tipoalta->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    <div align="center">
                                        <b>{{ $tipoalta->descricao }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['route'=> ['tipoalta.destroy',$tipoalta->id], 'method'=>'DELETE']) !!}
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
    {!! $tipoaltas->appends(\Request::except('page'))->render() !!}
@endsection
