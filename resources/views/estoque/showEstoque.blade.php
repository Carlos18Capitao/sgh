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

    {{-- <a href="{{ route('estoque.create')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Cadastrar</a> --}}
    <a class = "btn btn-sm btn-default" href="{{ route('estoque.edit',$estoque->id)}}">
        <span class="glyphicon glyphicon-pencil"></span>
    </a>
    {{--@endshield--}}
    <button type="button" title="EXCLUIR" class="btn btn-sm btn-default" data-toggle="modal" data-target="#excluir{{$estoque->id}}">
        <span class="glyphicon glyphicon-trash"></span>
    </button>
    <br><br>

    <p><b>Descrição:</b> {{ $estoque->descricao }}</p>
    <p><b>Controla Lote?</b> {{ $estoque->lote_formatted }}</p>
    <p><b>Controla Validade?</b> {{ $estoque->validade_formatted }}</p>

<hr>

    @if (Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! Session::get('success') !!}</li>
        </ul>
      </div>
    @endif

<div class="row">
    <div class="col-sm-4">

        <b>Vincular USUÁRIO ao estoque:</b>
            {!! Form::open(['route' => ['estoque.userstore',$estoque->id], 'class' => 'form']) !!}
            {!! Form::hidden('estoque_id',$estoque->id) !!}
            {!! Form::select('user_id',$users->pluck('name','id'),null,['class'=>'js-user form-inline', 'data-width="300px"','placeholder'=>'Selecione o usuário...'])!!}
            {!! Form::submit('Vincular', ['class' => 'btn btn-primary']) !!}
            {!! Form::close(); !!}
    </div>

    <div class="col-sm-5">
        <b>Vincular PRODUTO ao estoque:</b>
            {!! Form::open(['route' => ['estoque.produtostore',$estoque->id], 'class' => 'form']) !!}
            {!! Form::hidden('estoque_id',$estoque->id) !!}
            <select class="js-produto form-inline" data-width="400px" name="produto_id"><option selected="selected" value="">Selecione o produto...</option>
                @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->produto . ' - ' . $produto->unidade . ' - ' . '(' . $produto->codigo . ')' }}</option>
                @endforeach
            </select>
         {{--   {!! Form::select('produto_id',$produtos->pluck('produto','id'),null,['class'=>'js-produto form-inline','data-width="400px"','placeholder'=>'Selecione o produto...'])!!} --}}
            {!! Form::submit('Vincular', ['class' => 'btn btn-primary']) !!}
            {!! Form::close(); !!}
      </div>
</div>

    <br><br>

<div class="row">
    <div class="col-sm-4">
        <p><b>Usuários Vinculados:</b></p>
            @foreach ($estoque->user as $user)
              <ul>
                <li>{{ $user->name }}</li>
              </ul>
            @endforeach
    </div>
    <div class="col-sm-5">
        <p><b>Produtos Vinculados:</b></p>
            @foreach ($estoque->produto as $produto)
              <ul>
                <li>{{ $produto->produto . ' - ' . $produto->unidade . '(' . $produto->codigo . ')' }}</li>
              </ul>
            @endforeach
    </div>
</div>

                    <!-- Modal EXCLUIR-->
                    <div class="modal fade" id="excluir{{$estoque->id}}" tabindex="-1" role="dialog" aria-labelledby="excluir">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Deseja excluir?</h4>
                                </div>
                                <div class="modal-body">
                                    <div align="center">
                                        <b>{{ $estoque->descricao }}</b>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open(['route'=> ['estoque.destroy',$estoque->id], 'method'=>'DELETE']) !!}
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class = "btn btn-danger"> <span class="glyphicon glyphicon-trash"></span> Excluir </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.js-user').select2(),
            $('.js-produto').select2();
        });
    </script>
@endsection
