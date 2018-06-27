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

    @if (isset($requisition))
        {!! Form::model($requisition, ['route' => ['requisicao.update', $requisitions->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'requisicao.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif
        {!! Form::hidden('estoque_id', $estoque_id) !!}

    <div class="form-group form-inline">
        {!! Form::label('estoque', 'Estoque:'); !!}
        @foreach($estoques as $estoque)
            {!! Form::text('estoque',$estoque->descricao,['class'=>'form-control','disabled']) !!}
        @endforeach
        {!! Form::label('tipo', 'Tipo de Requisição:'); !!}
        {!! Form::select('tipo', ['semanal'=>'Semanal','Quinzenal'=>'Quinzenal','Mensal'=>'Mensal','urgente'=>'Urgencia'], null, ['class' => 'form-control']) !!}
    </div>

        <div class="form-group form-inline">
                {!! Form::label('setor', 'Unidade:'); !!}
            @if (isset($pedidos))
                {!! Form::select('setor_id', $pedidos->setor->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}
            @else
                {!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}
            @endif

        </div>
        <div>
            {!! Form::label('obs', 'Observações:'); !!}
            {!! Form::textarea('obs',null,['class'=>'form-control','placeholder'=>'Observações','size' => '30x3']) !!}
        </div>
    <br>
    {!! Form::submit('Adicionar Produtos >>', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Incluir Produtos</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-setor').select2()
            ;
        });
    </script>
@endsection
