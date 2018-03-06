{{-- @extends('template.master') --}}
{{-- @extends('template._menu') --}}

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

    @if (isset($empenhos))
        {!! Form::model($empenhos, ['route' => ['empenho.update', $empenhos->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        {!! Form::hidden('updated_by',Auth::user()->id) !!}

    @else
        {!! Form::open(['route' => 'empenho.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->id) !!}

    @endif

    <div class="form-group">
        {!! Form::label('arp', 'Ata:'); !!}
        @if (isset($atas))
            {!! Form::text('nrempenho', null, ['class' => 'form-control', 'placeholder' => 'Número do empenho','readonly'=>'readonly']) !!}
        @else
            {!! Form::text('nrempenho', null, ['class' => 'form-control', 'placeholder' => 'Número do empenho']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('pls', 'PLS:'); !!}
        {!! Form::text('pls', null, ['class' => 'form-control', 'placeholder' => 'número/ano']) !!}
    </div>
    {{--<div class="form-group">--}}
        {{--{!! Form::label('plano_id', 'PLS:'); !!}--}}
        {{--{!! Form::text('plano_id', null, ['class' => 'form-control', 'placeholder' => 'número/ano']) !!}--}}
    {{--</div>--}}
    <div class="form-group">
        {!! Form::label('vigencia', 'Vigência:'); !!}
        @if (isset($atas))
            <input class="form-control" placeholder="Vigência" name="vigencia" type="date" value="{{ $atas->vigencia->format('Y-m-d') }}" id="vigencia">
            {{--{!! Form::date('vigencia', null, ['class' => 'form-control', 'placeholder' => 'Vigência']) !!}--}}
        @else
            {!! Form::date('vigencia', null, ['class' => 'form-control', 'placeholder' => 'Vigência']) !!}
        @endif
    </div>
    <div class="form-group">
        {!! Form::label('fornecedor', 'Fornecedor:'); !!}
        {!! Form::select('fornecedor_id', $fornecedors->pluck('nome','id'), null, ['class' => 'selectpicker', 'data-live-search="true"', 'data-width="100%"', 'placeholder' => 'Selecione o fornecedor']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('obs', 'Observação:'); !!}
        {!! Form::textarea('obs', null, ['class' => 'form-control', 'placeholder' => 'Observações']) !!}
    </div>

    @if (isset($atas))
        <a class = "btn btn-success" title="EDITAR ITENS" href="{{ route('itemata.editar',$atas->id)}}"><span class="glyphicon glyphicon-pencil"> </span> Editar Itens</a>
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    @else
        {!! Form::submit('Próximo >>', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    @endif

    @else
        Você não tem permissão!
    @endshield
@endsection
