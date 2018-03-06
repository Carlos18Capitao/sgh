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
    <hr>
          <a class = "btn btn-sm btn-default" title="EDITAR" href="{{ route('processo.edit',$processos->id)}}">
            <span class="glyphicon glyphicon-pencil"></span>
          </a>
    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$processos->id}}">
        <span class="glyphicon glyphicon-trash"></span>
    </button>
    <button type="button" title="CADASTRAR EMPENHO" class="btn btn-sm btn-default" data-toggle="modal" data-target="#empenho">
        <span class="glyphicon glyphicon-file"></span>
    </button>
    <br><br>
    {{--<p><b>ID:</b> {{ $processos->id }}</p>--}}
    <p><b>Processo:</b> {{ $processos->numero . ' (' . $processos->categoria->descricao . ')'}}</p>
    <p><b>Observações:</b> {{ $processos->obs }} </p>

    <hr>

    {{--<table class="table table-striped">--}}
        {{--<tr>--}}
            {{-- <th>ID</th> --}}
            {{--<th>Objeto</th>--}}
            {{--<th>Ata</th>--}}
            {{--<th>Vigência</th>--}}
            {{--<th>Expira em</th>--}}
            {{--<th width="150px">Abrir Processo</th>--}}
        {{--</tr>--}}
        {{--@foreach ($fornecedors->atas as $ata)--}}
            {{--<tr>--}}
                {{-- <td>{{ $unidade->id }}</td> --}}

                {{--<td>{{ $ata->objeto->objeto }}</td>--}}
                {{--<td><a href="{{ route('ata.show', $ata->id)}}"> {{ $ata->arp }} </a></td>--}}
                {{--<td>{{ $ata->vigencia->format('d/m/Y') }}</td>--}}
                {{--<td>{{ $ata->vigencia->diffInDays($hoje)}} dias</td>--}}

                {{--<td>--}}
                    {{--@shield('processo.cadastrar')--}}
                    {{--<a class = "btn btn-sm btn-default" title="CADASTRAR PROCESSO" href="{{ route('processo.show', $ata->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-folder-open"></span>--}}
                    {{--</a>--}}
                    {{--@endshield--}}
                     {{--<a class = "btn btn-sm btn-default" title="COPIAR DADOS PARA ENVIO DE EMPENHO" href="{{ route('fornecedor.memo', $ata->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-copy"></span>--}}
                    {{--</a>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{----}}
        {{--@endforeach--}}
    {{--</table>--}}

    <!-- Modal EXCLUIR-->
    <div class="modal fade" id="excluir{{$processos->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                </div>
                <div class="modal-body">
                    <div align="center">
                        <b>Processo nº {{ $processos->numero }}</b>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['route'=> ['processo.destroy',$processos->id], 'method'=>'DELETE']) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal EXCLUIR-->

     <!-- Modal CADASTRAR-->
    <div class="modal fade" id="empenho" tabindex="-1" role="dialog" aria-labelledby="empenho">
        {!! Form::open(['route' => 'empenho.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Empenho</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!!  Form::hidden('processo_id', $processos->id) !!}

                        {!! Form::hidden('created_by',Auth::user()->id) !!}
                    </div>
                    <div class="form-group form-inline">
                        {!! Form::label('nrempenho', 'Empenho:'); !!}
                        {!! Form::text('nrempenho', null, ['class' => 'form-control', 'placeholder' => '0000NE00000','tabindex'=>'1']) !!}

                        {!! Form::label('dataempenho', 'Data de Emissão:'); !!}
                        {!! Form::date('dataempenho', null, ['class' => 'form-control', 'placeholder' => 'Data','tabindex'=>'2']) !!}

                        {!! Form::label('valortotal', 'Valor do Empenho:'); !!}
                        {!! Form::number('valortotal', null, ['class' => 'form-control', 'placeholder' => 'Valor total','tabindex'=>'3']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('empresa_id', 'Fornecedor:'); !!} <br>
                        {!!Form::select('empresa_id', $empresas->pluck('nome','id'), null, ['class' => 'js-fornecedor form-control', 'placeholder' => 'Selecione um fornecedor...','tabindex'=>'4']) !!}

                    </div>
                    <div class="form-group form-inline">
                        {!! Form::label('fonte', 'Fonte:'); !!}
                        {!! Form::number('fonte', null, ['class' => 'form-control', 'placeholder' => 'Informe a fonte','tabindex'=>'5']) !!}

                        {!! Form::label('plano', 'Plano Orçamentário:'); !!}
                        {!! Form::number('plano', null, ['class' => 'form-control', 'placeholder' => 'Plano orçamentário','tabindex'=>'6']) !!}

                        {!! Form::label('modalidade', 'Modalidade:'); !!}
                        {!!Form::select('modalidade', ['Ordinario'=>'Ordinario','Global'=>'Global'], null, ['class' => 'form-control', 'placeholder' => 'Selecione a modalidade...','tabindex'=>'7']) !!}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <!-- Modal CADASTRAR-->

    <hr>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#js-fornecedor').select2({
                dropdownParent: $('#myModalCadastrar')
            });
        });
    </script>
@endsection