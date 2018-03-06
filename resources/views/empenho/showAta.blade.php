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

    <a class = "btn btn-sm btn-default" title="TEXTO PARA E-MAIL" target="_blank" href="{{ route('ata.emailAta', $atas->id)}}">
        <span class="glyphicon glyphicon-envelope"></span></a>
    @shield('processo.cadastrar')
    <a class = "btn btn-sm btn-default" title="CADASTRAR PROCESSO" href="{{ route('processo.show', $atas->id)}}">
        <span class="glyphicon glyphicon-folder-open"></span></a>
    @endshield
    @shield('atas.editar')
    <a class = "btn btn-sm btn-default" title="EDITAR ARP" href="{{ route('ata.edit',$atas->id)}}">
        <span class="glyphicon glyphicon-pencil"></a>
    @endshield
    <br><br>
    <p><b>Ata:</b> {{ $atas->arp }} </p>
    <p><b>Vigência:</b> {{ $atas->vigencia->format('d/m/Y') }}   -   Faltam: <b>{{ $fimAta }}</b> dias para o fim da vigência</p>
    <p><b>Fornecedor:</b> <a href="{{ route('fornecedor.show', $atas->fornecedor->id)}}">{{ $atas->fornecedor->nome }}</a> </p>
    <p><b>PLS:</b> {{ $atas->pls }} </p>
    <p><b>Objeto:</b> {{ $atas->objeto->objeto }} </p>
    <p><b>Observações:</b> {{ $atas->obs }}</p>

    <table class="table table-striped">
        <tr>
            <th>Item ARP</th>
            <th width="600px">Descrição DOE</th>
            <th>Unidade</th>
            <th>Marca</th>
            <th>Preço Registrado</th>
            <th>Quantidade Registrada</th>
            <th>Valor Total</th>
            <th>Saldo ARP</th>
            <th>Item Catálogo</th>
            <th>Processo</th>            
        </tr>
 
        @foreach($atas->itemata as $itemata2)
            <tr>
                <td>{{ $itemata2->itemarp }} </td>
                <td>{{ $itemata2->descdoe }} </td>
                <td>{{ $itemata2->unidade or $itemata2->item->unidade }} </td>
                <td>{{ $itemata2->marca }} </td>
                {{--<td>{{$itemata2->precoreg}}</td>--}}
                <td>{{ number_format($itemata2->getOriginal("precoreg"), 4,',','.') }} </td>
                <td>{{ $itemata2->getOriginal("qtdreg") }} </td>
                <td>{{ number_format($itemata2->getOriginal("precoreg") * $itemata2->qtdreg, 4,',','.') }}</td>
                <td><span class="badge">{{ $itemata2->getOriginal("qtdreg") - $itemata2->itemprocesso->sum('qtd') }}</span></td>
                <td>
                <a class = "btn btn-sm btn-default" title="{{$itemata2->item->descricao . '-' . $itemata2->item->dose }} - {{$itemata2->unidade or $itemata2->item->unidade}} @if($itemata2->item->codigo > 0) ({{ $itemata2->item->codigo}}) @endif " href="{{ route('catalogo.showItemCatalogo', $itemata2->item->id) }}">
                     <span class="glyphicon glyphicon-info-sign"></span>
                </a> 
                
               {{-- <a href="{{ route('catalogo.showItemCatalogo', $itemata2->item->id) }}">{{$itemata2->item->descricao . '-' . $itemata2->item->dose }} - {{$itemata2->unidade or $itemata2->item->unidade}} @if($itemata2->item->codigo > 0) ({{ $itemata2->item->codigo}})  @endif </a></td> --}}
                <td>
                    @forelse($itemata2->itemprocesso as $itprocesso)
                        <a href="{{ route('processo.details', $itprocesso->processo->id)}}"> {{ $itprocesso->processo->nr_processo }} </a> ({{ $itprocesso->unidade->sigla }} {{ $itprocesso->qtd }})<br>
                    @empty
                    @endforelse
                </td>
            </tr>
        @endforeach

    </table>
    {{--<p><b>Item:</b> {{ $atas->itemata->marca }}</p>--}}

    {{--<p><b>PROCESSOS:</b></p>--}}
    {{--</a>--}}
    {{--@shield('processo.cadastrar')--}}
    {{--<a class = "btn btn-sm btn-default" title="CADASTRAR PROCESSO" href="{{ route('processo.show', $atas->id)}}">--}}
        {{--<span class="glyphicon glyphicon-folder-open"></span>--}}
    {{--</a>--}}
    {{--@endshield--}}
    {{--<br><br>--}}

    {{--@foreach ($atas->itemata as $itemata)--}}
        {{--@foreach($itemata->itemprocesso as $itproc)--}}

            {{--@if($itemata->id == $itproc->item_ata_id)--}}
             {{--   <a href="{{ route('processo.details', $itproc->processo->id)}}">{{ $itproc->processo->nr_processo . '/' . $itproc->processo->ano_processo }}</a> --}}
                {{--@foreach($atas->processo as $processo)--}}
                    {{--<a href="{{ route('processo.details', $processo->id)}}">{{ $processo->nr_processo }}</a> <br>--}}
                {{--@endforeach--}}
            {{--@endif--}}
               {{--<br>--}}
            {{--@break                         --}}
        {{--@endforeach  --}}
        {{--@break --}}
    {{--@endforeach--}}     

    <br><br><br><br>

    <div align ="right">
   <h6> 
        Cadastrado por: {{ $atas->created_by}} <br>
        Em: {{ $atas->created_at->format('d/m/Y H:m:s') }}<br> 
   </h6>
@if(isset($atas->updated_by))
    <h6>
        Atualizado por: {{ $atas->updated_by}}<br>
        Em: {{ $atas->updated_at->format('d/m/Y H:m:s') }}
    </h6>
@endif
    @shield('atas.excluir')
    {!! Form::open(['route'=> ['ata.destroy',$atas->id], 'method'=>'DELETE']) !!}
    {!! Form::submit("Excluir ARP",['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @endshield
    </div>

@endsection