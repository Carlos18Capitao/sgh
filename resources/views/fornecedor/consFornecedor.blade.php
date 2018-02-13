{{-- @extends('template.master') --}}
{{-- @extends('template._menu') --}}

@section('content')

  <div class="text-center">
    <h3>{{ $title }}</h3>
  </div>

  @shield('fornecedor.cadastrar')
  <a href="{{ route('fornecedor.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a>
  @endshield
  <br><br>
  <table class="table table-striped">
    <tr>
      {{-- <th>ID</th> --}}
      <th>Fornecedor</th>
      <th>CNPJ</th>
      <th width="100px">Ações</th>
    </tr>
    @foreach ($fornecedors as $fornecedor)
      <tr>
        {{-- <td>{{ $unidade->id }}</td> --}}
        <td><a href="{{ route('fornecedor.show', $fornecedor->id)}}">{{ $fornecedor->nome }}</a></td>
        <td>{{ $fornecedor->getOriginal('cnpj') }}</td>
        <td>
          @shield('fornecedor.editar')
          <a class = "btn btn-sm btn-default" title="EDITAR" href="{{ route('fornecedor.edit',$fornecedor->id)}}">
            <span class="glyphicon glyphicon-pencil"></span>
          </a>
          @endshield
          <a class = "btn btn-sm btn-default" title="DETALHAR" href="{{ route('fornecedor.show', $fornecedor->id)}}">
            <span class="glyphicon glyphicon-eye-open"></span>
          </a>
        </td>
      </tr>

    @endforeach
  </table>

@endsection
