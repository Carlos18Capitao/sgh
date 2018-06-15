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
        <a href="{{ route('entrarnf',$estoque_id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    @endpermission
    <br><br>
    <table  data-order='[[ 1, "desc" ]]' id="entradas" class="table table-striped">
        <thead>
        <tr>
           {{-- <th>@sortablelink('id','Código')</th>--}}
           <th>Número</th>           
            <th>Data</th>
            <th>Tipo de Entrada</th>
            <th>Empresa</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        <tbody>        
        @foreach ($entradas as $entrada)
        <tr>
            {{-- <td>{{ $entrada->id }}</td> --}}
            <td><a href="{{ route('entrada.show',$entrada->id) }}">{{ $entrada->numeroentrada  }}</a></td>            
            <td>{{ $entrada->dataentrada }}</td>
            <td>{{ mb_strtoupper($entrada->tipoentrada)  }}</td>
            <td>{{ $entrada->empresa->nome }}</td>
            <td>
    @permission('update-estoques')
                <a class = "btn btn-sm btn-default" href="{{ route('entrada.edit',$entrada->id)}}">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
    @endpermission
    @permission('delete-estoques')
                <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$entrada->id}}">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                <!-- Modal EXCLUIR-->
                <div class="modal fade" id="excluir{{$entrada->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                            </div>
                            <div class="modal-body">
                                <div align="center">
                                    <b>Código do Pedido: {{ $entrada->id }}</b>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!! Form::open(['route'=> ['entrada.destroy',$entrada->id], 'method'=>'DELETE']) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </td>
    @endpermission
        </tr>
        @endforeach
    </tbody>        
    </table>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-setor').select2()
            ;
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#entradas').DataTable( {
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
