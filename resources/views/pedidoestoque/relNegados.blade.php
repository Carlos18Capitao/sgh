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

    @foreach (Auth::user()->estoques as $stoq)
        @if ($estoque_id == $stoq->pivot->estoque_id)

            {{-- @if($estoque->id == Auth::user()->user_estoques->id) --}}

                <a href="{{route('estoque.entrada',$estoque_id)}}">
                    <i class="fa fa-fw fa-truck fa-2x"></i>
                </a>

                <a href="{{route('estoque.saida',$estoque_id)}}">
                    <i class="fa fa-fw fa-cart-arrow-down fa-2x"></i>
                </a>

                <a href="{{route('relposicaoestoque',$estoque_id)}}">
                    <i class="fa fa-fw fa-file-text fa-2x"></i>
                </a>
            <a title="IMPRIMIR" href="{{ route('pdfposicaoestoque',$estoque_id)}}">
                <i class="fa fa-fw fa-print fa-2x"></i>
            </a>
           @else
        @endif
    @endforeach


    @foreach($negados as $negado)

        @endforeach
    <br><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>@sortablelink('codigo','Código')</th>
            <th>@sortablelink('produto','Produto')</th>
        </tr>
        </thead>
        @foreach ($negados as $negado)
            <tbody>
            <td>{{ $negado->codigo }}</td>
            <td>{{ $negado->produto }}</td>

            </tbody>
        @endforeach

          {{--@foreach ($estoque->produto as $produto)--}}
            {{--<tbody>--}}
            {{--<td>{{ $produto->categoria->descricao  }}</td>--}}
            {{--<td>{{ $produto->codigo }}</td>--}}
            {{--<td><a href="{{ route('produto.show',$produto->id) }}">{{ $produto->produto }}</a></td>--}}
            {{--<td>{{ $produto->unidade }}</td>--}}
            {{--<td>{{ $produto->produtoentrada->sum('qtd') - $produto->produtosaida->sum('qtd') }}--}}
            {{--</td>--}}

            {{--</tbody>--}}
          {{--@endforeach--}}

        {{--@endforeach--}}
    </table>
@endsection
