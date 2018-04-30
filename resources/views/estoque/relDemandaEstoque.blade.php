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
    <table class="table table-striped table-hover">
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
        @foreach ($demandas as $demanda)
            <tbody>
            <td>{{ $demanda->codigo }}</td>
            <td>{{ $demanda->produto }}</td>
            <td>{{ $demanda->anual }}</td>
            <td>{{ $demanda->mensal }}</td>
            <td>{{ $demanda->semanal }}</td>
            <td>{{ $demanda->entrada }}</td>
            <td>{{ $demanda->saida }}</td>
            <td>{{ $demanda->saldo }}</td>
            <td>{{ $demanda->prev_semanas }}</td>
            <td>{{ $demanda->prev_meses }}</td>

            </tbody>
        @endforeach
    </table>
@endsection
