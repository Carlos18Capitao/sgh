@extends('adminlte::page')

@section('content')

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
@role('admin')
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><b>{{ $title }}</b></h3>
        </div>
        <div class="panel-body">
                <table data-order='[[ 3, "desc" ]]' data-page-length='20' id="acessos" class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Último Acesso</th>
                        </tr>
                        </thead>
                    <tbody>
                        @foreach($acessos as $acesso)
                            <tr>
                                <td>{{ $acesso->id }}</td>
                                <td>{{ $acesso->name }}</td>
                                <td>{{ $acesso->email }}</td>
                                <td>{{ $acesso->last_access }}</td>
                            </tr>
                        @endforeach
                    </tbody>
        </div>
    </div>
@endrole
@endsection

@section('js')
<script>

         $(document).ready(function() {
            $('#acessos').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                columnDefs: [
                    { type: 'date-eu', targets:3  }
                ]
            } );
        } );
    </script>
@endsection
