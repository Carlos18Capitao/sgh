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
        <input class="form-control" disabled="disabled" size="20" name="setor_id" type="text" value="{{ $empenhos->setor->setor or ''}}" id="setor_id">  

        {!! Form::label('fonte', 'Fonte:'); !!}
        {!! Form::number('fonte', $empenhos->fonte, ['class' => 'form-control', 'disabled'=>'disabled','size'=>'20']) !!}

        {!! Form::label('plano', 'Plano Orçamentário:'); !!}
        {!! Form::number('plano', $empenhos->plano, ['class' => 'form-control', 'disabled'=>'disabled','size'=>'20']) !!}

 
    </div>  
    <hr>
  
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Itens da Nota de Empenho: {{ $empenhos->nrempenho }}</h3>
        </div>
        <div class="panel-body">
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Código</th>
        <th>Produto</th>
       {{-- <th>Unidade</th> --}}
        <th>Qtd Empenho</th>
        <th>Valor Empenho</th>
        <th>Qtd NF</th>
        <th>Valor NF</th>
        {{--<th>Valor Total</th>--}}
        <th>Saldo Empenho</th>
    </tr>
    </thead>
    @foreach ($itempenhos as $itempenho)
        <tbody>
            <tr @if(empty($itempenho->qtd_nf)) class="danger" @elseif($itempenho->saldo_empenho > 0) class="warning" @endif>

        <td>{{ $itempenho->codigo or ''}}</td>
        <td><a href="{{ route('produto.show',$itempenho->produto_id) }}">{{ $itempenho->produto . ' - ' . $itempenho->unidade}}</a></td>
        <td>{{ $itempenho->qtd_empenho }}</td>
        <td>{{ 'R$ ' . $itempenho->preco_empenho }}</td>
        <td>{{ $itempenho->qtd_nf or '0'}}</td>
        <td>{{ 'R$ ' . $itempenho->preco_nf }}</td>
        {{--<td>{{ 'R$ ' . number_format($itempenho->preco_empenho * $itempenho->qtd_empenho, 2,',','.') }}</td> --}}           
        <td>{{ $itempenho->qtd_empenho - $itempenho->qtd_nf }}</td>
            <tr>

        </tbody>
                
@endforeach
{{--
<td class="active text-right" colspan="4" class="active"><b>TOTAL</b></td>
        <td class="active"><b>
            @foreach($total as $tot)
                {{ 'R$ ' . number_format($tot->total_nf, 2,',','.') }}
            @endforeach
            <td></td>
            <td></td>
            --}}
</tr>
</table>
        </div></div>

@endsection

@section('js')
    {{--<script>--}}
           {{--$(document).ready(function() {--}}
            {{--$('.js-produto').select2();--}}
        {{--});--}}
    {{--</script>--}}

    {{--<script>--}}
        {{--$('.js-produto').select2({--}}
            {{--ajax: {--}}
                {{--url: '/jsonprodutos',--}}
                {{--dataType: 'json'--}}
                {{--// Additional AJAX parameters go here; see the end of this chapter for the full code of this example--}}
            {{--}--}}
        {{--});--}}
    {{--</script>--}}

    <script type="text/javascript">


        $('.js-produto').select2({
            placeholder: 'Selecione o produto',
            language: 'pt-BR',
            ajax: {
                url: "<?php echo route('jsonprodutos') ?>",
                dataType: 'json',
                //delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (data) {
                            return {
                                text: data.produto,
                                id: data.id
                            }
                        })
                    };
                },
                cache: true
            }
        });


    </script>
@endsection