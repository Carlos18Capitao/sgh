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
    {{--    @foreach($atas as $atas)--}}
    <hr>
    <p><b>ID:</b> {{ $atas->id }}</p>
    <p><b>Ata:</b> {{ $atas->arp }}</p>
    <p><b>Fornecedor:</b> {{ $atas->fornecedor->nome }} </p>
    <p><b>Objeto:</b> {{ $atas->objeto->objeto }} </p>
    <p><b>Observações:</b> {{ $atas->obs }}</p>

    {{--<p><b>Quantidade de Itens:</b> {{ $atas->qtditens }} </p>--}}
    {{--@endforeach--}}
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalCadastrar">
        <span class="glyphicon glyphicon-plus"></span> Adicionar Itens
    </button>
    <a class = "btn btn-success" title="CONCLUIR" href="{{ route('ata.index')}}"><span class="glyphicon glyphicon-ok"> </span> CONCLUIR</a> <br><br>
    {{--<p><b>Observações:</b> {{ $atas->area }} </p>--}}
    {{--<p><b>Itens:</b></p>--}}

    {{--@if (isset($itematas))--}}
    {{--{!! Form::model($itematas, ['route' => ['itemata.update', $atas->id], 'class' => 'Form', 'method' => 'PUT']) !!}--}}
    {{--@else--}}
    {{--{!! Form::open(['route' => 'itemata.store', 'class' => 'form']) !!}--}}
    {{--@endif--}}


    <table class="table table-striped">
        <tr>
            <th><b>Item ARP</b></th>
            <th><b>Descrição DOE</b></th>
            <th><b>Marca</b></th>
            <th><b>Unidade</b></th>
            <th><b>Preço Registrado</b></th>
            <th><b>Qtd Reg</b></th>
            <th><b>Valor total</b></th>
            <th><b>Item Catálogo</b></th>
            <th><b>Ações</b></th>
        </tr>

    @foreach($itematas as $itematas)
        {{ Form::hidden('ata_id[]', $atas->id) }}
        {{ Form::hidden('item_id[]', $itematas->item_id) }}
                
        <tr>
            <td> {{ $itematas->itemarp }}</td>
            <td> {{ $itematas->descdoe }} </td>
            <td> {{ $itematas->marca }} </td>
            <td> {{ $itematas->unidade }} </td>
               {{--                {!! Form::text('precoreg[]', number_format($itematas->precoreg, 4,',','.'), ['class' => 'form-control', 'placeholder' => 'Valor em R$', 'readonly'=>'readonly']) !!}--}}
            <td> {{ number_format($itematas->getOriginal("precoreg"), 4,',','.') }} </td>
            <td> {{ $itematas->getOriginal("qtdreg") }} </td>
            <td> {{ number_format($itematas->getOriginal("qtdreg") * $itematas->getOriginal("precoreg"), 4,',','.') }} </td>
            <td> {{ $itematas->item->descricao .' - '. $itematas->item->formafarmaceutica .' - '. $itematas->item->dose .' - '. $itematas->item->unidade }} </td>
            <td>
            
            @shield('atas.editar')
                <button type="button" title="EDITAR ITEM" class="btn btn-sm btn-default" data-toggle="modal" data-target="#myModal{{$itematas->id}}">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button type="button" title="DUPLICAR ITEM" class="btn btn-sm btn-default" data-toggle="modal" data-target="#duplicar{{$itematas->id}}">
                    <span class="glyphicon glyphicon-duplicate"></span>
                </button>
            @endshield

            @shield('processo.excluir')
                <button type="button" title="EXCLUIR ITEM" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$itematas->id}}">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
            @endshield
            
            </td>

       {!! Form::close() !!}

        <!-- Modal EDITAR-->
        <div class="modal fade" id="myModal{{$itematas->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            {!! Form::open(['route' => ['itemata.update', $itematas->id], 'class' => 'Form', 'method' => 'PUT']) !!}
            {!! Form::hidden('updated_by',Auth::user()->name) !!}

            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar Item</h4>
                    </div>
                    <div class="modal-body">
                    <b>Item: </b>{{ $itematas->item->descricao . ' - ' . $itematas->item->unidade }}
                        {{--                        @if (isset($itematas))--}}
                        {{--@else--}}
                        {{--{!! Form::open(['route' => 'itemata.store', 'class' => 'form']) !!}--}}
                        {{--@endif--}}
                        
                        {{--
                        <select class="selectpicker" data-live-search="true" data-width="100%" name="item_id">
                            {!! Form::label('item', 'Item') !!}:
                            @forelse($items as $item)
                                <option value="{{ $item->id }}" title="{{ $item->descricao }} - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }})"
                                        @if( isset($itematas) && $itematas->item == $item)
                                        selected
                                        @endif
                                >{{ $item->descricao }}
                                    - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }})</option>
                            @empty
                                Não encontrado.
                            @endforelse
                        </select>
                        --}}
                        <div class="form-inline">
                            <div class="form-group">
                                {!! Form::label('itemarp', 'Item ARP:') !!}
                                {!! Form::text('itemarp', $itematas->itemarp, ['class' => 'form-control', 'placeholder' => 'Nº do item na ARP','required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('marca', 'Marca:') !!}
                                {!! Form::text('marca', $itematas->marca, ['class' => 'form-control', 'placeholder' => 'Marca', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('unidade', 'Unidade:') !!}
                                {!! Form::text('unidade', $itematas->unidade, ['class' => 'form-control', 'placeholder' => 'Unidade de medida', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('precoreg', 'Preço Registrado:') !!}
                                {!! Form::text('precoreg', $itematas->precoreg, ['class' => 'form-control', 'placeholder' => 'Valor em R$', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('qtdreg', 'Qtd Reg:') !!}
                                {!! Form::text('qtdreg', $itematas->getOriginal("qtdreg"), ['class' => 'form-control', 'placeholder' => 'Quantidade', 'required'=>'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('descdoe', 'Descrição DOE:') !!}
                            {!! Form::textarea('descdoe', $itematas->descdoe, ['class' => 'form-control', 'placeholder' => 'Descrição do item no DOE','required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <!-- Modal EXCLUIR-->
        <div class="modal fade" id="excluir{{$itematas->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Excluir Item</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            {!! Form::label('item', 'Item:') !!}
                            {!! Form::textarea('item[]', $itematas->item->descricao, ['class' => 'form-control', 'placeholder' => 'Descrição','size' => '30x2','readonly'=>'readonly']) !!}
                        </div>
                        <div class="form-inline">
                            <div class="form-group">
                                {!! Form::label('itemarp', 'Item ARP:') !!}
                                {!! Form::text('itemarp[]', $itematas->itemarp, ['class' => 'form-control', 'placeholder' => 'Nº do item na ARP','readonly'=>'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('marca', 'Marca:') !!}
                                {!! Form::text('marca[]', $itematas->marca, ['class' => 'form-control', 'placeholder' => 'Marca', 'readonly'=>'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('unidade', 'Unidade:') !!}
                                {!! Form::text('unidade[]', $itematas->unidade, ['class' => 'form-control', 'placeholder' => 'Unidade de medida', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('precoreg', 'Preço Registrado:') !!}
                                {!! Form::text('precoreg[]', $itematas->precoreg, ['class' => 'form-control', 'placeholder' => 'Valor em R$', 'readonly'=>'readonly']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('qtdreg', 'Qtd Reg:') !!}
                                {!! Form::text('qtdreg[]', $itematas->qtdreg, ['class' => 'form-control', 'placeholder' => 'Quantidade', 'readonly'=>'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('descdoe', 'Descrição DOE:') !!}
                            {!! Form::textarea('descdoe[]', $itematas->descdoe, ['class' => 'form-control', 'placeholder' => 'Descrição do item no DOE', 'readonly'=>'readonly']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::open(['route'=> ['itemata.destroy',$itematas->id], 'method'=>'DELETE']) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Modal DUPLICAR-->
        <div class="modal fade" id="duplicar{{$itematas->id}}" tabindex="-1" role="dialog" aria-labelledby="duplicar">
            {{--            {!! Form::open(['route' => ['itemata.update', $itematas->id], 'class' => 'Form', 'method' => 'PUT']) !!}--}}
            {!! Form::open(['route' => 'itemata.store', 'class' => 'form']) !!}
            {!! Form::hidden('created_by',Auth::user()->name) !!}

            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Editar Item</h4>
                    </div>
                    <div class="modal-body">
                        {!!  Form::hidden('ata_id', $atas->id) !!}
                        {!! Form::label('item', 'Item') !!}:
                        {{ $itematas->item->descricao  . ' - ' . $itematas->item->unidade }}
                        {!! Form::hidden('item_id', $itematas->item_id) !!}
{{--
                        <select class="selectpicker" data-live-search="true" data-width="100%" name="item_id">
                            @forelse($items as $item)
                                <option value="{{ $item->id }}" title="{{ $item->descricao }} - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }})"
                                        @if( isset($itematas) && $itematas->item == $item)
                                        selected
                                        @endif
                                >{{ $item->descricao }}
                                    - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }})</option>
                            @empty
                                Não encontrado.
                            @endforelse
                        </select>
--}}

                        <div class="form-inline">
                            <div class="form-group">
                                {!! Form::label('itemarp', 'Item ARP:') !!}
                                {!! Form::text('itemarp', $itematas->itemarp + 1 . ' COTA', ['class' => 'form-control', 'placeholder' => 'Nº do item na ARP','required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('marca', 'Marca:') !!}
                                {!! Form::text('marca', $itematas->marca, ['class' => 'form-control', 'placeholder' => 'Marca', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('unidade', 'Unidade:') !!}
                                {!! Form::text('unidade', $itematas->unidade, ['class' => 'form-control', 'placeholder' => 'Unidade de medida', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('precoreg', 'Preço Registrado:') !!}
                                {!! Form::text('precoreg', $itematas->precoreg, ['class' => 'form-control', 'placeholder' => 'Valor em R$', 'required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('qtdreg', 'Qtd Reg:') !!}
                                {!! Form::text('qtdreg', null, ['class' => 'form-control', 'placeholder' => 'Quantidade', 'required'=>'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('descdoe', 'Descrição DOE:') !!}
                            {!! Form::textarea('descdoe', $itematas->descdoe, ['class' => 'form-control', 'placeholder' => 'Descrição do item no DOE','required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    @endforeach
           </tr>
    </table>

    {{--<a class = "btn btn-primary" title="CONCLUIR" href="{{ route('ata.index')}}"><span class="glyphicon glyphicon-ok"> </span> CONCLUIR</a>--}}

    <!-- Modal CADASTRAR-->
    <div class="modal fade" id="myModalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myModalCadastrar">
        {!! Form::open(['route' => 'itemata.store', 'class' => 'form']) !!}
        {!! Form::hidden('created_by',Auth::user()->name) !!}

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Adicionar Item</h4>
                </div>
                <div class="modal-body">
                    <div class="form-inline">
                        {!!  Form::hidden('ata_id', $atas->id) !!}
                        {!! Form::label('item', 'Item') !!}:
                        @if($atas->objeto->id == '4')

                            <select class="form-control" data-live-search="true" data-width="100%" name="item_id">
                                @forelse($items as $item)
                                    <option selected="selected" value="{{ $item->id }}"
                                            title="{{ $item->descricao }} - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }}) Cód: {{ $item->codigo }}">{{ str_limit($item->descricao, 100) }}
                                        - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }}) Cód: {{ $item->codigo }}</option>
                                @empty
                                    Não encontrado.
                                @endforelse
                            </select>

                        @else

                            <select class="selectpicker" data-live-search="true" data-width="100%" name="item_id">
                                @forelse($items as $item)
                                    <option selected="selected" value="{{ $item->id }}"
                                            title="{{ $item->descricao }} - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }}) Cód: {{ $item->codigo }}">{{ $item->descricao }}
                                        - {{ $item->unidade }} - {{ $item->dose }} - {{ $item->formafarmaceutica }} - ({{ $item->id }}) Cód: {{ $item->codigo }}</option>
                                @empty
                                    Não encontrado.
                                @endforelse
                            </select>

                           </div>
                    @endif
                    <br>
                    <div class="form-inline">
                        <div class="form-group">
                            {!! Form::label('itemarp', 'Item ARP:') !!}
                            {!! Form::text('itemarp', null, ['class' => 'form-control', 'placeholder' => 'Nº do item na ARP', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('marca', 'Marca:') !!}
                            {!! Form::text('marca', null, ['class' => 'form-control', 'placeholder' => 'Marca', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('unidade', 'Unidade:') !!}
                            {!! Form::text('unidade', null, ['class' => 'form-control', 'placeholder' => 'Unidade de medida', 'required'=>'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('precoreg', 'Preço Registrado:') !!}
                            {!! Form::text('precoreg', null, ['class' => 'form-control', 'placeholder' => 'Valor em R$', 'required'=>'required', 'id'=>'money']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('qtdreg', 'Qtd Reg:') !!}
                            {!! Form::text('qtdreg', null, ['class' => 'form-control', 'placeholder' => 'Quantidade', 'required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('descdoe', 'Descrição DOE:') !!}
                        {!! Form::textarea('descdoe', null, ['class' => 'form-control', 'placeholder' => 'Descrição do item no DOE','required'=>'required']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection