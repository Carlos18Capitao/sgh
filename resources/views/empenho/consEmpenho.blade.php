@extends('adminlte::page')

@section('content')

    @permission('create-empenhos')
    <a href="{{ route('processo.index')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    @endpermission
    <br><br>

    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><b>{{ $title }}</b></h3>
        </div>
        <div class="panel-body">

    <table id="empenhos" class="table table-striped">
    <thead>
        <th>Empenho</th>
        <th>Data Emissão</th>
        <th>Modalidade</th>
        <th>Fornecedor</th>
        <th>Fonte</th>
        <th>Plano Orçamentário</th>
        <th>Unidade</th>
        <th>Valor</th>
        <th>Processo</th>
        <th>Categoria</th>
    </thead>
{{--        {{ dd($processos) }}--}}
<tbody>
@foreach($empenhos as $empenho)
        <tr>
        <td><a href="{{ route('empenho.show',$empenho->id) }}">{{ $empenho->nrempenho }}</a></td>
             <td>{{ $empenho->dataemissao }}</td>
             <td>{{ $empenho->modalidade }}</td>
             <td>{{ $empenho->empresa->nome }}</td>
             <td>{{ $empenho->fonte }}</td>
             <td>{{ $empenho->plano }}</td>
             <td>{{ $empenho->setor->setor or ''}}</td>
             <td>{{ 'R$ ' . $empenho->valortotal }}</td>
             <td>{{ $empenho->processo->numero }}</td>
             <td>{{ $empenho->processo->categoria->descricao }}</td>
        </tr>
@endforeach
</tbody>
</table>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#empenhos').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                columnDefs: [
                    { type: 'date-eu', targets: 1 }
                ]
            } );
        } );
    </script>
@endsection