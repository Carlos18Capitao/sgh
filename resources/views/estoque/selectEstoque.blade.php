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

    <br><br>

        @foreach ($estoques as $estoque)
              @foreach ($estoque->user as $estuser)
                  @if(Auth::user()->id == $estuser->pivot->user_id)

                      <div class="well">
                        <a href="{{ route('estoque.show',$estoque->id) }}">{{ $estoque->descricao }}</a>
                      </div>

                    @endif
                @endforeach
        @endforeach

@endsection
