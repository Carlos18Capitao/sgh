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
        {!! Form::text('id',$pedido->id,['class'=>'form-control','disabled']) !!}

        {!! Form::label('estoque', 'Estoque:'); !!}
        {!! Form::text('estoque',$pedido->estoque->descricao,['class'=>'form-control','disabled']) !!}
    </div>

    <div class="form-group form-inline">
        {!! Form::label('datapedido', 'Data do Pedido:'); !!}
        {!! Form::text('datapedido', $pedido->datapedido, ['class' => 'form-control','disabled']) !!}


        {!! Form::label('setor', 'Unidade:'); !!}
        {!! Form::text('setor_id', $pedido->setor->setor, ['class' => 'form-control','disabled']) !!}

        {!! Form::label('requisicao', 'Nº Requisição:'); !!}
        {!! Form::text('requisicao',$pedido->requisicao,['class'=>'form-control','disabled']) !!}

    </div>


    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalCadastrar">
        <span class="glyphicon glyphicon-plus"></span> Adicionar Produtos
    </button>
    <a class = "btn btn-success" title="CONCLUIR" href="{{ route('estoque.pedido',$pedido->estoque_id)}}"><span class="glyphicon glyphicon-ok"> </span> CONCLUIR</a> <br><br>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('codigo','Código')</th>
            <th>@sortablelink('produto.produto','Produto')</th>
            <th>Unidade</th>
            <th>@sortablelink('qtd','Qtd')</th>
            <th>@sortablelink('obs','Observação')</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        @foreach ($produtosaidas as $produtosaida)
            <tbody>
            <td>{{ $produtosaida->produto->codigo  }}</td>
            <td>{{ $produtosaida->produto->produto }}</td>
            <td>{{ $produtosaida->produto->unidade }}</td>
            <td>{{ $produtosaida->qtd }}</td>
            <td>{{ $produtosaida->obs  }}</td>
            <td></td>
        @endforeach


            <!-- Modal CADASTRAR-->
            <div class="modal fade" id="myModalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalCadastrar">
                {!! Form::open(['route' => 'saida.store', 'class' => 'form']) !!}
                {!! Form::hidden('created_by',Auth::user()->name) !!}

                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Adicionar Produtos</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                    {!!  Form::hidden('pedido_id', $pedido->id) !!}
                                    {!!  Form::hidden('setor_id', $pedido->setor_id) !!}

                                    {!! Form::open(['route' => 'saida.store', 'class' => 'form']) !!}
                                    {!! Form::hidden('created_by',Auth::user()->id) !!}
                                    {!! Form::hidden('estoque_id',$pedido->estoque_id) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('produto', 'Produto:'); !!} <br>


                                        {{--  {!!Form::select('produto_id', $produtos->pluck('produto','id'), null, ['class' => 'js-produto form-control', 'placeholder' => 'Selecione um produto...']) !!}--}}
                                        <select style="width: 100%" class="js-produto" id="js-produto" name="produto_id" tabindex="1">
                                            <option selected="selected" value="">Selecione um produto...</option>
                                            @foreach($estoques as $estoque)
                                                @foreach ($estoque->produto as $produto)
                                                    @if( $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') > 0)
                                                        <option value="{{ $produto->id }}">
                                                            {{ $produto->produto . ' - ' . $produto->unidade }} @if($produto->codigo != 0)  {{ '(Cód: ' . $produto->codigo . ')' }} @endif - Saldo: {{ $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </select>

                                </div>
                                <div class="form-group">
                                    {!! Form::label('qtd', 'Quantidade:'); !!}
                                    {!! Form::number('qtd', null, ['class' => 'form-control', 'placeholder' => 'Informe a quantidade','tabindex'=>'2']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('obs', 'Observação:'); !!}
                                    {!! Form::text('obs', null, ['class' => 'form-control', 'placeholder' => 'Observações','tabindex'=>'3']) !!}
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
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
        </script>
@endsection
