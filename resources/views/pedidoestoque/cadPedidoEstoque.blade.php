@extends('adminlte::page')

@section('content')

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>{{ $title }}</b></h3>
        </div>
        <div class="panel-body">
<table data-order='[[ 0, "desc" ]]' data-page-length='50' id="produtos" class="table table-striped">
    @if (isset($pedidos))
        {!! Form::model($pedidos, ['route' => ['pedido.update', $pedidos->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'pedido.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif
        {!! Form::hidden('estoque_id', $estoque_id) !!}

    <div class="form-group form-inline">
        {!! Form::label('estoque', 'Estoque:'); !!}
        @foreach($estoques as $estoque)
            {!! Form::text('estoque',$estoque->descricao,['class'=>'form-control','disabled']) !!}
        @endforeach
        {!! Form::label('tipopedido', 'Tipo de Saída:'); !!}
        {!! Form::select('tipopedido', ['unidade'=>'Unidades','emprestimo'=>'Empréstimo','doacao'=>'Doação','permuta'=>'Permuta','devolucao'=>'Devolução de Empréstimo','inventario'=>'Inventário','descarte'=>'Descarte'], null, ['class' => 'form-control']) !!}
        {!! Form::label('externo', 'Destino Externo:'); !!}
        {!! Form::text('externo',null,['class'=>'form-control','size' => '50x1','placeholder'=>'Em caso de saída externa informar a LOCALIDADE (doação, empréstimo, permuta...)']) !!}

    </div>

        <div class="form-group form-inline">
            {!! Form::label('datapedido', 'Data do Pedido:'); !!}
            {{--{!! Form::date('datapedido', null, ['class' => 'form-control']) !!}--}}

            @if (isset($pedidos))
                <input class="form-control" name="datapedido" type="text" value="{{$pedidos->datapedido}}" id="datapedido" disabled>
            @else
                {!! Form::date('datapedido', null, ['class' => 'form-control']) !!}
            @endif


            {!! Form::label('setor', 'Unidade:'); !!}
            @if (isset($pedidos))
                {!! Form::select('setor_id', $pedidos->setor->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}
            @else
                {!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}
            @endif

            {!! Form::label('requisicao', 'Nº Requisição:'); !!}
            {!! Form::text('requisicao',null,['class'=>'form-control','placeholder'=>'Informe o número da requisição no SIAPNET/e-SIS']) !!}

        </div>
        <div>
            {!! Form::label('obs', 'Observações:'); !!}
            {!! Form::textarea('obs',null,['class'=>'form-control','placeholder'=>'Observações','size' => '30x3']) !!}
        </div>
    <br>
    {!! Form::submit('Adicionar Produtos >>', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Incluir Produtos</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}
    </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-setor').select2()
            ;
        });
    </script>
@endsection
