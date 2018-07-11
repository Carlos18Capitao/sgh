<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Produto</title>

    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
<style>
        .container {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #FFFFFF;
        }

        .content {
        position: absolute;
        top: 50%;
        /*left: 25%;*/
        /*width: 50%;*/
        text-align: center;
        -webkit-transform: translateY( -50% );
        -moz-transform: translateY( -50% );
        transform: translateY( -50% );
        }
</style>
</head>
<body>

    <div class="container">
        <div class="content">
{{--            <h1>{{ $produtos->codigo . ' - ' . $produtos->produto }}</h1>--}}
                
                        @if($lotes->produto->categoria_id != 6)
                            {{--@php--}}
                           {{--//     $shorttitle = explode('.',$produtos->produto);--}}
                           {{--// print $produtos->codigo . ' - ' . $shorttitle[0];--}}

                           {{--print mb_substr($produtos->produto,0,50);--}}
                            {{--@endphp--}}
                            <font size="8"><b> 
                           @php
                            $limite = 120;
                            $quebrar = true;

                            //corta as tags do texto para evitar corte errado
                            $contador = strlen(strip_tags($lotes->produto->produto));
                            if($contador <= $limite):
                            //se o número do texto for menor ou igual o limite então retorna ele mesmo
                            $newtext = $lotes->produto->produto;
                            else:
                            if($quebrar == true): //se for maior e $quebrar for true
                            //corta o texto no limite indicado e retira o ultimo espaço branco
                            $newtext = trim(mb_substr($lotes->produto->produto, 0, $limite))."...";
                            else:
                            //localiza ultimo espaço antes de $limite
                            $ultimo_espaço = strrpos(mb_substr($lotes->produto->produto, 0, $limite)," ");
                            //corta o $texto até a posição lozalizada
                            $newtext = trim(mb_substr($lotes->produto->produto, 0, $ultimo_espaço))."...";
                            endif;
                            endif;
                            $newproduto = explode('DESCRIÇÃO',$newtext);

                            print  $lotes->produto->codigo . ' - ' . $newproduto[0] ;

                            @endphp
                            </b></font>
                        @else
                            <font size="9">
                                <b>
                                    {{ $lotes->produto->codigo . ' - ' . $lotes->produto->produto }}
                                </b>
                            </font>
                        @endif
            <br><br><br><br>
            <p><font size="6"><b> - {{ $lotes->produto->unidade }} - </b></font></p><br>
            {{--{!! QrCode::size(100)->generate('Me transforme em um QrCode!'); !!}--}}
            <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(130)->generate("http://sgh.jcadm.com/estoque/produto/$lotes->produto_id")) }} ">

            <br>
            <font size="5">           
                Lote: <b>{{ $lotes->lote }}</b>  Validade: <b>{{ $lotes->ValidadeFormat}}</b>
            </font>    
        </div>
    </div>

</body>
