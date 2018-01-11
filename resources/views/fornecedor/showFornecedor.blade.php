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
    <br><br>
    <p><b>Descrição:</b> {{ $fornecedors->descricao }}</p>
    <p><b>CPF/CNPJ:</b> {{ $fornecedors->cpf_cnpj }}</p>
    <p><b>Categoria:</b> {{ $fornecedors->tipo_pessoa }}</p>
    <p><b>Dados bancarios:</b> {{ 'Banco: ' . $fornecedors->banco . '   Ag: ' . $fornecedors->agencia . '  C/C: ' . $fornecedors->conta }}</p>

    <hr>
<b> PROCESSOS </b>
    <table class="table table-striped">
    <thead>
    <tr>
        <th>@sortablelink('processo','Processo')</th>
        <th>@sortablelink('valor','Valor')</th>
        <th>@sortablelink('empenho','Empenho')</th>
        <th>@sortablelink('nf','Nota Fiscal')</th>
        <th>@sortablelink('emissaonf','Data Emissão NF')</th>
    </tr>
    </thead>
@foreach($fornecedors->ordembancaria as $ob)
            <tbody>
                <td>{{ $ob->processo }}</td>
                <td>{{ $ob->valor_formatted }}</td>
                <td>{{ $ob->empenho }}</td>
                <td>{{ $ob->nf }}</td>
                <td>{{ $ob->emissaonf }}</td>
            </tbody>
@endforeach
    </table>
@endsection
