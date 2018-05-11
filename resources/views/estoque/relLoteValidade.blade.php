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
    <div class="form-group form-inline">
    {!! Form::open([route('relLoteValidade',$estoque_id), 'class' => 'Form', 'method' => 'POST']) !!}
        

        {!! Form::label('dataInicio', 'Data inícial:'); !!}
        {!! Form::date('dataInicio', null, ['class' => 'form-control']) !!}
    
        {!! Form::label('dataFim', 'Data final:'); !!}
        {!! Form::date('dataFim', null, ['class' => 'form-control']) !!}
    
            {!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Código</th>
            <th>Produto</th>
            <th>Lote</th>
            <th>Validade</th>
            <th>Quantidade</th>
        </tr>
        </thead>
        @foreach ($lotes as $lote)
            <tbody>
            <td>{{ $lote->codigo }}</td>
            <td>{{ $lote->produto }}</td>
            <td>{{ $lote->lote }}</td>
            <td>{{ \Carbon\Carbon::parse($lote->validade)->format('d/m/Y') }}</td>
            <td>{{ $lote->qtd }}</td>
            </tbody>
        @endforeach
    </table>
@endsection
