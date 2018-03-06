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

    @if (isset($processos))
        {!! Form::model($processos, ['route' => ['processo.update', $processos->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'processo.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('numero', 'Processo:'); !!}
        {!! Form::text('numero', null, ['class' => 'form-control', 'placeholder' => 'número/ano']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('obs', 'Observação:'); !!}
        {!! Form::text('obs', null, ['class' => 'form-control', 'placeholder' => 'Observações']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('categoria_id', 'Categoria:'); !!}
        {!! Form::select('categoria_id', $categorias->pluck('descricao','id'), null, ['class' => 'js-categoria form-control','placeholder' => 'Selecione uma categoria...']) !!}
    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.js-categoria').select2();
        });
    </script>
@endsection
