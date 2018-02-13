{{-- @extends('template.master') --}}
{{-- @extends('template._menu') --}}


<style type="text/css">
  table {
    border-color:black;
    border-style: solid;
    border-bottom-width: 1px;
    border-top-width: 1;
    border-right-width: 1;
    border-left-width: 1;
    padding: 10px;
    border-collapse: collapse;
    }
    table td, table tr {
    border-color:black;
    border-style: solid;
    border-bottom-width: 1px;
    border-top-width: 1;
    border-right-width: 1;
    border-left-width: 1;
    padding: 3px;
    border-collapse: collapse;
    }

</style>

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
    
<br>
<br>
<br>
<br>
<br>
 {{--   <p><b>ID:</b> {{ $atas->fornecedor->id }}</p>
    <p><b>Fornecedor:</b> {{ $atas->fornecedor->nome }}</p>
    <p><b>CNPJ:</b> <a target="_blank" href="http://transparencia.al.gov.br/despesa/despesas-por-favorecido/{{ $atas->fornecedor->cnpj2 = preg_replace('@[./-]@', '', $atas->fornecedor->cnpj)}}/510556">{{ $atas->fornecedor->cnpj }}</a></p>
    <p><b>E-mail:</b> {{ $atas->fornecedor->email }} </p>
    <p><b>Telefone:</b> {{ $atas->fornecedor->telefone }} </p>
    <p><b>Endereço:</b> {{ $atas->fornecedor->endereco }} </p>
    <p><b>Responsável:</b> {{ $atas->fornecedor->responsavel }}
    <p><b>Observações:</b> {{ $atas->fornecedor->area }} </p>
{{ $atas->arp}}
--}}
    <table width="100%" class="table-sm table-bordered table-condensed">
            <tr>
                <td> Fornecedor </td>
                <td> {{ $atas->fornecedor->nome }} </td>                
            </tr>
            <tr>           
                <td>Contato</td>
                <td> {{ $atas->fornecedor->telefone }} <br> {{ $atas->fornecedor->email }} </td>
            </tr>
            <tr>               
                <td>Responsável</td>
                <td> {{ $atas->fornecedor->responsavel }} </td>                
            </tr>
            <tr>          
                <td>ARP</td>
                <td> {{ $atas->arp }}</td>
            </tr>
    </table>

@endsection
