@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
    </div>


    {{-- <pagina tamanho="12">
        <painel titulo="{{ $title }}"> --}}

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <a href="{{ route('setor.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    <br><br>
    <table id="setor" class="table table-striped">
        <thead>
        <tr>
            <th>Setor</th>
            <th>Ramal</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($setors as $setor)
            <tr>
            <td><a href="{{ route('setor.show',$setor->id) }}">{{ $setor->setor }}</a></td>
                <td>{{ $setor->ramal }}</td>
                <td>
                    {{--@shield('setor.editar')--}}
                    <a class = "btn btn-sm btn-default" href="{{ route('setor.edit',$setor->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    {{--@endshield--}}
                    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$setor->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>

                    <!-- Modal EXCLUIR-->
                    <div class="modal fade" id="excluir{{$setor->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    <div align="center">
                                        <b>{{ $setor->setor }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['route'=> ['setor.destroy',$setor->id], 'method'=>'DELETE']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {{--{!! $setors->appends(\Request::except('page'))->render() !!}--}}

    {{-- </painel>
  </pagina> --}}
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#setor').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            } );
        } );
    </script>
@endsection