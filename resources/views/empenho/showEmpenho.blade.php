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
    <hr>

    <div class="form-group form-inline">
        {!! Form::label('nrempenho', 'Empenho:'); !!}
        {!! Form::text('nrempenho', $empenhos->nrempenho, ['class' => 'form-control', 'disabled'=>'disabled']) !!}

        {!! Form::label('dataemissao', 'Data de Emissão:'); !!}
        {!! Form::text('dataemissao', $empenhos->dataemissao, ['class' => 'form-control', 'disabled'=>'disabled']) !!}

        {!! Form::label('modalidade', 'Modalidade:'); !!}
        {!! Form::text('modalidade', $empenhos->modalidade, ['class' => 'form-control', 'disabled'=>'disabled']) !!}

        {!! Form::label('valortotal', 'Valor do Empenho:'); !!}
        {!! Form::text('valortotal', 'R$ ' . $empenhos->valortotal, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
    </div>
    <div class="form-group form-inline">
        {!! Form::label('empresa_id', 'Fornecedor:'); !!}
        {!! Form::text('empresa_id',$empenhos->empresa->nome, ['class' => 'form-control', 'disabled'=>'disabled','size'=>'80']) !!}
        {!! Form::label('cnpj', 'CNPJ:'); !!}        
        {!! Form::text('cnpj', $empenhos->empresa->cnpj, ['class' => 'form-control', 'disabled'=>'disabled']) !!}
    </div>
    <div class="form-group form-inline">
        {!! Form::label('setor_id', 'Unidade Destino:'); !!}
        {!! Form::text('setor_id', $empenhos->setor->setor, ['class' => 'form-control', 'disabled'=>'disabled','size'=>'20']) !!}     

        {!! Form::label('fonte', 'Fonte:'); !!}
        {!! Form::number('fonte', $empenhos->fonte, ['class' => 'form-control', 'disabled'=>'disabled','size'=>'20']) !!}

        {!! Form::label('plano', 'Plano Orçamentário:'); !!}
        {!! Form::number('plano', $empenhos->plano, ['class' => 'form-control', 'disabled'=>'disabled','size'=>'20']) !!}

 
    </div>  
    <hr>
  
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Adicionar Produtos</h3>
        </div>
        <div class="panel-body">
          
                {!! Form::open(['route' => 'itemempenho.store', 'class' => 'form']) !!}
                {!! Form::hidden('created_by',Auth::user()->id) !!}
               {{-- {!! Form::hidden('estoque_id',$entrada->estoque_id) !!} --}}
                {!! Form::hidden('empenho_id',$empenhos->id) !!}

                                <div class="form-group">
                                    {!! Form::label('produto', 'Produto:'); !!}

                                    <select style="width: 100%" class="js-produto" id="js-produto" name="produto_id">
                                    <option selected="selected" value="">Selecione um produto...</option>
                                            @foreach($produtos as $produto)
                                                @foreach($produto->estoque as $estoque)
                                                 {{--   @if($estoque->id == $entrada->estoque_id) --}}
                                                        <option value="{{ $produto->id }}">
                                                            {{ $produto->produto . ' - ' . $produto->unidade  }} @if($produto->codigo != 0)  {{ '(Cód: ' . $produto->codigo . ')' }} @endif
                                                        </option>
                                                {{--    @endif --}}
                                                @endforeach
                                            @endforeach
                                        </select>
                                </div>
                                
                                <div class="form-group form-inline">
                                        <div class="form-group">
                                            <b>Quantidade:</b> <input type="number" name="qtd" class="form-control">
                                            <b>Valor Unitário:</b> <input type="text" name="preco" class="form-control">
                                            {!! Form::label('status', 'Situação Entrega:'); !!}
                                            {!! Form::text('status', null, ['class' => 'form-control', 'placeholder' => 'Observações']) !!}
                                            <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"> </span> Adicionar</button>
                                        </div>
                                </div>
                                    
    {!! Form::close() !!}

        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Itens da Nota de Empenho: {{ $empenhos->nrempenho }}</h3>
        </div>
        <div class="panel-body">
<table class="table table-striped">
    <thead>
    <tr>
        <th>Código</th>
        <th>Produto</th>
       {{-- <th>Unidade</th> --}}
        <th>Quantidade</th>
        <th>Valor Unitário</th>
        <th>Valor Total</th>
        <th>Observação</th>
        <th width="100px">Ações</th>
    </tr>
    </thead>
    @foreach ($empenhos->itemempenho as $itemempenho)
        <tbody>
        <td>{{ $itemempenho->produto->codigo }}</td>
        <td><a href="{{ route('produto.show',$itemempenho->produto->id) }}">{{ $itemempenho->produto->produto . ' - ' . $itemempenho->produto->unidade}}</a></td>
      {{--  <td>{{ $itemempenho->produto->unidade }}</td> --}}

        <td>{{ $itemempenho->qtd }}</td>
        <td>{{ 'R$ ' . $itemempenho->preco }}</td>
        <td>{{ 'R$ ' . number_format($itemempenho->getOriginal('preco') * $itemempenho->qtd, 2,',','.') }}</td>            
        <td>{{ $itemempenho->status  }} </td>
        <td>
                <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$itemempenho->id}}">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
        </td>
        </tbody>
                
@endforeach
</table>
        </div></div>

@endsection

@section('js')
    <script>
           $(document).ready(function() {
            $('.js-produto').select2();
        });
    </script>
@endsection