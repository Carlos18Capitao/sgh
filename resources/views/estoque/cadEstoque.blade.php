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

    @if (isset($estoques))
        {!! Form::model($estoques, ['route' => ['estoque.update', $estoques->id], 'class' => 'Form', 'method' => 'PUT']) !!}
       {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'estoque.store', 'class' => 'form']) !!}
       {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif
<form class="inline">

    <div class="form-group">
        {!! Form::label('descricao', 'Estoque:'); !!}
        {!! Form::text('descricao', null, ['class' => 'form-control', 'placeholder' => 'Estoque']) !!}
        {!! Form::label('lote', 'Controla Lote?'); !!}
      @if (isset($estoques))
        @if ($estoques->lote == 1)
          {!! Form::select('lote', ['1'=>'Sim','0'=>'Não'],null, ['class' => 'form-control']) !!}
        @else
          {!! Form::select('lote', ['0'=>'Não','1'=>'Sim'],null, ['class' => 'form-control']) !!}
        @endif
      @else
        {!! Form::select('lote', ['1'=>'Sim','0'=>'Não'],null, ['class' => 'form-control']) !!}
      @endif
      
      {!! Form::label('validade', 'Controla Validade?'); !!}
      @if (isset($estoques))
        @if ($estoques->validade == 1)
          {!! Form::select('validade', ['1'=>'Sim','0'=>'Não'], null, ['class' => 'form-control']) !!}
        @else
          {!! Form::select('validade', ['0'=>'Não','1'=>'Sim'], null, ['class' => 'form-control']) !!}
        @endif
      @else
        {!! Form::select('validade', ['1'=>'Sim','0'=>'Não'],null, ['class' => 'form-control']) !!}
      @endif

    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}

@endsection
