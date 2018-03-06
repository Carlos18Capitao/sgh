{{-- @extends('template.master') --}}
{{-- @extends('template._menu') --}}
<br>
@section('content')
    <div class="text-center">
        <h3>{{ $title }}</h3> {{-- {{ $objetos->objeto }} --}}
    </div>

    {{-- <ul class="nav nav-tabs">
    @foreach ($objetos as $objeto)
    <li role="presentation" ><a href="{{url('item/itemObjeto', $objeto->id)}}">{{$objeto->objeto}}</a></li>
  @endforeach
  </ul> --}}

    {{-- <form class="form-group" method="post" action="">
  {{ csrf_field() }}
  <div class="form-group">
  <label for="objeto">Objeto:  </label>
  <input type="text" class="form-control" id="objeto" placeholder="Objeto">
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
</form> assssaa--}}
    {{-- <a href="{{ route('item.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a> --}}
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="/atasvalidas">Todos</a></li>
        @foreach ($objetos as $objeto)
            <li role="presentation"><a href="{{ route('itemata.itemataObjeto',$objeto->id) }}">{{ $objeto->objeto }} </a> </li>
        @endforeach
    </ul>
<p align="right"><b>
    Total de Itens: <span class="label label-default">{{ $consultas->count('objeto') }}</span>
    </b></p>
    <table class="table table-striped">
        <tr>
            {{--<th>ID</th>--}}
            <th>Objeto</th>
            <th>Código</th>
            <th>ARP</th>
            <th>ITEM ARP</th>
            <th>Vigência</th>
            <th>Dias para expirar</th>
            <th>Descrição</th>
            <th>Unidade</th>
            <th>Forma Farmacêutica</th>
            <th>Dose</th>
            <th>QTD Registrada</th>
            <th>Saldo Ata</th>
            <th width="100px">Ações</th>
        </tr>
        @foreach ($consultas as $consulta)
        <tr>
            {{--<td>{{ $item->id }}</td>--}}
            <td>{{ $consulta->objeto }}</td>
            <td>{{ $consulta->codigo }} {{--@if($item->padronizado == 0) <span class="badge">Não Padronizado</span>  @endif--}}</td>
            <td> <a href="{{ route('ata.show', $consulta->ata_id)}}"> {{ $consulta->arp }} </a></td>
            <td>{{ $consulta->itemarp }}</td>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $consulta->vigencia)->format('d/m/Y') }}</td>
            @if(\Carbon\Carbon::createFromFormat('Y-m-d', $consulta->vigencia)->diffInDays($hoje) <= 30)
                    <td><span class="label label-danger">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $consulta->vigencia)->diffInDays($hoje) }}</span></td>
                @elseif(\Carbon\Carbon::createFromFormat('Y-m-d', $consulta->vigencia)->diffInDays($hoje) < 60)
                    <td><span class="label label-warning">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $consulta->vigencia)->diffInDays($hoje) }}</span></td>
                @else
                    <td><span class="label label-success">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $consulta->vigencia)->diffInDays($hoje) }}</span></td>
                @endif
                <td>{{ $consulta->descdoe or $consulta->descricao }}</td>
                <td>{{ $consulta->unidadedoe or $consulta->unidade }}</td>
                {{--            @if($objetos->objeto == 'Medicamentos')--}}
                <td>{{ $consulta->formafarmaceutica }}</td>
                <td>{{ $consulta->dose }}</td>
                {{--@endif--}}
                <td>{{ $consulta->qtdreg }}</td>
                <td>
                    {{--@if($item->demanda->sum('qtd') > 0)--}}
                    <span class="badge">{{ $consulta->saldo or $consulta->qtdreg }}</span>
                    {{--@endif--}}
                </td>
                {{--<td>--}}
                {{--@if($item->itemata->sum('qtdreg')>0)--}}
                {{--<span class="badge">{{ $item->itemata->sum('qtdreg') - $item->itemprocesso->sum('qtd') }}</span>--}}
            {{--@endif--}}


            {{--</td>--}}

            <td>
                {{-- <a href="{{ route('item.edit',$item->id)}}">
      <span class="glyphicon glyphicon-pencil"></span>
    </a> --}}

                {{--<a href="{{ route('item.show', $item->id)}}{{'/ano/'.$item->ano}}">--}}
                <a class="btn btn-sm btn-default" title="DETALHAR" href="{{ route('catalogo.showItemCatalogo', $consulta->id)}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </a>
                @if(!empty($consulta->obs))
                    <a tabindex="0" class="btn btn-sm btn-default" role="button" data-toggle="popover" data-trigger="focus" title="Obs ARP" data-placement="left" data-content="{{ $consulta->obs }}"><span class="glyphicon glyphicon-exclamation-sign"></span></a>
                @endif


                {{--<a href="{{ url('item/itemItem',$item->id)}}{{'/ano/'.$item->ano}}">--}}
                {{--<span class="glyphicon glyphicon-plus"></span>--}}
                {{--</a>--}}

                {{--@if( $item->demanda->sum('qtd') == 0)--}}
                {{--<a  href="{{ url('demanda/demandaItem',$item->id)}}{{'/ano/'.$ano}}">--}}
                {{--<span class="glyphicon glyphicon-plus"></span>--}}
                {{--</a>--}}
                {{--@endif--}}
                {{-- {!! Form::model($item, ['url' => ['item/itemItem', $item->id], 'class' => 'Form', 'method' => 'GET']) !!}

      {!! Form::hidden('anoCat', $ano, null); !!}
        {!! Form::submit('Cadastrar Demanda', ['class' => 'btn btn-success btn-xs']) !!} --}}
            </td>
            </tr>

        @endforeach
    </table>
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
    </script>
    {{-- {!! $objetos->links() !!} --}}
@endsection
