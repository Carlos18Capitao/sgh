{{-- @extends('template.master') --}}
{{-- @extends('template._menu') --}}

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
    </div>

    <ul class="nav nav-pills">
        @if(Route::currentRouteName() == 'ata.atasVencidas')
        <li role="presentation" class="active"><a href="/atasVencidas">Todas</a></li>
        @elseif(Route::currentRouteName() == 'ata.ataObjetoVenc')
            <li role="presentation" class="active"><a href="/atasVencidas">Todas</a></li>
        @else
            <li role="presentation" class="active"><a href="/ata">Todas</a></li>
        @endif

        @foreach ($objetos as $objeto)
            @if(Route::currentRouteName() == 'ata.atasVencidas')
                <li role="presentation"><a href="{{ route('ata.ataObjetoVenc',$objeto->id) }}">{{ $objeto->objeto }}</a></li>
            @elseif(Route::currentRouteName() == 'ata.ataObjetoVenc')
                <li role="presentation"><a href="{{ route('ata.ataObjetoVenc',$objeto->id) }}">{{ $objeto->objeto }}</a></li>
            @else
                <li role="presentation"><a href="{{ route('ata.ataObjeto',$objeto->id) }}">{{ $objeto->objeto }}</a></li>
            @endif
        @endforeach
    </ul>
    <p align="right"><b>
            Total de Atas: <span class="label label-default">{{ $atas->count('arp') }}</span>
        </b></p>
    @shield('ata.cadastrar')
        <a href="{{ route('ata.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    @endshield
    <table class="table table-striped">
        <tr>
            {{-- <th>ID</th> --}}
            <th>Objeto</th>
            <th>Ata</th>
            <th>Vigência</th>
            <th>Fornecedor</th>
            <th>Expira em</th>
            <th width="200px">Ações</th>
        </tr>
        @foreach ($atas as $ata)
            <tr>
                {{-- <td>{{ $unidade->id }}</td> --}}

                <td>{{ $ata->objeto->objeto }}</td>
                <td><a href="{{ route('ata.show', $ata->id)}}">{{ $ata->arp }} </a> <span class="badge">@if($ata->created_at->format('d/m/Y') == $hoje->format('d/m/Y')) Novo @endif</span>
                @if(!empty($ata->obs))
                    <a tabindex="0" class="btn btn-sm" role="button" data-toggle="popover" data-trigger="focus" title="Obs ARP" data-placement="right" data-content="{{ $ata->obs }}"><span class="glyphicon glyphicon-exclamation-sign"></span></a>
                @endif
                </td>
                <td>{{ $ata->vigencia->format('d/m/Y') }}</td>
                <td><a href="{{ route('fornecedor.show', $ata->fornecedor->id)}}">{{ $ata->fornecedor->nome }}</a></td>
                @if($hoje->diffInDays($ata->vigencia,false)  < 0)
                    <td> <span class="label label-danger">{{ $hoje->diffInDays($ata->vigencia, false)}} dias </span></td>
                @elseif($hoje->diffInDays($ata->vigencia,false)  <= 30)
                    <td><span class="label label-danger">{{ $hoje->diffInDays($ata->vigencia, false)}} dias </span></td>
                @elseif($hoje->diffInDays($ata->vigencia,false) <= 60)
                        <td> <span class="label label-warning">{{ $hoje->diffInDays($ata->vigencia, false)}} dias </span></td>
                    @else
                    <td><span class="label label-success">{{ $hoje->diffInDays($ata->vigencia, false)}} dias </span></td>
                @endif
                <td>
                    @shield('atas.editar')
                    <a class = "btn btn-sm btn-default" title="EDITAR" href="{{ route('ata.edit',$ata->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @endshield
                    <a class = "btn btn-sm btn-default" title="DETALHAR" href="{{ route('ata.show', $ata->id)}}">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a class = "btn btn-sm btn-default" title="TEXTO PARA E-MAIL" target="_blank" href="{{ route('ata.emailAta', $ata->id)}}">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </a>
                    @shield('processo.cadastrar')
                    <a class = "btn btn-sm btn-default" title="CADASTRAR PROCESSO" href="{{ route('processo.show', $ata->id)}}">
                        <span class="glyphicon glyphicon-folder-open"></span>
                    </a>
                    @endshield
                </td>
            </tr>
 
        @endforeach

    </table>
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection