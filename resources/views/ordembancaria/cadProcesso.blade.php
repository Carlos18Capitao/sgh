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

    @if (isset($ordembancarias))
        {!! Form::model($ordembancarias, ['route' => ['ordembancaria.update', $ordembancarias->id], 'class' => 'Form', 'method' => 'PUT']) !!}
       {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'ordembancaria.store', 'class' => 'form']) !!}
       {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('processo', 'Processo:'); !!}
        {!! Form::text('processo', null, ['class' => 'form-control', 'placeholder' => 'Número do processo']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('valor', 'Valor:'); !!}
        {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Valor']) !!}
    </div>

    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@endsection
