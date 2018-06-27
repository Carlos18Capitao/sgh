@extends('adminlte::page')

@section('content')

    <a href="{{ route('processo.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    <br><br>
    <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><b>{{ $title }}</b></h3>
            </div>
            <div class="panel-body">
    <table id="processos" class="table table-striped">
        <thead>
        <tr>
            {{-- <th>ID</th> --}}
            <th>Número</th>
            <th>Categoria</th>
            <th>Obs</th>
            <th width="100px">Ações</th>
        </tr>
        </thead>
        <tbody
        @foreach ($processos as $processo)
            <tr>
                <td><a href="{{ route('processo.show', $processo->id)}}">{{ $processo->numero }}</a></td>
                <td>{{ $processo->categoria->descricao }}</td>
                <td>{{ $processo->obs }}</td>
                <td>
                    <a class = "btn btn-sm btn-default" title="EDITAR" href="{{ route('processo.edit',$processo->id)}}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a class = "btn btn-sm btn-default" title="DETALHAR" href="{{ route('processo.show', $processo->id)}}">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
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
            $('#processos').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                }
            } );
        } );
    </script>
@endsection