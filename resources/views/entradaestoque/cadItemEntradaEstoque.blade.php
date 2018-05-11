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

    {{--@foreach (Auth::user()->estoques as $stoq)--}}
        {{--@if ($pedido->estoque_id == $stoq->pivot->estoque_id)--}}

            {{-- @if($estoque->id == Auth::user()->user_estoques->id) --}}

            {{--<a href="{{route('estoque.entrada',$pedido->estoque_id)}}">--}}
                {{--<i class="fa fa-fw fa-truck fa-2x"></i>--}}
            {{--</a>--}}

            {{--<a href="{{route('estoque.pedido',$pedido->estoque_id)}}">--}}
                {{--<i class="fa fa-fw fa-cart-arrow-down fa-2x"></i>--}}
            {{--</a>--}}

            {{--<a href="{{route('relposicaoestoque',$pedido->estoque_id)}}">--}}
                {{--<i class="fa fa-fw fa-file-text fa-2x"></i>--}}
            {{--</a>--}}
        {{--@else--}}
        {{--@endif--}}
    {{--@endforeach--}}
    <br><br>

    <div class="form-group form-inline">
        {!! Form::label('id', 'ID:'); !!}
        {!! Form::text('id',$entrada->id,['class'=>'form-control','disabled']) !!}

        {!! Form::label('estoque', 'Estoque:'); !!}
        {!! Form::text('estoque',$entrada->estoque->descricao,['class'=>'form-control','disabled']) !!}
    </div>

    <div class="form-group form-inline">
        {!! Form::label('dataentrada', 'Data da Entrada:'); !!}
        {!! Form::text('dataentrada', $entrada->dataentrada, ['class' => 'form-control','disabled']) !!}


        {!! Form::label('empresa', 'Fornecedor:'); !!}
        {!! Form::text('empresa_id', $entrada->empresa->nome, ['class' => 'form-control','disabled']) !!}

        {!! Form::label('numeroentrada', 'Nº Documento:'); !!}
        {!! Form::text('numeroentrada',$entrada->numeroentrada,['class'=>'form-control','disabled']) !!}

    </div>


    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalCadastrar">
        <span class="glyphicon glyphicon-plus"></span> Adicionar Produtos
    </button>
    <a class = "btn btn-success" title="CONCLUIR" href="{{ route('estoque.entrada',$entrada->estoque_id)}}"><span class="glyphicon glyphicon-ok"> </span> CONCLUIR</a> <br><br>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('codigo','Código')</th>
            <th>@sortablelink('produto.produto','Produto')</th>
            <th>Unidade</th>
            <th>Lote</th>
            <th>Validade</th>
            <th>@sortablelink('qtd','Qtd')</th>
            <th>@sortablelink('obs','Observação')</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        @foreach ($produtoentradas as $produtoentrada)
            <tbody>
            <td>{{ $produtoentrada->produto->codigo }}</td>
            <td><a href="{{ route('produto.show',$produtoentrada->produto->id) }}">{{ $produtoentrada->produto->produto }}</a></td>
            <td>{{ $produtoentrada->produto->unidade }}</td>
            <td>{{ $produtoentrada->lote }}</td>
            <td>{{ $produtoentrada->validade }} {{-- $produtoentrada->validade_dias --}}</td>
            <td>{{ $produtoentrada->qtd }}</td>
            <td>{{ $produtoentrada->obs  }}</td>
            <td>
                    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$produtoentrada->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>

                    <!-- Modal EXCLUIR-->
                     <div class="modal fade" id="excluir{{$produtoentrada->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    <div align="center">
                                        <b>{{ $produtoentrada->produto->produto }}</b>
                                        <br><br>
                                        Total: {{ $produtoentrada->qtd }}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['route'=> ['entradaestoque.destroy',$produtoentrada->id], 'method'=>'DELETE']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal EXCLUIR-->
            </td>
        @endforeach


            <!-- Modal CADASTRAR-->
            <div class="modal fade" id="myModalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalCadastrar">
                {!! Form::open(['route' => 'entradaestoque.store', 'class' => 'form']) !!}
                {!! Form::hidden('created_by',Auth::user()->id) !!}

                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Adicionar Produtos</h4>
                        </div>
                        <div class="modal-body">
                            {{--@if (isset($produtoentradas))--}}
                                {{--{!! Form::model($produtoentradas, ['route' => ['entrada.update', $produtoentradas->id], 'class' => 'Form', 'method' => 'PUT']) !!}--}}
                                {{--{!! Form::hidden('updated_by',Auth::user()->id) !!}--}}
                            {{--@else--}}
                                {{--{!! Form::open(['route' => 'entrada.store', 'class' => 'form']) !!}--}}
                                {{--{!! Form::hidden('created_by',Auth::user()->id) !!}--}}
                            {{--@endif--}}
                            {!! Form::hidden('estoque_id',$entrada->estoque_id) !!}
                            {!! Form::hidden('entrada_id',$entrada->id) !!}

                                <div class="form-group">
                                    {!! Form::label('produto', 'Produto:'); !!}

