@extends('adminlte::page')

@section('content')

    <div class="panel panel-default">
            <div class="panel-heading">
              <h2 class="panel-title"><b>{{ $title }}</b></h2>
            </div>
            <div class="panel-body">

    <table data-order='[[ 1, "asc" ]]' data-page-length='100' id="estoques" class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="30">Código</th>
            <th width="350">Produto</th>
            <th width="60">Unidade</th>
            <th width="100">Qtd - Lote - Validade</th>
            {{--<th width="80">Estoque Total</th>--}}
            {{--<th width="100px">Ações</th>--}}
        </tr>
        </thead>
        <tbody>        
        @foreach ($estoques as $estoque)

          @foreach ($estoque->produto as $produto)
            <tr>
            <td>{{ $produto->codigo }}</td>
            <td>{{ $produto->produto }}</td>
          {{--  <td>{{ $produto->produto }}</td>--}}
            <td>{{ $produto->unidade }}</td>
            <td>
            <table style="margin-bottom:0px;" class="table table-bordered table-condensed">
                    @foreach($produto->lotes as $lote)
                     @if($lote->qtd > 0)
                <tr>

                        <td width="80">{{-- $lote->qtd --}} </td>
                        <td width="80"> {{ $lote->lote }} </td>
                        <td width="80"> {{ $lote->ValidadeFormat }} </td>
                </tr>

                     @endif   

                    @endforeach
            </table>
            </td>{{--
            <td>{{-- $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') --}}
            {{--</td>--}}
                {{--<td>--}}
                    {{--@shield('produto.editar')--}}
                    {{--<a class = "btn btn-sm btn-default" href="{{ route('produto.edit',$produto->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-pencil"></span>--}}
                    {{--</a>--}}
                    {{--@endshield--}}
                    {{--<button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$produto->id}}">--}}
                        {{--<span class="glyphicon glyphicon-trash"></span>--}}
                    {{--</button>--}}

                    {{--<!-- Modal EXCLUIR-->--}}
                    {{--<div class="modal fade" id="excluir{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">--}}
                        {{--<div class="modal-dialog modal-lg" role="document">--}}
                            {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}

                                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                    {{--<h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>--}}
                                {{--</div>--}}
                                {{--<div class="modal-body">--}}
                                    {{--<div align="center">--}}
                                        {{--<b>{{ $produto->produto }}</b>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="modal-footer">--}}
                                    {{--{!! Form::open(['route'=> ['produto.destroy',$produto->id], 'method'=>'DELETE']) !!}--}}
                                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>--}}
                                    {{--<button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>--}}
                                    {{--{!! Form::close() !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</td>--}}
                                </tr>
          @endforeach

        @endforeach
        </tbody>
    </table>
    {{-- {!! $produtos->appends(\Request::except('page'))->render() !!} --}}
</div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#estoques').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            } );
        } );
    </script>
@endsection
