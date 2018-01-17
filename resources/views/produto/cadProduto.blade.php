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

    @if (isset($produtos))
        {!! Form::model($produtos, ['route' => ['produto.update', $produtos->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'produto.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('produto', 'Produto:'); !!}
        {!! Form::text('produto', null, ['class' => 'form-control', 'placeholder' => 'Produto']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('unidade', 'Unidade:'); !!}
        {!! Form::text('unidade', null, ['class' => 'form-control', 'placeholder' => 'Unidade']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('codigo', 'Código:'); !!}
        {!! Form::number('codigo', null, ['class' => 'form-control', 'placeholder' => 'Código SIAPNET']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('categoria', 'Categoria:'); !!}
        @if (isset($produtos))
            {!! Form::select('categoria_id', $produtos->categoria->pluck('descricao','id'),null, ['class' => 'js-categoria form-control', 'placeholder' => 'Selecione uma categoria...']) !!}
        @else
            {!! Form::select('categoria_id', $categorias->pluck('descricao','id'),null, ['class' => 'js-categoria form-control', 'placeholder' => 'Selecione uma categoria...']) !!}
        @endif
    </div>
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
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}


@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-categoria').select2();
        });
    </script>
@endsection