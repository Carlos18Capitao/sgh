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

    @foreach (Auth::user()->estoques as $stoq)
        @if ($estoque_id == $stoq->pivot->estoque_id)

            {{-- @if($estoque->id == Auth::user()->user_estoques->id) --}}
                <a href="{{route('estoque.menu',$estoque_id)}}">
                    <i class="glyphicon glyphicon-th-large fa-2x"></i>
                </a>

                <a href="{{route('estoque.entrada',$estoque_id)}}">
                    <i class="fa fa-fw fa-truck fa-2x"></i>
                </a>

                <a href="{{route('estoque.saida',$estoque_id)}}">
                    <i class="fa fa-fw fa-cart-arrow-down fa-2x"></i>
                </a>

                <a href="{{route('relposicaoestoque',$estoque_id)}}">
                    <i class="fa fa-fw fa-file-text fa-2x"></i>
                </a>
            {{--<a title="IMPRIMIR" href="{{ route('pdfposicaoestoque',$estoque_id)}}">--}}
                {{--<i class="fa fa-fw fa-print fa-2x"></i>--}}
            {{--</a>--}}
           @else
        @endif
    @endforeach

    <br><br>
    <table data-order='[[ 9, "desc" ]]' data-page-length='100' id="estoques" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Código</th>
            <th>Produto</th>
            <th>Demanda Anual</th>
            <th>Demanda Mensal</th>
            <th>Demanda Semanal</th>
            <th>Entradas</th>
            <th>Saídas</th>
            <th>Saldo</th>
            <th>Previsão Semanas</th>
            <th>Previsão Meses</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($demandas as $demanda)
        <tr>
            <td>{{ $demanda->codigo }}</td>
            <td>{{ $demanda->produto }}</td>
            <td>{{ $demanda->anual }}</td>
            <td>{{ $demanda->mensal }}</td>
            <td>{{ $demanda->semanal }}</td>
            <td>{{ $demanda->entrada }}</td>
            <td>{{ $demanda->saida }}</td>
            <td>{{ $demanda->entrada - $demanda->saida }}</td>
            <td>
                @if($demanda->semanal > 0)
                    {{ round(($demanda->entrada - $demanda->saida)/$demanda->semanal) }}
                @else
                    {{ $demanda->prev_semanas }}
                @endif
            </td>
            <td>
                @if($demanda->mensal > 0)
                    @if(round(($demanda->entrada - $demanda->saida)/$demanda->mensal) > 12)
                        <span class="label label-warning">{{ round(($demanda->entrada - $demanda->saida)/$demanda->mensal) }}</span>
                    @elseif(round(($demanda->entrada - $demanda->saida)/$demanda->mensal) <= 3)
                        <span class="label label-danger">{{ round(($demanda->entrada - $demanda->saida)/$demanda->mensal) }}</span>
                    @else
                        <span class="label label-success">{{ round(($demanda->entrada - $demanda->saida)/$demanda->mensal) }}</span>
                    @endif
                @else
                    {{ $demanda->prev_meses }}
                @endif
                </td>
            </tr>
        @endforeach
    </tbody>        
    </table>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#estoques').DataTable( {
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