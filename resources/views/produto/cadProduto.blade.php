@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
    </div>

    {{--@shield('unidade.cadastrar')--}}

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
        {!! Form::label('categoria', 'Categoria:'); !!}
        @if (isset($produtos))
            {!! Form::select('categoria_id', $produtos->categoria->pluck('descricao','id'),null, ['class' => 'js-categoria form-control', 'placeholder' => 'Selecione uma categoria...']) !!}
        @else
            {!! Form::select('categoria_id', $categorias->pluck('descricao','id'),null, ['class' => 'js-categoria form-control', 'placeholder' => 'Selecione uma categoria...']) !!}
        @endif
    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}
    {{--@endshield--}}

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-categoria').select2();
        });
    </script>
@endsection