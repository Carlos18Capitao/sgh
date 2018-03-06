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
          <a class = "btn btn-sm btn-default" title="EDITAR" href="{{ route('empresa.edit',$empresas->id)}}">
            <span class="glyphicon glyphicon-pencil"></span>
          </a>

    <br><br>
    <p><b>ID:</b> {{ $empresas->id }}</p>
    <p><b>Fornecedor:</b> {{ $empresas->nome }}</p>
    <p><b>CNPJ:</b> <a target="_blank" href="http://transparencia.al.gov.br/despesa/despesas-por-favorecido/{{ $empresas->cnpj}}/510556">{{ $empresas->getOriginal('cnpj') }}</a></p>
    <p><b>E-mail:</b> {{ $empresas->email }} </p>
    <p><b>Telefone:</b> {{ $empresas->telefone }} </p>
    <p><b>Endereço:</b> {{ $empresas->endereco }} </p>
    <p><b>Responsável:</b> {{ $empresas->responsavel }}
    <p><b>Observações:</b> {{ $empresas->area }} </p>

    <hr>

    {{--<table class="table table-striped">--}}
        {{--<tr>--}}
            {{-- <th>ID</th> --}}
            {{--<th>Objeto</th>--}}
            {{--<th>Ata</th>--}}
            {{--<th>Vigência</th>--}}
            {{--<th>Expira em</th>--}}
            {{--<th width="150px">Abrir Processo</th>--}}
        {{--</tr>--}}
        {{--@foreach ($fornecedors->atas as $ata)--}}
            {{--<tr>--}}
                {{-- <td>{{ $unidade->id }}</td> --}}

                {{--<td>{{ $ata->objeto->objeto }}</td>--}}
                {{--<td><a href="{{ route('ata.show', $ata->id)}}"> {{ $ata->arp }} </a></td>--}}
                {{--<td>{{ $ata->vigencia->format('d/m/Y') }}</td>--}}
                {{--<td>{{ $ata->vigencia->diffInDays($hoje)}} dias</td>--}}

                {{--<td>--}}
                    {{--@shield('processo.cadastrar')--}}
                    {{--<a class = "btn btn-sm btn-default" title="CADASTRAR PROCESSO" href="{{ route('processo.show', $ata->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-folder-open"></span>--}}
                    {{--</a>--}}
                    {{--@endshield--}}
                     {{--<a class = "btn btn-sm btn-default" title="COPIAR DADOS PARA ENVIO DE EMPENHO" href="{{ route('fornecedor.memo', $ata->id)}}">--}}
                        {{--<span class="glyphicon glyphicon-copy"></span>--}}
                    {{--</a>--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{----}}
        {{--@endforeach--}}
    {{--</table>--}}

<div align ="right">
    {!! Form::open(['route'=> ['empresa.destroy',$empresas->id], 'method'=>'DELETE']) !!}
    {!! Form::submit("Excluir empresa",['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
</div>
@endsection
