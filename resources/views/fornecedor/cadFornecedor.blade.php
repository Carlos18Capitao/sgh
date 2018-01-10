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

    @if (isset($fornecedors))
        {!! Form::model($fornecedors, ['route' => ['fornecedor.update', $fornecedors->id], 'class' => 'Form', 'method' => 'PUT']) !!}
       {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'fornecedor.store', 'class' => 'form']) !!}
       {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('descricao', 'Fornecedor:'); !!}
        {!! Form::text('descricao', null, ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tipo_pessoa', 'Tipo:'); !!}
        {!! Form::select('tipo_pessoa', ['fisica'=>'Física','juridica'=>'Jurídica'],null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cpf_cnpj', 'CPF/CNPJ:'); !!}
        {!! Form::text('cpf_cnpj', null, ['class' => 'form-control', 'placeholder' => 'CPF/CNPJ']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('passnf', 'Senha para emissão de NF:'); !!}
        {!! Form::text('passnf', null, ['class' => 'form-control', 'placeholder' => 'Senha para emissão de NF']) !!}
    </div>
    <hr>
    <p><b>DADOS BANCÁRIOS:</b></p>
    <div class="form-group form-inline">

    <div class="form-group">
        {!! Form::label('banco', 'Banco:'); !!}
        {!! Form::number('banco', null, ['class' => 'form-control', 'placeholder' => 'Código do Banco']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('agencia', 'Agência:'); !!}
        {!! Form::text('agencia', null, ['class' => 'form-control', 'placeholder' => 'Agência']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('conta', 'Conta Corrente:'); !!}
        {!! Form::text('conta', null, ['class' => 'form-control', 'placeholder' => 'Número da Conta']) !!}
    </div>
  </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}



@endsection
