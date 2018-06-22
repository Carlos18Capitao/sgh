@extends('layouts.pdf')
{{--<style type="text/css">--}}
    {{--table {--}}
        {{--border-color:black;--}}
        {{--border-style: solid;--}}
        {{--border-bottom-width: 1px;--}}
        {{--border-top-width: 1;--}}
        {{--border-right-width: 1;--}}
        {{--border-left-width: 1;--}}
        {{--padding: 1px;--}}
        {{--border-collapse: collapse;--}}
        {{--width: 700px;--}}

    {{--}--}}
    {{--table td, table th {--}}
        {{--border-color:black;--}}
        {{--border-style: solid;--}}
        {{--border-bottom-width: 1px;--}}
        {{--border-top-width: 1;--}}
        {{--border-right-width: 1;--}}
        {{--border-left-width: 1;--}}
        {{--padding: 1px;--}}
        {{--border-collapse: collapse;--}}
    {{--}--}}

{{--</style>--}}

@section('content')

    <div class="text-center">
        <font size="1">
            Universidade Estadual de Ciências da Saúde <br>
            Almoxarifado Central
        </font>

        <hr>
    @if($pedido->tipopedido == 'unidade')
        <font size="2">Requisição Nº {{ $pedido->requisicao }}</font>
    @else
        <font size="2"> {{ strtoupper($pedido->tipopedido) }}</font>
    @endif
    </div>

    <br>
    <font size="2">
        Tipo: {{ $pedido->estoque->descricao }} <br>
        Para:
        @if($pedido->tipopedido == 'unidade')
            {{ $pedido->setor->setor }}
        @else
            {{ $pedido->externo }}
        @endif

        <br>
        Data: {{ $pedido->datapedido }} <br>
    </font>
    <font size="2">
        Observações: {!! nl2br($pedido->obs) !!}
    </font>

    <table width="100%" class="table-sm table-bordered">
        <thead>
        <tr>
            <th align="center"><font size="1"> Código </font></th>
            <th align="center"><font size="1"> Produto </font></th>
            <th align="center"><font size="1"> Unidade </font></th>
            <th align="center"><font size="1"> Lote </font></th>
            <th align="center"><font size="1"> Validade </font></th>
            <th align="center"><font size="1"> Qtd </font></th>
        </tr>
        </thead>
        @foreach ($produtosaidas as $produtosaida)
         <tbody>
            <tr>
                <td align="center"><font size="1">{{ $produtosaida->produto->codigo  }}</font></td>
                <td><font size="1">
                    
                
                        @if($produtosaida->produto->categoria_id != 6)
                       @php
                        $limite = 120;
                        $quebrar = true;

                        //corta as tags do texto para evitar corte errado
                        $contador = strlen(strip_tags($produtosaida->produto->produto));
                        if($contador <= $limite):
                        //se o número do texto for menor ou igual o limite então retorna ele mesmo
                        $newtext = $produtosaida->produto->produto;
                        else:
                        if($quebrar == true): //se for maior e $quebrar for true
                        //corta o texto no limite indicado e retira o ultimo espaço branco
                        $newtext = trim(mb_substr($produtosaida->produto->produto, 0, $limite))."...";
                        else:
                        //localiza ultimo espaço antes de $limite
                        $ultimo_espaço = strrpos(mb_substr($produtosaida->produto->produto, 0, $limite)," ");
                        //corta o $texto até a posição lozalizada
                        $newtext = trim(mb_substr($produtosaida->produto->produto, 0, $ultimo_espaço))."...";
                        endif;
                        endif;
                        $newproduto = explode('DESCRIÇÃO',$newtext);

                        print  $newproduto[0] ;

                        @endphp
                    @else
                                {{ $produtosaida->produto->produto }}
                    @endif



                    {{-- $produtosaida->produto->produto --}}
                
                </font></td>
                <td><font size="1">{{ $produtosaida->produto->unidade }}</font></td>
                <td align="center"><font size="1">{{ $produtosaida->lote  }}</font></td>
                <td align="center"><font size="1">{{ $produtosaida->validade  }}</font></td>
                <td align="center"><font size="1">{{ $produtosaida->qtd }}</font></td>
            </tr>
         </tbody>
        @endforeach
    </table>
    <br><br>
    <table width="100%" class="table-sm table-bordered">
            <tr>
                <td><font size="1">Separado por:</font><br><br></td>
                <td><font size="1">Conferido por:</font><br><br></td>
                <td><font size="1">Recebido por:</font><br><br></td>
            </tr>
    </table>
@endsection