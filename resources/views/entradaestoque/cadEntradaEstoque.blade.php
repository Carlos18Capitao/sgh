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

    @if (isset($entradas))
        {!! Form::model($entradas, ['route' => ['entrada.update', $entradas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'pedido.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif
        {!! Form::hidden('estoque_id', $estoque_id) !!}

    <div class="form-group form-inline">
        {!! Form::label('estoque', 'Estoque:'); !!}
        @foreach($estoques as $estoque)
            {!! Form::text('estoque',$estoque->descricao,['class'=>'form-control','disabled']) !!}
        @endforeach
    </div>


    <div class="form-group form-inline">
        {!! Form::label('empresa_id', 'Fornecedor:'); !!}
        @if (isset($entradas))
            {!! Form::select('empresa_id', $entradas->empresa->pluck('nome','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione o fornecedor...']) !!}
        @else
            {!! Form::select('empresa_id', $empresas->pluck('nome','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione o fornecedor...']) !!}
        @endif
    </div>

        <div class="form-group form-inline">
            {!! Form::label('tipoentrada', 'Tipo de Entrada:'); !!}
            {!! Form::select('tipoentrada', ['nf'=>'Nota Fiscal','remessa'=>'Remessa','doacao'=>'Doação','permuta'=>'Permuta'], null, ['class' => 'js-setor form-control', 'placeholder' => 'Tipo de entrada...']) !!}

            {!! Form::label('dataentrada', 'Data da Entrada:'); !!}
            {!! Form::date('dataentrada', null, ['class' => 'form-control']) !!}

            {{--{!! Form::label('setor', 'Unidade:'); !!}--}}
            {{--@if (isset($pedidos))--}}
                {{--{!! Form::select('setor_id', $pedidos->setor->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}--}}
            {{--@else--}}
                {{--{!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}--}}
            {{--@endif--}}

            {!! Form::label('numeroentrada', 'Documento Entrada:'); !!}
            {!! Form::text('numeroentrada',null,['class'=>'form-control','placeholder'=>'Informe o número do documento']) !!}

        </div>


    {!! Form::submit('Adicionar Produtos >>', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Incluir Produtos</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-setor').select2();
        });
    </script>
@endsection
