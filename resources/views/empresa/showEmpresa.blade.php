@extends('adminlte::page')

@section('content')

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><b>{{ $title }}</b></h3>
            </div>
            <div class="panel-body">

    <p><b>Fornecedor:</b> {{ $empresas->nome }}</p>
    <p><b>CNPJ:</b> <a target="_blank" href="http://transparencia.al.gov.br/despesa/despesas-por-favorecido/{{ $empresas->cnpj}}/510556">{{ $empresas->getOriginal('cnpj') }}</a></p>
    <p><b>E-mail:</b> {{ $empresas->email }} </p>
    <p><b>Telefone:</b> {{ $empresas->telefone }} </p>
    <p><b>Endereço:</b> {{ $empresas->endereco }} </p>
    <p><b>Responsável:</b> {{ $empresas->responsavel }}</p>
    <p><b>Observações:</b> {{ $empresas->area }} </p>

    </div>
          </div>


          <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><b>Empenhos do Fornecedor: {{ $empresas->nome }} </b></h3>
                </div>
                <div class="panel-body">          
    <table id="empenhos" class="table table-striped">
        <thead>
        <tr>
                <th>Empenho</th>
                <th>Data Emissão</th>
                <th>Modalidade</th>
                <th>Fonte</th>
                <th>Plano Orçamentário</th>
                <th>Unidade</th>
                <th>Valor</th>
                <th>Processo</th>
                <th>Categoria</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($empresas->empenho as $empenho)
            <tr>
                    <td><a href="{{ route('empenho.show',$empenho->id) }}">{{ $empenho->nrempenho }}</a></td>
                    <td>{{ $empenho->dataemissao }}</td>
                    <td>{{ $empenho->modalidade }}</td>
                    <td>{{ $empenho->fonte }}</td>
                    <td>{{ $empenho->plano }}</td>
                    <td>{{ $empenho->setor->setor or ''}}</td>
                    <td>{{ 'R$ ' . $empenho->valortotal }}</td>
                    <td>{{ $empenho->processo->numero }}</td>
                    <td>{{ $empenho->processo->categoria->descricao }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
                </div>
          </div>

          <div class="panel panel-default">
                <div class="panel-heading">
                <h3 class="panel-title"><b>Entradas do Fornecedor: {{ $empresas->nome }}</b></h3>
                </div>
                <div class="panel-body">
        <table  data-order='[[ 1, "desc" ]]' id="entradas" class="table table-striped">
            <thead>
            <tr>
               {{-- <th>@sortablelink('id','Código')</th>--}}
               <th>Número</th>           
                <th>Data</th>
                <th>Tipo de Entrada</th>
                <th width="100px">Ações</th>
            </tr>
            </thead>
            <tbody>        
            @foreach ($empresas->entrada as $entrada)
            <tr>
                {{-- <td>{{ $entrada->id }}</td> --}}
                <td><a href="@if($entrada->empenho_id == 1){{ route('entrada.show',$entrada->id) }} @else {{ route('entrada.showentradaempenho',$entrada->id) }} @endif">{{ $entrada->numeroentrada  }}</a></td>            
                <td>{{ $entrada->dataentrada }}</td>
                <td>{{ mb_strtoupper($entrada->tipoentrada)  }}</td>
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
                </div>
        </div>

@role('admin')
    <div align ="right">

            <a class = "btn btn-sm btn-default" title="EDITAR" href="{{ route('empresa.edit',$empresas->id)}}">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </a> <br><br>

        {!! Form::open(['route'=> ['empresa.destroy',$empresas->id], 'method'=>'DELETE']) !!}
        {!! Form::submit("Excluir empresa",['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
@endrole
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#empenhos').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                columnDefs: [
                    { type: 'date-eu', targets: 1 }
                ]
            } );
        } );
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