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

    @if (isset($empresas))
        {!! Form::model($empresas, ['route' => ['empresa.update', $empresas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'empresa.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('empresa', 'Fornecedor:'); !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Fornecedor']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cnpj', 'CNPJ:'); !!}
        {!! Form::text('cnpj', null, ['class' => 'form-control', 'placeholder' => 'CNPJ','id'=>'cnpj']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'E-mail:'); !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('telefone', 'Telefone:'); !!}
        {!! Form::text('telefone', null, ['class' => 'form-control', 'placeholder' => 'Telefone']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('responsavel', 'Responsável:'); !!}
        {!! Form::text('responsavel', null, ['class' => 'form-control', 'placeholder' => 'Nome do Responsável']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('endereco', 'Endereço:'); !!}
        {!! Form::textarea('endereco', null, ['class' => 'form-control', 'placeholder' => 'Endereço']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('area', 'Área de atuação/Observações:'); !!}
        {!! Form::textarea('area', null, ['class' => 'form-control', 'placeholder' => 'Observações']) !!}
    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@endsection
