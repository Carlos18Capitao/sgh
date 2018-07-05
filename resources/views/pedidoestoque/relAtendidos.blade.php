@extends('adminlte::page')

@section('content')

    {{--<div class="text-center">--}}
        {{--<h3>{{ $title }}</h3>--}}
    {{--</div>--}}

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(!isset($setor_id))

    @foreach (Auth::user()->estoques as $stoq)
        @if ($estoque_id == $stoq->pivot->estoque_id)

            {{-- @if($estoque->id == Auth::user()->user_estoques->id) --}}

            <a href="{{route('estoque.entrada',$estoque_id)}}">
                <i class="fa fa-fw fa-truck fa-2x"></i>
            </a>

            <a href="{{route('estoque.saida',$estoque_id)}}">
                <i class="fa fa-fw fa-cart-arrow-down fa-2x"></i>
            </a>

            <a href="{{route('relposicaoestoque',$estoque_id)}}">
                <i class="fa fa-fw fa-file-text fa-2x"></i>
            </a>
        @else
        @endif
    @endforeach
@endif
    <br>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>{{ $title }}</b></h3>
        </div>
        <div class="panel-body">
    {!! Form::open([route('atendidos',$estoque_id), 'class' => 'Form', 'method' => 'POST']) !!}
    <div class="form-group form-inline">

    {!! Form::label('setor', 'Unidade:'); !!}
    {{--{!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}--}}
    <select name="setor_id" id="setor_id" class="js-setor form-control">
            <option value="@foreach($setors as $setor) {{ $setor->id . ',' }} @endforeach 0">TODAS AS UNIDADES</option>
        @foreach($setors as $setor)
            <option value="{{ $setor->id }}">{{ $setor->setor }}</option>
        @endforeach
    </select>

    </div>
        <div class="form-group form-inline">

    {!! Form::label('dataInicio', 'Data inícial:'); !!}
    {!! Form::date('dataInicio', null, ['class' => 'form-control']) !!}

    {!! Form::label('dataFim', 'Data final:'); !!}
    {!! Form::date('dataFim', null, ['class' => 'form-control']) !!}

        {!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
        </div>
    </div>

    {{--<p><b>Período:</b> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dataInicio)->format('d/m/Y') . ' a ' . \Carbon\Carbon::createFromFormat('Y-m-d', $dataFim)->format('d/m/Y') }}</p>--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><b>{{ $title }}  @if(isset($dataInicio)) no período de {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dataInicio)->format('d/m/Y') . ' a ' . \Carbon\Carbon::createFromFormat('Y-m-d', $dataFim)->format('d/m/Y') }} @endif</b></h3>
        </div>
        <div class="panel-body">
    <table id="atendidos" data-page-length='50' class="table table-striped">
        <thead>
        <tr>
            <th>Código</th>
            <th>Produto</th>
            <th>Qtd</th>
            <th>Data</th>
        </tr>
        </thead>

    @if(isset($setor_id))
        <tbody>
        @foreach($atendidos as $atendido)
            <tr>
            <td>{{ $atendido->codigo }}</td>
            <td>{{ $atendido->produto }}</td>
            <td>{{ $atendido->qtd }}</td>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $atendido->datapedido)->format('d/m/Y') }}</td>

            </tr>
        @endforeach
        </tbody>
    @endif
    </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.js-setor').select2()
            ;
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#atendidos').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                columnDefs: [
                    { type: 'date-eu', targets: 3 }
                ]
            } );
        } );
    </script>
@endsection