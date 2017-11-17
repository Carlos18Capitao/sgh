@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
    </div>

    {{--@shield('unidade.cadastrar')--}}

    @if (isset($produtoentradas))
        {!! Form::model($produtoentradas, ['route' => ['entrada.update', $produtoentradas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'entrada.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('produto', 'Produto:'); !!}
        @if (isset($produtoentradas))
            {!! Form::select('produto_id', $produtoentradas->produto->pluck('produto','id'), null, ['class' => 'js-produto form-control','placeholder' => 'Selecione um produto...']) !!}
        @else
            {!! Form::select('produto_id', $produtos->pluck('produto','id'), null, ['class' =>'js-produto form-control', 'placeholder' => 'Selecione um produto...']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('qtd', 'Quantidade:'); !!}
        {!! Form::text('qtd', null, ['class' => 'form-control', 'placeholder' => 'Informe a quantidade']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('obs', 'Observação:'); !!}
        {!! Form::textarea('obs', null, ['class' => 'form-control', 'placeholder' => 'Observações']) !!}
    </div>
    {{--<div class="form-group">--}}
{{--        {!! Form::label('categoria', 'Categoria:'); !!}--}}
        @if (isset($produtoentradas))
{{--            {!! Form::select('categoria_id', $produtos->categoria->pluck('descricao','id'),null, ['class' => 'form-control', 'placeholder' => 'Selecione uma categoria...']) !!}--}}
        @else
{{--            {!! Form::select('categoria_id', $categorias->pluck('descricao','id'),null, ['class' => 'form-control', 'placeholder' => 'Selecione uma categoria...']) !!}--}}
        @endif
    {{--</div>--}}
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}
    {{--@endshield--}}

@endsection

@section('js')
    <script>
        $(document).ready(function() {
        $('.js-produto').select2();
        });
    </script>
@endsection