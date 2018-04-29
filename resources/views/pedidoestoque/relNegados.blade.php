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
    <br><br>
    {!! Form::open([route('negados',$estoque_id), 'class' => 'Form', 'method' => 'POST']) !!}
    <div class="form-group form-inline">

    {!! Form::label('setor', 'Unidade:'); !!}
    {!! Form::select('setor_id', $setors->pluck('setor','id'), null, ['class' => 'js-setor form-control', 'placeholder' => 'Selecione uma unidade...']) !!}
        <br><br>
    {!! Form::label('dataInicio', 'Data inícial:'); !!}
    {!! Form::date('dataInicio', null, ['class' => 'form-control']) !!}

    {!! Form::label('dataFim', 'Data final:'); !!}
    {!! Form::date('dataFim', null, ['class' => 'form-control']) !!}

        {!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    <hr>

    {{--<p><b>Período:</b> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $dataInicio)->format('d/m/Y') . ' a ' . \Carbon\Carbon::createFromFormat('Y-m-d', $dataFim)->format('d/m/Y') }}</p>--}}
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Código</th>
            <th>Produto</th>
        </tr>
        </thead>

    @if(isset($setor_id))
        @foreach($negados as $negado)
            <tbody>
            <td>{{ $negado->codigo }}</td>
            <td>{{ $negado->produto }}</td>

            </tbody>
        @endforeach
    @endif
    </table>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.js-setor').select2()
            ;
        });
    </script>
@endsection