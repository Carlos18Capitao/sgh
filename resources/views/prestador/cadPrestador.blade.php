@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
    </div>

    {{--@shield('unidade.cadastrar')--}}

    @if (isset($prestadors))
        {!! Form::model($prestadors, ['route' => ['prestador.update', $prestadors->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'prestador.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('nome', 'Nome do Prestador:'); !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome do Prestador']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cnes', 'Número CNES:'); !!}
        {!! Form::text('cnes', null, ['class' => 'form-control', 'placeholder' => 'CNES do Prestador']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('assistente', 'Assistente?'); !!}
        {!! Form::radio('assistente','1'); !!}
        {!! Form::label('sim', 'Sim'); !!}
        {!! Form::radio('assistente','0'); !!}
        {!! Form::label('nao', 'Não'); !!}
    </div>
    <div class="form-group">
        {!! Form::label('executante', 'Executante?'); !!}
        {!! Form::radio('executante','1'); !!}
        {!! Form::label('sim', 'Sim'); !!}
        {!! Form::radio('executante','0'); !!}
        {!! Form::label('nao', 'Não'); !!}
    </div>
    <div class="form-group">
        {!! Form::label('ala_id', 'Ala:'); !!}
        {!! Form::text('ala_id', null, ['class' => 'form-control', 'placeholder' => 'Ala']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tipo_prestador_id', 'Tipo de Prestador:'); !!}
        {!! Form::text('tipo_prestador_id', null, ['class' => 'form-control', 'placeholder' => 'Tipo de Prestador']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('telefone', 'Telefone:'); !!}
        {!! Form::text('telefone', null, ['class' => 'form-control', 'placeholder' => 'Telefone']) !!}
    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}
    {{--@endshield--}}

@endsection
