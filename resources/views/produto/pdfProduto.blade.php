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
                
                        @if($produtos->categoria_id == 7)
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
                            $contador = strlen(strip_tags($produtos->produto));
                            if($contador <= $limite):
                            //se o número do texto for menor ou igual o limite então retorna ele mesmo
                            $newtext = $produtos->produto;
                            else:
                            if($quebrar == true): //se for maior e $quebrar for true
                            //corta o texto no limite indicado e retira o ultimo espaço branco
                            $newtext = trim(mb_substr($produtos->produto, 0, $limite))."...";
                            else:
                            //localiza ultimo espaço antes de $limite
                            $ultimo_espaço = strrpos(mb_substr($produtos->produto, 0, $limite)," ");
                            //corta o $texto até a posição lozalizada
                            $newtext = trim(mb_substr($produtos->produto, 0, $ultimo_espaço))."...";
                            endif;
                            endif;
                            $newproduto = explode('DESCRIÇÃO',$newtext);

                            print  $produtos->codigo . ' - ' . $newproduto[0] ;

                            @endphp
                            </b></font>
                        @else
                            <font size="9">
                                <b>
                                    {{ $produtos->codigo . ' - ' . $produtos->produto }}
                                </b>
                            </font>
                        @endif
            <br><br><br><br>
            <p><font size="6"><b> - {{ $produtos->unidade }} - </b></font></p>
            {{--{!! QrCode::size(100)->generate('Me transforme em um QrCode!'); !!}--}}
            <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(130)->generate("http://sgh.jcadm.com/estoque/produto/$produtos->id")) }} ">
        </div>
    </div>

</body>
