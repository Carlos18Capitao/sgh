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

    @if (isset($prestadors))
        {!! Form::model($prestadors, ['route' => ['prestador.update', $prestadors->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}
    @else
        {!! Form::open(['route' => 'prestador.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}
    @endif

    <div class="form-group">
        {!! Form::label('nome', 'Nome do Prestador:'); !!}
        {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome do Prestador']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cnes', 'Número CNES:'); !!}
        {!! Form::text('cnes', null, ['class' => 'form-control', 'placeholder' => 'CNES do Prestador']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('assistente', 'Assistente?'); !!}

        @if (isset($prestadors))
            @if ($prestadors->getOriginal('assistente') == 1)
              {!! Form::radio('assistente','1',false,["id"=>"assistenteSim","checked"]); !!}
              {!! Form::label('assistenteSim', 'Sim'); !!}
              {!! Form::radio('assistente','0',false,["id"=>"assistenteNao"]); !!}
              {!! Form::label('assistenteNao', 'Não'); !!}
            @else
              {!! Form::radio('assistente','1',false,["id"=>"assistenteSim"]); !!}
              {!! Form::label('assistenteSim', 'Sim'); !!}
              {!! Form::radio('assistente','0',false,["id"=>"assistenteNao","checked"]); !!}
              {!! Form::label('assistenteNao', 'Não'); !!}
            @endif
        @else
              {!! Form::radio('assistente','1',false,["id"=>"assistenteSim"]); !!}
              {!! Form::label('assistenteSim', 'Sim'); !!}
              {!! Form::radio('assistente','0',true,["id"=>"assistenteNao"]); !!}
              {!! Form::label('assistenteNao', 'Não'); !!}
        @endif

    </div>
    <div class="form-group">
        {!! Form::label('executante', 'Executante?'); !!}
  @if (isset($prestadors))
      @if ($prestadors->getOriginal('executante') == 1)
        {!! Form::radio('executante','1',false,["id"=>"executanteSim","checked"]); !!}
        {!! Form::label('executanteSim', 'Sim'); !!}
        {!! Form::radio('executante','0',false,["id"=>"executanteNao"]); !!}
        {!! Form::label('executanteNao', 'Não'); !!}
      @else
        {!! Form::radio('executante','1',false,["id"=>"executanteSim"]); !!}
        {!! Form::label('executanteSim', 'Sim'); !!}
        {!! Form::radio('executante','0',false,["id"=>"executanteNao","checked"]); !!}
        {!! Form::label('executanteNao', 'Não'); !!}
      @endif
  @else
        {!! Form::radio('executante','1',false,["id"=>"executanteSim"]); !!}
        {!! Form::label('executanteSim', 'Sim'); !!}
        {!! Form::radio('executante','0',true,["id"=>"executanteNao"]); !!}
        {!! Form::label('executanteNao', 'Não'); !!}
  @endif
    </div>
    <div class="form-group">
        {!! Form::label('ala_id', 'Ala:'); !!}
        @if (isset($prestadors))
            {!! Form::select('ala_id', $prestadors->ala->pluck('descricao','id'),null,['class' => 'js-ala form-control', 'placeholder' => 'Selecione uma Ala...']) !!}
        @else
            {!! Form::select('ala_id', $alas->pluck('descricao','id'),null,['class' => 'js-ala form-control', 'placeholder' => 'Selecione uma Ala...']) !!}
        @endif
    </div>
    <div class="form-group">
          {!! Form::label('tipo_prestador_id', 'Tipo de Prestador:'); !!}
        @if (isset($prestadors))
          {!! Form::select('tipo_prestador_id', $prestadors->tipoprestador->pluck('descricao','id'),null, ['class' => 'js-tipoprestador form-control', 'placeholder' => 'Selecione um Tipo de Prestador...']) !!}
        @else
          {!! Form::select('tipo_prestador_id', $tipoprestadors->pluck('descricao','id'),null, ['class' => 'js-tipoprestador form-control', 'placeholder' => 'Selecione um Tipo de Prestador...']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('telefone', 'Telefone:'); !!}
        {!! Form::text('telefone', null, ['class' => 'form-control', 'placeholder' => 'Telefone']) !!}
    </div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{{--    {{ Form::button('<i class="glyphicon glyphicon-floppy-disk"> Salvar</i>', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}--}}
    {!! Form::close() !!}

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.js-ala').select2(),
            $('.js-tipoprestador').select2();
        });
    </script>
@endsection
