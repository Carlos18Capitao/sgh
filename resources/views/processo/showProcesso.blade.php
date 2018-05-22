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
    <p><h4><b>Processo: {{ $processos->numero }}</b></h4></p>
    <p><b>Categoria:</b> {{ $processos->categoria->descricao }}</p>
    <p><b>Observações:</b> {{ $processos->obs }} </p>

    <hr>



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

                        {!! Form::label('dataemissao', 'Data de Emissão:'); !!}
                        {!! Form::date('dataemissao', null, ['class' => 'form-control', 'placeholder' => 'Data','tabindex'=>'2']) !!}

                        {!! Form::label('valortotal', 'Valor do Empenho:'); !!}
                        {!! Form::text('valortotal', null, ['class' => 'form-control', 'placeholder' => 'Valor total','tabindex'=>'3']) !!}
                    </div>
                    <div class="form-group form-inline">
                        {!! Form::label('empresa_id', 'Fornecedor:'); !!}
                        <select style="width: 80%" class="js-fornecedor" id="js-fornecedor" name="empresa_id" tabindex="4">
                                <option selected="selected" value="">Selecione um fornecedor...</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}"> {{ $empresa->nome . ' - ' . $empresa->cnpj }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-inline">
                        {!! Form::label('fonte', 'Fonte:'); !!}
                        {!! Form::number('fonte', null, ['class' => 'form-control', 'placeholder' => 'Informe a fonte','tabindex'=>'5']) !!}

                        {!! Form::label('plano', 'Plano Orçamentário:'); !!}
                        {!! Form::number('plano', null, ['class' => 'form-control', 'placeholder' => 'Plano orçamentário','tabindex'=>'6']) !!}

                        {!! Form::label('modalidade', 'Modalidade:'); !!}
                        {!!Form::select('modalidade', ['Ordinario'=>'Ordinario','Global'=>'Global'], null, ['class' => 'form-control', 'placeholder' => 'Selecione a modalidade...','tabindex'=>'7']) !!}
                    </div>
                    <div class="form-group form-inline">    
                        {!! Form::label('setor', 'Unidade:'); !!}
                        @if (isset($empenho))
                            {!! Form::select('setor_id', $empenho->setor->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}
                        @else
                            {!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}
                        @endif
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

    <table class="table table-striped">
        </thead>
            <th>Empenho</th>
            <th>Data Emissão</th>
            <th>Modalidade</th>
            <th>Fornecedor</th>
            <th>Fonte</th>
            <th>Plano Orçamentário</th>
            <th>Unidade</th>
            <th>Valor</th>
        <thead>
{{--        {{ dd($processos) }}--}}
    @foreach($processos->empenho as $empenho)
        <tbody>
            <tr>
                 <td>{{ $empenho->nrempenho }}</td>
                 <td>{{ $empenho->dataemissao }}</td>
                 <td>{{ $empenho->modalidade }}</td>
                 <td>{{ $empenho->empresa->nome }}</td>
                 <td>{{ $empenho->fonte }}</td>
                 <td>{{ $empenho->plano }}</td>
                 <td>{{ $empenho->setor->setor }}</td>
                 <td>{{ 'R$ ' . $empenho->valortotal }}</td>
            </tr>
        </tbody>
    @endforeach
    </table>
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
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#js-fornecedor').select2({
                dropdownParent: $('#empenho')
            });
        });
    </script>
@endsection