{{--                                    @if (isset($produtoentradas))--}}
{{--                                        {!! Form::select('produto_id', $produtoentradas->produto->pluck('produto','id'), null, ['class' => 'js-produto form-control','placeholder' => 'Selecione um produto...']) !!}--}}
                                    {{--@else--}}
                                        {{-- {!! Form::select('produto_id', $produtos->pluck('produto','id'), null, ['class' =>'js-produto form-control', 'placeholder' => 'Selecione um produto...']) !!} --}}
                                        {{--<select class="js-produto form-control" name="produto_id">--}}
                                    <select style="width: 100%" class="js-produto" id="js-produto" name="produto_id">
                                    <option selected="selected" value="">Selecione um produto...</option>
                                            @foreach($produtos as $produto)
                                                @foreach($produto->estoque as $estoque)
                                                    @if($estoque->id == $entrada->estoque_id)
                                                        {{-- nnnnn @if( $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') > 0) --}}
                                                        <option value="{{ $produto->id }}">
                                                            {{ $produto->produto . ' - ' . $produto->unidade  }} @if($produto->codigo != 0)  {{ '(Cód: ' . $produto->codigo . ')' }} @endif
                                                        </option>
                                                        {{-- @endif --}}
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>
                                    {{--@endif--}}
                                </div>
                                
                                <div class="form-group form-inline">

                                        <div class="form-group">
{{--                                                {!! Form::label('qtd', 'Quantidade Total:'); !!}--}}
{{--                                                {!! Form::number('qtde', null, ['class' => 'form-control', 'placeholder' => 'Informe a quantidade']) !!}--}}
                                                @foreach($estoques as $estoque)
                                                    @if($estoque->lote == '1')
                                                        {{--<button class="add_field_button">Adicionar Lotes</button><br><br>--}}
                                                    <div class="input_fields_wrap">
                                                        <b>Lote:</b> <input type="text" name="lote" class="form-control">
                                                        <b>Validade:</b> <input type="date" name="validade" class="form-control">
                                                        <b>Qtd:</b> <input type="number" name="qtd" class="form-control"><br>
                                                    </div>
                                                    {{--<div class="input_fields_wrap">--}}
                                                        {{--<b>Lote:</b> <input type="text" name="lote[]" class="form-control">--}}
                                                        {{--<b>Validade:</b> <input type="date" name="validade[]" class="form-control">--}}
                                                        {{--<b>Qtd:</b> <input type="number" name="qtde[]" class="form-control"> <a href="#" class="remove_field">Excluir</a><br>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="input_fields_wrap">--}}
                                                        {{--<b>Lote:</b> <input type="text" name="lote[]" class="form-control">--}}
                                                        {{--<b>Validade:</b> <input type="date" name="validade[]" class="form-control">--}}
                                                        {{--<b>Qtd:</b> <input type="number" name="qtde[]" class="form-control"> <a href="#" class="remove_field">Excluir</a><br>--}}
                                                    {{--</div>--}}
                                                    @endif
                                                @endforeach
                                            </div>
                                            <br><br>

                        </div>
                                    
                                    <div class="form-group">
                                        {!! Form::label('obs', 'Observação:'); !!}
                                            {!! Form::text('obs', null, ['class' => 'form-control', 'placeholder' => 'Observações']) !!}
                                    </div>
                    </div>
                                   
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>
    {!! Form::close() !!}
@endsection

@section('js')
        <script>
           $(document).ready(function() {
                $('#js-produto').select2({
                    dropdownParent: $('#myModalCadastrar')
                });
           });
 
        $(document).ready(function() {
    var max_fields      = 11; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div>Lote: <input type="text" name="lote[]" > Validade: <input type="date" name="validade[]" > Qtd: <input type="number" name="qtd[]" ></div><a href="#" class="remove_field">Excluir</a>'); //add input box
        }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
        </script>
@endsection
