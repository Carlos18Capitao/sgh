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

    <hr>

    <p><b>ID:</b> {{ $atas->id }}</p>
    <p><b>Ata:</b> {{ $atas->arp }}</p>
    <p><b>Vigência:</b> {{ $atas->vigencia->format('d/m/Y') }} - Faltam: <b>{{ $fimAta }}</b> dias para o fim da
        vigência</p>
    <p><b>Fornecedor:</b> {{ $atas->fornecedor->nome }} </p>
    <p><b>PLS:</b> {{ $atas->pls }} </p>
    <p><b>Objeto:</b> {{ $atas->objeto->objeto }} </p>
    <p><b>Quantidade de Itens:</b> {{ $atas->qtditens }} </p>

    {{--<p><b>Observações:</b> {{ $atas->area }} </p>--}}
    <hr>
    {{--<p><b>Itens:</b></p>--}}

    @for ($i = 0; $i < $atas->qtditens; $i++)
        {{--The current value is {{ $i }}--}}

        @if (isset($itematas))
            {!! Form::model($itematas, ['route' => ['itemata.update', $atas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
        @else
            {!! Form::open(['route' => 'itemata.store', 'class' => 'form']) !!}
        @endif
        <div class="form-inline">

            {{ Form::hidden('ata_id[]', $atas->id) }}


            {!! Form::label('item', 'Item') !!} <b>{{ $i+1 }}:</b>

            {{--<select  class="selectpicker" data-live-search="true" data-width="100%" name="item_id" >--}}
            @if($atas->objeto->id == '4')

                <select class="form-control" data-live-search="true" data-width="100%" name="item_id[]">
                    @forelse($items as $item)
                        <option selected="selected" value="{{ $item->id }}"
                                title="{{ $item->descricao }} - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }}) Cód: {{ $item->codigo }}">{{ str_limit($item->descricao, 100) }}
                            - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }}) Cód: {{ $item->codigo }}</option>
                    @empty
                        Não encontrado.
                    @endforelse
                </select>

            @else

                <select class="selectpicker" data-live-search="true" data-width="100%" name="item_id[]">
                    @forelse($items as $item)
                        <option selected="selected" value="{{ $item->id }}"
                                title="{{ $item->descricao }} - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }}) Cód: {{ $item->codigo }}">{{ $item->descricao }}
                            - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }}) Cód: {{ $item->codigo }}</option>
                    @empty
                        Não encontrado.
                    @endforelse
                </select>
        </div>

        {{--<div class="form-group">--}}
        {{--{!! Form::label('item', 'Item:') !!}--}}
        {{--{!! Form::select('item_id', $items->pluck('descricao','id'), null, ['class' => 'selectpicker', 'data-live-search="true"', 'data-width="100%"', 'placeholder' => 'Selecione o item']) !!}--}}
        {{--</div>--}}
        @endif
        <br>
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('itemarp', 'Item ARP:') !!}
                {!! Form::text('itemarp[]', null, ['class' => 'form-control', 'placeholder' => 'Nº do item na ARP', 'required'=>'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('marca', 'Marca:') !!}
                {!! Form::text('marca[]', null, ['class' => 'form-control', 'placeholder' => 'Marca', 'required'=>'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('unidade', 'Unidade:') !!}
                {!! Form::text('unidade[]', null, ['class' => 'form-control', 'placeholder' => 'Unidade de medida', 'required'=>'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('precoreg', 'Preço Registrado:') !!}
                {!! Form::text('precoreg[]', null, ['class' => 'form-control', 'placeholder' => 'Valor em R$', 'required'=>'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('qtdreg', 'Qtd Reg:') !!}
                {!! Form::text('qtdreg[]', null, ['class' => 'form-control', 'placeholder' => 'Quantidade', 'required'=>'required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('descdoe', 'Descrição DOE:') !!}
            {!! Form::textarea('descdoe[]', null, ['class' => 'form-control', 'placeholder' => 'Descrição do item no DOE','size' => '30x2', 'required'=>'required']) !!}
        </div>

        <hr>
    @endfor
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

@endsection
