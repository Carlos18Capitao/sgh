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
    <br><br>
    <p><b>Descrição:</b> {{ $fornecedors->descricao }}</p>
    <p><b>CPF/CNPJ:</b> {{ $fornecedors->cpf_cnpj }}</p>
    <p><b>Categoria:</b> {{ $fornecedors->tipo_pessoa }}</p>
    <p><b>Dados bancarios:</b> {{ 'Banco: ' . $fornecedors->banco . '   Ag: ' . $fornecedors->agencia . '  C/C: ' . $fornecedors->conta }}</p>

    <hr>
<b> PROCESSOS </b>
    <table class="table table-striped">
    <thead>
    <tr>
        <th>@sortablelink('processo','Processo')</th>
        <th>@sortablelink('valor','Valor')</th>
        <th>@sortablelink('empenho','Empenho')</th>
        <th>@sortablelink('nf','Nota Fiscal')</th>
        <th>@sortablelink('emissaonf','Data Emissão NF')</th>
        <th width="150px">Ações</th>
    </tr>
    </thead>
@foreach($fornecedors->ordembancaria as $ob)
            <tbody>
                <td>{{ $ob->processo }}</td>
                <td>{{ $ob->valor_formatted }}</td>
                <td>{{ $ob->empenho }}</td>
                <td>{{ $ob->nf }}</td>
                <td>{{ $ob->emissaonf_formatted }}</td>
                <td>
                    <button type="button" title="ATUALIZAR DADOS" class="btn btn-sm btn-default" data-toggle="modal" data-target="#editar{{$ob->id}}"><span class="glyphicon glyphicon-plus"></span></button>
                    <a class="btn btn-sm btn-default" href="{{ route('ordembancaria.show',$ob->id) }}"><span class="glyphicon glyphicon-print"></span></button>


                    <!-- Modal CADASTRAR PROCESSO/EMPENHO/NF-->
                    <div class="modal fade" id="editar{{$ob->id}}" tabindex="-1" role="dialog" aria-labelledby="cadastrar">
                      {!! Form::model($ob, ['route' => ['ordembancaria.update', $ob->id], 'class' => 'Form', 'method' => 'PUT']) !!}

                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Cadastrar Processo</h4>
                                </div>
                                <div class="modal-body">
                                  {!! Form::hidden('updated_by',Auth::user()->id) !!}
                                  {{-- {!! Form::hidden('id',$ob->id) !!} --}}
                              <div class="form-group">
                                  {!! Form::label('processo', 'Processo:'); !!}
                                  {!! Form::text('processo', null, ['class' => 'form-control', 'placeholder' => 'Número do processo']) !!}
                              </div>
                              <div class="form-group">
                                  {!! Form::label('valor', 'Valor:'); !!}
                                  {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Valor']) !!}
                              </div>
                              <div class="form-group">
                                  {!! Form::label('empenho', 'Empenho:'); !!}
                                  {!! Form::text('empenho', null, ['class' => 'form-control', 'placeholder' => 'Empenho']) !!}
                              </div>
                              <div class="form-group">
                                  {!! Form::label('nf', 'Nota Fiscal:'); !!}
                                  {!! Form::text('nf', null, ['class' => 'form-control', 'placeholder' => 'Nota Fiscal']) !!}
                              </div>
                              <div class="form-group">
                                  {!! Form::label('emissaonf', 'Emissão NF:'); !!}
                                  {!! Form::date('emissaonf', null, ['class' => 'form-control', 'placeholder' => 'Emissão NF']) !!}
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
@endsection
