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

    @if (isset($tipoaltas))
        {!! Form::model($tipoaltas, ['route' => ['tipoalta.update', $tipoaltas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
       {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'tipoalta.store', 'class' => 'form']) !!}
       {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif
<form class="inline">

    <div class="form-group">
        {!! Form::label('descricao', 'Descrição do Tipo de Alta:'); !!}
        {!! Form::text('descricao', null, ['class' => 'form-control', 'placeholder' => 'Tipo de Alta']) !!}
        {!! Form::label('codigo', 'Código:'); !!}
        {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Código']) !!}
    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}

@endsection
