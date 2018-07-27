@extends('adminlte::page')

@section('content')

     <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title"><b>{{ $title }}</b></h3>
        </div>
        <div class="panel-body">
<table id="empenhos" data-page-length='100' class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Processo</th>
        <th>Empenho</th>
        <th>Fornecedor</th>
        <th>Categoria</th>
        <th>Código</th>
        <th>Produto</th>
        <th>Qtd Empenho</th>
        <th>Valor Empenho</th>
        <th>Qtd NF</th>
        <th>Valor NF</th>
        <th>NF</th>
        <th>Saldo Empenho</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($itempenhos as $itempenho)
            <tr @if(empty($itempenho->qtd_nf)) class="danger" @elseif(($itempenho->qtd_empenho - $itempenho->qtd_nf) > 0) class="warning" @endif>
                <td><a href="{{ route('processo.show',$itempenho->processo_id) }}">{{ $itempenho->processo }}</a></td>
                <td><a href="{{ route('relempenho',$itempenho->empenho_id) }}">{{ $itempenho->nrempenho }}</a></td>
                <td><a href="{{ route('empresa.show',$itempenho->fornecedor_id) }}">{{ $itempenho->fornecedor }}</a></td>
                <td>{{ $itempenho->categoria }}</td>
                <td>{{ $itempenho->codigo or ''}}</td>
                <td><a href="{{ route('produto.show',$itempenho->produto_id) }}">{{ $itempenho->produto or '' . ' - ' . $itempenho->unidade}}</a></td>
                <td>{{ $itempenho->qtd_empenho or '' }}</td>
                <td>{{ 'R$ ' . number_format($itempenho->preco_empenho, 2,',','.') }}</td>
                <td>{{ $itempenho->qtd_nf or '0'}}</td>
                <td>{{ 'R$ ' . number_format($itempenho->preco_nf, 2,',','.') }}</td>
                <td><a href="{{ route('entrada.show',$itempenho->entrada_id) }}">{{ $itempenho->numeroentrada or '' }}</a></td>
                <td>@if(($itempenho->qtd_empenho - $itempenho->qtd_nf)==0) Entrega Total @else {{ $itempenho->qtd_empenho - $itempenho->qtd_nf }} @endif</td>
            </tr>
    @endforeach
    </tbody>
</table>
        </div></div>

@endsection

@section('js')
        <script>
                $(document).ready(function() {
                    $('#empenhos').DataTable( {
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                        },
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                    } );
                } );
          </script>
@endsection