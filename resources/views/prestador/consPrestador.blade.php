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

    {{--@shield('prestador.cadastrar')--}}
    <a href="{{ route('prestador.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    {{--@endshield--}}
    <br><br>
    <table class="table table-striped">
      <thead>
        <tr>
            <th>@sortablelink('descricao','Descrição')</th>
            <th>@sortablelink('cnes','CNES')</th>
            <th>@sortablelink('assistente','Assistente')</th>
            <th>@sortablelink('executante','Executante')</th>
            <th>@sortablelink('tipo_prestador_id','Tipo')</th>
            <th>@sortablelink('ala_id','Ala')</th>
            <th>@sortablelink('telefone','Telefone')</th>
            <th width="100px">Ações</th>
        </tr>
      </thead>
        @foreach ($prestadors as $prestador)
          <tbody>
            <tr>
              <td>{{ $prestador->nome }}</td>
              <td>{{ $prestador->cnes }}</td>
              <td>{{ $prestador->assistente }}</td>
              <td>{{ $prestador->executante }}</td>
              <td>{{-- $prestador->tipo_prestador_id --}}  {{-- $prestador->tipoprestador->descricao --}}</td>
              <td>{{ $prestador->ala->descricao }}</td>
              <td>{{ $prestador->telefone }}</td>
              <td>
                    {{--@shield('prestador.editar')--}}
                    <a class = "btn btn-sm btn-default" href="{{ route('prestador.edit',$prestador->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    {{--@endshield--}}
                    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$prestador->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>

                    <!-- Modal EXCLUIR-->
                    <div class="modal fade" id="excluir{{$prestador->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    <div align="center">
                                        <b>{{ $prestador->nome }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['route'=> ['prestador.destroy',$prestador->id], 'method'=>'DELETE']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </td>
            </tr>
          </tbody>
        @endforeach
    </table>

    {!! $prestadors->appends(\Request::except('page'))->render() !!}

@endsection
