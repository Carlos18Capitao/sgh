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
        @else
        @endif
    @endforeach
    <br><br>
    @permission('create-estoques')    
        <a href="{{ route('requisicao',$estoque_id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Requisitar</a>
    @endpermission
    <br><br>
    <table data-order='[[ 1, "desc" ]]' id="requisitions" class="table table-striped">
        <thead>
        <tr>
            <th>Unidade</th>
            <th>Data</th>
            <th>Tipo</th>
            <th>Usuário</th>
            <th>Situação</th>
            <th>Obs</th>
            {{--<th>@sortablelink('created_by','Usuário')</th>--}}
            <th width="150px">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($requisitions as $requisition)
            <tr>
            <td><a href="{{ route('requisicao.show',$requisition->id) }}">{{ $requisition->id or 'Não informado' }}</a></td>
            <td>{{ $requisition->setor_id }}</td>
            <td>{{ mb_strtoupper($requisition->tipo) }}</td>
            <td>{{ $requisition->created_by }}</td>
            <td>{{ $requisition->status }}</td>
            <td>{{ $requisition->obs  }}</td>
            <td>
                {{--<a target="_blank" class = "btn btn-sm btn-default" title="IMPRIMIR REQUISIÇÃO" href="{{ route('recibopedidoestoque',$pedido->id)}}">--}}
                    {{--<span class="glyphicon glyphicon-print"></span>--}}
                {{--</a>--}}
        @permission('update-estoques')                               
                <a class = "btn btn-sm btn-default" href="{{ route('requisicao.edit',$requisition->id)}}">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
        @endpermission                
        @permission('delete-estoques')       
                <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{ $requisition->id }}">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>

                <!-- Modal EXCLUIR-->
                <div class="modal fade" id="excluir{{$requisition->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                            </div>
                            <div class="modal-body">
                                <div align="center">
                                    <b>Código do Pedido: {{ $requisition->id }}</b>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!! Form::open(['route'=> ['requisicao.destroy',$requisition->id], 'method'=>'DELETE']) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
        @endpermission                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#requisitions').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                columnDefs: [
                    { type: 'date-eu', targets: 1 }
                ]
            } );
        } );
    </script>
@endsection
