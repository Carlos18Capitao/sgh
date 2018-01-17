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

    @if (isset($produtoentradas))
        {!! Form::model($produtoentradas, ['route' => ['entrada.update', $produtoentradas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'entrada.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('produto', 'Produto:'); !!}
        {!! Form::hidden('estoque_id',$estoque_id) !!}

        @if (isset($produtoentradas))
            {!! Form::select('produto_id', $produtoentradas->produto->pluck('produto','id'), null, ['class' => 'js-produto form-control','placeholder' => 'Selecione um produto...']) !!}
        @else
            {{-- {!! Form::select('produto_id', $produtos->pluck('produto','id'), null, ['class' =>'js-produto form-control', 'placeholder' => 'Selecione um produto...']) !!} --}}

             <select class="js-produto form-control" name="produto_id">
                <option selected="selected" value="">Selecione um produto...</option>
                    @foreach($produtos as $produto)
                        {{-- @if( $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') > 0) --}}
                            <option value="{{ $produto->id }}">
                                {{ $produto->produto . ' - ' . $produto->unidade  }} @if($produto->codigo != 0)  {{ '(Cód: ' . $produto->codigo . ')' }} @endif
                            </option>
                        {{-- @endif --}}
                    @endforeach
            </select>
        @endif
    </div>
    <div class="form-group form-inline">

    {{--@if($produtos->lote == 1)--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('lote', 'Lote:'); !!}--}}
            {{--{!! Form::text('lote', null, ['class' => 'form-control', 'placeholder' => 'Informe o lote']) !!}--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('validade', 'Validade:'); !!}--}}
            {{--{!! Form::date('validade', null, ['class' => 'form-control', 'placeholder' => 'Validade']) !!}--}}
        {{--</div>--}}
    {{--@endif--}}

    <div class="form-group">
        {!! Form::label('qtd', 'Quantidade:'); !!}
        {!! Form::text('qtd', null, ['class' => 'form-control', 'placeholder' => 'Informe a quantidade']) !!}
    </div>
    </div>
    <div class="form-group">
        {!! Form::label('obs', 'Observação:'); !!}
        {!! Form::text('obs', null, ['class' => 'form-control', 'placeholder' => 'Observações']) !!}
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

@endsection

@section('js')
    <script>
        $(document).ready(function() {
        $('.js-produto').select2();
        });
    </script>
@endsection
