{{-- @extends('template.master') --}}


@section('content')
<br><br>

<div class="row">
  <div class="col-xs-12 col-md-8">

Segue ata publicada no DOE.
<br>
<b>Solicitamos informação quanto a necessidade de abertura de processo, quantidade para aquisição (com rateio) e a forma de parcelamento.</b>
<br><br>

    <p><b>Ata:</b> {{ $atas->arp }} - {{ $atas->objeto->objeto }} </p>
    <p><b>Vigência:</b> {{ $atas->vigencia->format('d/m/Y') }}   -   Faltam: <b>{{ $fimAta }}</b> dias para o fim da vigência</p>
    <p><b>Fornecedor:</b> {{ $atas->fornecedor->nome }} </p>

    <table class="table table-striped">
        <tr>
            <th width="200px">Item ARP</th>
            <th width="600px">Descrição DOE</th>
            <th width="200px">Unidade</th>
            <th width="200px">Marca</th>
            <th width="200px">Preço Registrado</th>
            <th width="200px">Quantidade Registrada</th>
            <th width="200px">Valor Total</th>
        </tr>
 
        @foreach($atas->itemata as $itemata2)
            <tr>
                <td>{{ $itemata2->itemarp }} </td>
                <td>{{ $itemata2->descdoe }} </td>
                <td>{{ $itemata2->unidade }}
                <td>{{ $itemata2->marca }} </td>
                {{--<td>{{$itemata2->precoreg}}</td>--}}
                <td>{{ $itemata2->precoreg }} </td>
                <td>{{ $itemata2->getOriginal("qtdreg") }} </td>
                <td>{{ number_format($itemata2->getOriginal("precoreg") * $itemata2->qtdreg, 4,',','.') }}</td>
            </tr>
        @endforeach

    </table>

Favor, confirmar o recebimento do e-mail.
</div>

</div>
@endsection