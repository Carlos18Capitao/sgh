@extends('adminlte::page')

@section('content')

    {{--<div id="app">--}}
        {{--<cadpaciente></cadpaciente>--}}
    {{--</div>--}}


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


    {{--@if (isset($unidades))--}}
        {{--{!! Form::model($unidades, ['route' => ['unidade.update', $unidades->id], 'class' => 'Form', 'method' => 'PUT']) !!}--}}
        {{--{!! Form::hidden('updated_by',Auth::user()->name) !!}--}}
    {{--@else--}}
        {{--{!! Form::open(['route' => 'unidade.store', 'class' => 'form']) !!}--}}
        {{--{!! Form::hidden('created_by',Auth::user()->name) !!}--}}
    {{--@endif--}}

    <div class="form-group">
        {!! Form::label('nome', 'Nome:'); !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome do paciente']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cartaosus', 'Cartão SUS:'); !!}
        {!! Form::text('cartaosus', null, ['class' => 'form-control', 'placeholder' => 'Cartão SUS']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('dt_nascimento', 'Data de Nascimento:'); !!}
        {!! Form::date('dt_nascimento', null, ['class' => 'form-control', 'placeholder' => 'Data de nascimento']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('civil', 'Estado civil:'); !!}
      {{--  {!! Form::select('civil', ['S' => 'Solteiro', 'C' => 'Casado', 'SP' => 'Separado', 'D' => 'Divorciado', 'A' => 'Amasiado', 'V' => 'Viúvo'],null,['class' => 'js-estadocivil form-control', 'placeholder' => 'Estado Civil']) !!} --}}
        {!! Form::select('civil', $estadocivils->pluck('descricao','id'),null,['class' => 'js-estadocivil form-control', 'placeholder' => 'Selecione o estado civil...']) !!}

    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.js-estadocivil').select2();
        });
    </script>
@endsection
