@extends('adminlte::page')

@section('content')

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
                <a href="{{route('estoque.menu',$estoque_id)}}">
                    <i class="glyphicon glyphicon-th-large fa-2x"></i>
                </a>

                <a href="{{route('estoque.entrada',$estoque_id)}}">
                    <i class="fa fa-fw fa-truck fa-2x"></i>
                </a>

                <a href="{{route('estoque.saida',$estoque_id)}}">
                    <i class="fa fa-fw fa-cart-arrow-down fa-2x"></i>
                </a>

                <a href="{{route('relposicaoestoque',$estoque_id)}}">
                    <i class="fa fa-fw fa-file-text fa-2x"></i>
                </a>
            {{--<a title="IMPRIMIR" href="{{ route('pdfposicaoestoque',$estoque_id)}}">--}}
                {{--<i class="fa fa-fw fa-print fa-2x"></i>--}}
            {{--</a>--}}
           @else
        @endif
    @endforeach
<br><br>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><b>{{ $title }}</b></h3>
    </div>
    <div class="panel-body">
{!! Form::open([route('reldemandasetor',$estoque_id), 'class' => 'Form', 'method' => 'POST']) !!}
<div class="form-group">
    {!! Form::label('setor_id', 'Unidade:'); !!}
    <select name="setor_id" id="setor_id" class="js-setor form-control">
    @foreach($setors as $setor)
        <option value="{{ $setor->id }}">{{ $setor->setor }}</option>
    @endforeach
</select>
{!! Form::label('codigo', 'Codigos (separados por vírgula):'); !!}
{!! Form::textarea('codigo', null, ['class' => 'form-control', 'placeholder' => 'Digite os codigos dos itens separados por vírgula','size'=>'100x3']) !!}

{!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
</div>
</div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.js-setor').select2()
        ;
    });
</script>
    <script>
        $(document).ready(function() {
            $('#estoques').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            } );
        } );
  </script>
@endsection