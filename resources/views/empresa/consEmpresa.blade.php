@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
    </div>

    <a href="{{ route('empresa.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    <br><br>
    <table id="empresas" class="table table-striped">
        <thead>
        <tr>
            {{-- <th>ID</th> --}}
            <th>Fornecedor</th>
            <th>CNPJ</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        <tbody>        
        @foreach ($empresas as $empresa)
            <tr>
                {{-- <td>{{ $unidade->id }}</td> --}}
                <td><a href="{{ route('empresa.show', $empresa->id)}}">{{ $empresa->nome }}</a></td>
                <td>{{ $empresa->getOriginal('cnpj') }}</td>
                <td>
                    <a class = "btn btn-sm btn-default" title="EDITAR" href="{{ route('empresa.edit',$empresa->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a class = "btn btn-sm btn-default" title="DETALHAR" href="{{ route('empresa.show', $empresa->id)}}">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>        
    </table>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#empresas').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            } );
        } );
  </script>
@endsection