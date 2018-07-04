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
            @if (isset($entradas))
                {!! Form::model($entradas, ['route' => ['entrada.update', $entradas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
                {!! Form::hidden('updated_by',Auth::user()->id) !!}
            @else
                {!! Form::open(['route' => 'entrada.store', 'class' => 'form']) !!}
                {!! Form::hidden('created_by',Auth::user()->id) !!}
            @endif
            {!! Form::hidden('estoque_id', $estoque_id) !!}
            {!! Form::hidden('empenho_id', 1) !!}

            <div class="form-group form-inline">
                {!! Form::label('estoque', 'Estoque:'); !!}
                @foreach($estoques as $estoque)
                    {!! Form::text('estoque',$estoque->descricao,['class'=>'form-control','disabled']) !!}
                @endforeach

                {!! Form::label('tipoentrada', 'Tipo de Entrada:'); !!}
                {!! Form::select('tipoentrada', ['nf'=>'Nota Fiscal','remessa'=>'Remessa','doacao'=>'Doação','permuta'=>'Permuta','emprestimo'=>'Empréstimo','devolucao'=>'Devolução de Empréstimo','inventario'=>'Inventário','devunidade'=>'Devolução Unidade'], null, ['class' => 'js-setor form-control', 'placeholder' => 'Tipo de entrada...']) !!}
            </div>


            <div class="form-group form-inline">
                {!! Form::label('empresa_id', 'Fornecedor:'); !!}
                @if (isset($entradas))
                    {!! Form::select('empresa_id', $entradas->empresa->pluck('nome','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione o fornecedor...', 'disabled']) !!}
                @else
                    {!! Form::select('empresa_id', $empresas->pluck('nome','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione o fornecedor...']) !!}
                @endif
            </div>

            <div class="form-group form-inline">
                {!! Form::label('dataentrada', 'Data da Entrada:'); !!}
                @if (isset($entradas))
                    <input class="form-control" name="dataentrada" type="text" value="{{$entradas->dataentrada}}" id="dataentrada" disabled>
                @else
                    {!! Form::date('dataentrada', null, ['class' => 'form-control']) !!}
                @endif

                {{--{!! Form::label('setor', 'Unidade:'); !!}--}}
                {{--@if (isset($pedidos))--}}
                {{--{!! Form::select('setor_id', $pedidos->setor->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}--}}
                {{--@else--}}
                {{--{!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}--}}
                {{--@endif--}}

                {!! Form::label('numeroentrada', 'Documento Entrada:'); !!}
                {!! Form::text('numeroentrada',null,['class'=>'form-control','placeholder'=>'Informe o número do documento']) !!}

            </div>

            <div class="panel-footer">

                {!! Form::submit('Adicionar Produtos >>', ['class' => 'btn btn-primary']) !!}
                {{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Incluir Produtos</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-setor').select2();
        });
    </script>
@endsection
