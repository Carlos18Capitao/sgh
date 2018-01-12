@extends('adminlte::page')

@section('content')
    <div class="text-center">
      <img src="{{ asset('img/brasaoAL.png') }}" alt="BRASAO ALAGOAS"> <br>
      ESTADO DE ALAGOAS <br>
      UNIVERSIDADE ESTADUAL DE CIÊNCIAS DA SAÚDE DE ALAGOAS - UNCISAL <br>
      Hospital Escola Portugal Ramalho - HEPR <br>
      Campus Governador Lamenha Filho - R. Oldemburgo da Silva Paranhos, s/n - Farol, Maceió - AL, 57055-000 <br>
      Fone: (82) 3315-2494 - CNPJ 12.517.793/0009-57
<br>

        <h3>Solicitação de Emissão de Ordem Bancária – O. B.</h3>
    </div>

    <br>

<table>
  <tr>
<td width="300px"></td>
<td width="300px"></td>
<td>
    <table width="300px" border="1">
      <tr>
        <td>Processo:</td>
        <td>{{ $ordembancarias->processo }}</td>
      </tr>
      <tr>
          <td>N.E.:</td>
          <td>{{ $ordembancarias->empenho }}</td>
      </tr>
    </table>
    </td>
  </tr>

  </table>


Da: Gerência Geral do Hospital Escola Portugal Ramalho <br>
Ao: SELIQ - UNCISAL <br><br>

Solicitamos Providências para emissão de Ordem Bancária em favor de:<br><br>

<table width="100%" border="1">
  <tr>
    <th>Nome do Favorecido:</th>
    <th>CPF</th>
  </tr>
  <tr>
      <td>{{ $ordembancarias->fornecedor->descricao }}</td>
      <td>{{ $ordembancarias->fornecedor->cpf_cnpj }}</td>
  </tr>
</table>
<br>
<div class="text-right">
  <p><b>R$ {{ $ordembancarias->valor_formatted }} </b></p>
</div>

<table width="100%" border="1">
  <tr>
    <th>Valor por extenso:</th>
  </tr>
  <tr>
    <td>{{ $ordembancarias->valor_extenso }}</td>
  </tr>
</table>
<br>
    <table width="300px" border="1">
      <tr>
        <td>Documento Fiscal Nº</td>
        <td>{{ $ordembancarias->nf }}</td>
      </tr>
      <tr>
          <td>Data de Emissão:</td>
          <td>{{ $ordembancarias->emissaonf_formatted }}</td>
      </tr>
    </table>

<br>

<div class="text-center">
  <b>Domicílio Bancário do Favorecido</b>
</div>

<table width="100%" border="1">
  <tr>
    <th>Banco</th>
    <th>Nome do Banco</th>
    <th>Agência</th>
    <th>Nome da Agência</th>
    <th>Conta Corrente</th>
  </tr>
  <tr>
      <td>{{ $ordembancarias->fornecedor->banco }}</td>
      <td></td>
      <td>{{ $ordembancarias->fornecedor->agencia }}</td>
      <td></td>
      <td>{{ $ordembancarias->fornecedor->conta }}</td>
  </tr>
</table>

<br><br>

<div class="text-right">
  {{ $ordembancarias->now() }}
</div>
<br>
<div class="text-center">
  <b>Audenis Lima de Aguiar Peixoto</b> <br>
  <b>Gerente Geral do HEPR</b> <br><br>

  <img src="{{ asset('img/rodapeAL.png') }}" alt="RODAPE ALAGOAS">

</div>

@endsection
