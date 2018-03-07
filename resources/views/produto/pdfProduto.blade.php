<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Produto</title>

    <!--Custon CSS (está em /public/assets/site/css/certificate.css)-->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
</head>
<body>

    <div class="text-center">
        {{--<h3>{{ $title }}</h3>--}}
    </div>

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <br><br>
    <p><b>Descrição:</b> {{ $produtos->codigo . ' - ' . $produtos->produto }}</p>
    <p><b>Unidade:</b> {{ $produtos->unidade }}</p>
    <p><b>Categoria:</b> {{ $produtos->categoria->descricao }}</p>
    <p><b>Saldo: </b>{{ $produtos->produtoentrada->sum('qtd') - $produtos->produtosaida->sum('qtd') }}
              @if($produtos->unidade == 'Grama')
                   {{ '  |  ' . ($produtos->produtoentrada->sum('qtd') - $produtos->produtosaida->sum('qtd'))/1000 .'kg' }}</p>
              @endif

    <hr>
<b> ENTRADAS </b>
    <table class="table table-striped">
    <thead>
    <tr>
        <th>@sortablelink('created_by','Usuário')</th>
        <th>@sortablelink('created_at','Data de Entrada')</th>
        <th>@sortablelink('qtd','Qtd')</th>
        <th>@sortablelink('lote','Lote')</th>
        <th>@sortablelink('validade','Validade')</th>
        <th>Entrada</th>
    </tr>
    </thead>
@foreach($produtos->produtoentrada as $entproduto)
            <tbody>
                <td>{{ $entproduto->user->name }}</td>
                <td>{{ $entproduto->created_at }}</td>
                <td>{{ $entproduto->qtd }}
                <td>{{ $entproduto->lote }}
                <td>{{ $entproduto->validade }}
                <td><a href="{{ route('entrada.show',$entproduto->entrada_id) }}">{{ $entproduto->entrada_id }}</a></td>
            </tbody>
@endforeach
    </table>
<b>Total de Entradas:</b> {{ $produtos->produtoentrada->sum('qtd') }}
  @if($produtos->unidade == 'Grama')
    {{' | ' . ($produtos->produtoentrada->sum('qtd'))/1000 . 'Kg'}}
  @endif
    <hr>

<b> SAÍDAS </b>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('setor_id','Setor')</th>
            <th>@sortablelink('created_at','Data de Saída')</th>
            <th>@sortablelink('qtd','Qtd')</th>
            <th>@sortablelink('obs','Lote/Obs')</th>
            <th>Requisição</th>                        
            <th>@sortablelink('created_by','Usuário')</th>
        </tr>
        </thead>
        @foreach($produtos->produtosaida as $saiproduto)
            <tbody>
            <td>{{ $saiproduto->setor->setor }}</td>
            <td>{{ $saiproduto->created_at }}</td>
            <td>{{ $saiproduto->qtd }}
            <td>{{ $saiproduto->obs }}
            <td>{{ $saiproduto->pedido->requisicao }}</td>
            <td>{{ $saiproduto->user->name }}</td>
            </tbody>
        @endforeach
    </table>
    <b>Total de Saídas:</b> {{ $produtos->produtosaida->sum('qtd') }}
    @if($produtos->unidade == 'Grama')
        {{' | ' .  ($produtos->produtosaida->sum('qtd'))/1000 . 'Kg' }}
    @endif
    <br><br>