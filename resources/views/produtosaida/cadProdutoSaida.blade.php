@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
    </div>

    {{--@shield('unidade.cadastrar')--}}

    @if (isset($produtosaidas))
        {!! Form::model($produtosaidas, ['route' => ['saida.update', $produtosaidas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'saida.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif
    <div class="form-group">
        {!! Form::label('setor', 'Setor:'); !!}
        @if (isset($produtosaidas))
            {!! Form::select('setor_id', $produtosaidas->setor->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione um setor...']) !!}
        @else
            {!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione um setor...']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('produto', 'Produto:'); !!}
        @if (isset($produtosaidas))
            {!! Form::select('produto_id', $produtosaidas->produto->pluck('produto','id'), null, ['class' => 'js-produto form-control', 'placeholder' => 'Selecione um produto...']) !!}
        @else
            {!! Form::select('produto_id', $produtos->pluck('produto','id'), null, ['class' => 'js-produto form-control', 'placeholder' => 'Selecione um produto...']) !!}
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
        @if (isset($produtosaidas))
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
            $('.js-produto').select2(),
            $('.js-setor').select2()
            ;
        });
    </script>
@endsection