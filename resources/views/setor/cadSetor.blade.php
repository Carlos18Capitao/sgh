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

    @if (isset($setors))
        {!! Form::model($setors, ['route' => ['setor.update', $setors->id], 'class' => 'Form', 'method' => 'PUT']) !!}
{{--        {!! Form::hidden('updated_by',Auth::user()->name) !!}--}}
    @else
        {!! Form::open(['route' => 'setor.store', 'class' => 'form']) !!}
{{--        {!! Form::hidden('created_by',Auth::user()->name) !!}--}}
    @endif

    <div class="form-group">
        {!! Form::label('setor', 'Setor:'); !!}
        {!! Form::text('setor', null, ['class' => 'form-control', 'placeholder' => 'Setor']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sigla', 'Sigla:'); !!}
        {!! Form::text('sigla', null, ['class' => 'form-control', 'placeholder' => 'Sigla']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('ramal', 'Ramal:'); !!}
        {!! Form::text('ramal', null, ['class' => 'form-control', 'placeholder' => 'Ramal']) !!}
    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}

@endsection
