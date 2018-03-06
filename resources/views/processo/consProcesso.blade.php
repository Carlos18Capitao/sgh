@extends('adminlte::page')

@section('content')

    <div class="text-center">
        <h3>{{ $title }}</h3>
    </div>

    <a href="{{ route('processo.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
    <br><br>
    <table class="table table-striped">
        <tr>
            {{-- <th>ID</th> --}}
            <th>Número</th>
            <th>Obs</th>
            <th>Categoria</th>
            <th width="100px">Ações</th>
        </tr>
        @foreach ($processos as $processo)
            <tr>
                <td><a href="{{ route('processo.show', $processo->id)}}">{{ $processo->numero }}</a></td>
                <td>{{ $processo->obs }}</td>
                <td>{{ $processo->categoria->descricao }}</td>
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
    </table>

@endsection
