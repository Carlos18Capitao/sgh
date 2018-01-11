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

    <a href="{{ route('fornecedor.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    <br><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('descricao','Descrição')</th>
            <th>@sortablelink('cpf_cnpj','CPF/CNPJ')</th>
            <th>@sortablelink('tipo_pessoa','Tipo de Pessoa')</th>
            <th width="150px">Ações</th>
        </tr>
        </thead>
        @foreach ($fornecedors as $fornecedor)
            <tbody>
                <td><a href="{{ route('fornecedor.show',$fornecedor->id)}}">{{ $fornecedor->descricao }}</a></td>
                <td>{{ $fornecedor->cpf_cnpj }}
                  @if(!empty($fornecedor->passnf))
                    <button type="button" class="btn btn-sm btn-default" data-container="body" data-toggle="popover" data-placement="right" data-content="{{ $fornecedor->passnf }}">  NF </button>
                  @endif

                </td>
                <td>{{ $fornecedor->tipo_pessoa }}</td>
                <td>
                  <button type="button" title="CADASTRAR PROCESSO" class="btn btn-sm btn-default" data-toggle="modal" data-target="#cadastrar{{$fornecedor->id}}">
                      <span class="glyphicon glyphicon-plus"></span>
                  </button>
                    <a class = "btn btn-sm btn-default" href="{{ route('fornecedor.edit',$fornecedor->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$fornecedor->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>

                    <!-- Modal EXCLUIR-->
                    <div class="modal fade" id="excluir{{$fornecedor->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    <div align="center">
                                        <b>{{ $fornecedor->descricao }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['route'=> ['fornecedor.destroy',$fornecedor->id], 'method'=>'DELETE']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal CADASTRAR PROCESSO-->
                    <div class="modal fade" id="cadastrar{{$fornecedor->id}}" tabindex="-1" role="dialog" aria-labelledby="cadastrar">
                      {!! Form::open(['route' => 'ordembancaria.store', 'class' => 'form']) !!}

                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Cadastrar Processo</h4>
                                </div>
                                <div class="modal-body">
                                  {!! Form::hidden('created_by',Auth::user()->id) !!}
                                  {!! Form::hidden('fornecedor_id',$fornecedor->id) !!}
                              <div class="form-group">
                                  {!! Form::label('processo', 'Processo:'); !!}
                                  {!! Form::text('processo', null, ['class' => 'form-control', 'placeholder' => 'Número do processo']) !!}
                              </div>
                              <div class="form-group">
                                  {!! Form::label('valor', 'Valor:'); !!}
                                  {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Valor']) !!}
                              </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class = "btn btn-primary"> <span class="glyphicon glyphicon-plus"></span> Salvar </button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tbody>

        @endforeach
    </table>
    {{-- {!! $fornecedors->appends(\Request::except('page'))->render() !!} --}}
  @endsection


@section('js')
    <script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover();
      });
    </script>
@endsection
