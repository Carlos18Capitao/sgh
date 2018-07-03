@extends('adminlte::page')

@section('content')

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>{{ $title }}</b></h3>
        </div>
        <div class="panel-body">
            @if (isset($entradas))
                {!! Form::model($entradas, ['route' => ['entrada.update', $entradas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
                {!! Form::hidden('updated_by',Auth::user()->id) !!}
            @else
                {!! Form::open(['route' => 'entrada.storeentradaempenho', 'class' => 'form']) !!}
                {!! Form::hidden('created_by',Auth::user()->id) !!}
            @endif
                {!! Form::hidden('estoque_id', $estoque_id) !!}


                <div class="form-group form-inline">
                {!! Form::label('estoque', 'Estoque:'); !!}
                @foreach($estoques as $estoque)
                    {!! Form::text('estoque',$estoque->descricao,['class'=>'form-control','disabled']) !!}
                @endforeach

                {!! Form::label('tipoentrada', 'Tipo de Entrada:'); !!}
                {!! Form::select('tipoentrada', ['nf'=>'Nota Fiscal','remessa'=>'Remessa','bonificacao'=>'Bonificação'], null, ['class' => 'js-entrada form-control', 'placeholder' => 'Tipo de entrada...']) !!}
            </div>


            <div class="form-group form-inline">
                {!! Form::label('empresa_id', 'Fornecedor:'); !!}
                @if (isset($entradas))
                    {!! Form::select('empresa_id', $entradas->empresa->pluck('nome','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione o fornecedor...', 'disabled']) !!}
                @else
                    <select class="js-empresa form-control" id="empresa_id" name="empresa_id" tabindex="-1">
                        <option selected="selected" value="">Selecione o fornecedor...</option>
                        @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nome . ' - ' . $empresa->cnpj }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="form-group form-inline">
                {!! Form::label('empenho_id', 'Empenho:'); !!}
                <select id="empenho_id" name="empenho_id" class="form-control js-empenho">
                    <option disabled selected>Selecione o Empenho</option>
                </select>


                {!! Form::label('dataentrada', 'Data da Entrada:'); !!}
                @if (isset($entradas))
                    <input class="form-control" name="dataentrada" type="text" value="{{$entradas->dataentrada}}" id="dataentrada" disabled>
                @else
                    {!! Form::date('dataentrada', null, ['class' => 'form-control']) !!}
                @endif

                {{--{!! Form::label('setor', 'Unidade:'); !!}--}}
                {{--@if (isset($pedidos))--}}
                {{--{!! Form::select('setor_id', $pedidos->setor->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}--}}
                {{--@else--}}
                {{--{!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}--}}
                {{--@endif--}}

                {!! Form::label('numeroentrada', 'Documento Entrada:'); !!}
                {!! Form::text('numeroentrada',null,['class'=>'form-control','placeholder'=>'Informe o número do documento']) !!}

            </div>

            <div class="panel-footer">

                {!! Form::submit('Adicionar Produtos >>', ['class' => 'btn btn-primary']) !!}
                {{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Incluir Produtos</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-empresa').select2(),
                $('.js-empenho').select2(),
                $('.js-entrada').select2();
        });
    </script>

    <script type="text/javascript">
        $("select[name='empresa_id']").change(function(){
            var empresa_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('ajaxEmpenho') ?>",
                method: 'POST',
                data: {empresa_id:empresa_id, _token:token},
                success: function(data) {
                    $("select[name='empenho_id'").html('');
                    $("select[name='empenho_id'").html(data.options);
                }
            });
        });
    </script>
@endsection
