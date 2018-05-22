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
      {{--    <a class = "btn btn-sm btn-default" title="EDITAR" href="{{ route('processo.edit',$processos->id)}}">
            <span class="glyphicon glyphicon-pencil"></span>
          </a>
    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$processos->id}}">
        <span class="glyphicon glyphicon-trash"></span>
    </button>--}}
    <button type="button" title="CADASTRAR EMPENHO" class="btn btn-sm btn-default" data-toggle="modal" data-target="#empenho">
        <span class="glyphicon glyphicon-file"></span>
    </button>
    <br><br>
    <p>Empenho: {{ $empenhos->nrempenho }}</p>
    <p>Data Emissão: {{ $empenhos->dataemissao }}</p>
    <p>Modalidade: {{ $empenhos->modalidade }}</p>
    <p>Fornecedor: {{ $empenhos->empresa->nome }}</p>
    <p>Fonte: {{ $empenhos->fonte }}</p>
    <p>Plano Orçamentário: {{ $empenhos->plano }}</p>
    <p>Unidade: {{ $empenhos->setor->setor }}</p>
    <p>Valor: {{ 'R$ ' . $empenhos->valortotal }}</p>

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
                                            <b>Qtd:</b> <input type="number" name="qtd" class="form-control">
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
          <h3 class="panel-title">Itens da Nota</h3>
        </div>
        <div class="panel-body">
<table class="table table-striped">
    <thead>
    <tr>
        <th>Código</th>
        <th>Produto</th>
       {{-- <th>Unidade</th> --}}
        <th>Qtd</th>
        <th>Preço</th>
        <th>Valor Total</th>
        <th>Observação</th>
        <th width="100px">Ações</th>
    </tr>
    </thead>
    @foreach ($itemempenhos as $itemempenho)
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