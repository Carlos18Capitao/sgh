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

    @if (isset($estadocivils))
        {!! Form::model($estadocivils, ['route' => ['estadocivil.update', $estadocivils->id], 'class' => 'Form', 'method' => 'PUT']) !!}
{{--        {!! Form::hidden('updated_by',Auth::user()->name) !!}--}}
    @else
        {!! Form::open(['route' => 'estadocivil.store', 'class' => 'form']) !!}
{{--        {!! Form::hidden('created_by',Auth::user()->name) !!}--}}
    @endif

    <div class="form-group">
        {!! Form::label('descricao', 'Estado Civil:'); !!}
        {!! Form::text('descricao', null, ['class' => 'form-control', 'placeholder' => 'Estado Civil']) !!}
    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}

@endsection
