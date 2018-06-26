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
    <hr>
    <a href="{{ route('produto.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    <br><br>
    <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><b>Produtos</b></h3>
            </div>
            <div class="panel-body">

                    <table id="produtos" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Produto</th>
                                <th>Unidade</th>
                                <th>Lote</th>
                                <th>Validade</th>
                                <th width="100px">Ações</th>
                            </tr>
                            </thead>
    <tbody>                            
    @foreach($categorias->produto as $produto)
     <tr>
            <td>@if($produto->codigo == 0) @else {{ $produto->codigo }} @endif</td>
            <td><a href="{{ route('produto.show',$produto->id) }}">{{ $produto->produto }}</a></td>
            <td>{{ $produto->unidade }}</td>
            <td>{{ $produto->lote_formatted  }}</td>
            <td>{{ $produto->validade_formatted  }}</td>
            <td>
                  <a class = "btn btn-sm btn-default" href="{{ route('produto.edit',$produto->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$produto->id}}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <!-- Modal EXCLUIR-->
                    <div class="modal fade" id="excluir{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
    
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div align="center">
                                            <b>{{ $produto->produto }}</b>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open(['route'=> ['produto.destroy',$produto->id], 'method'=>'DELETE']) !!}
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
    @endforeach
</tbody>
    
</table>

    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#produtos').DataTable({
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
    } );
</script>
@endsection