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
                      {{-- <a href="{{ route('estoque.menu',$estoque->id) }}">
                        <div class="well">
                          {{ $estoque->descricao }}
                        </div> --}}

                        <div class="col-sm-3">
                            <a href="{{ route('estoque.menu',$estoque->id) }}">
                        	       <div class="panel panel-yellow">
                        	           <div class="panel-heading">
                        	               <div class="row">
                        	                   <div class="col-xs-3">
                        	                       <i class="fa fa-fw fa-cart-arrow-down fa-4x"></i>
                                                 {{-- <b>{{ $estoque->descricao }}</b> --}}
                        	                   </div>
                        	                   <div class="col-xs-9 text-left">
                        	                       <div style="font-size: 30px;">
                                                   {{ $estoque->descricao }}

                        	                       {{-- <i class="fa fa-fw fa-lg fa-exclamation-circle" style="margin:6px"></i> --}}
                        	                       </div>
                        	                   </div>
                        	               </div>
                        	           </div>
                                 </div>
                             </a>
                          </div>
                    @endif
                @endforeach
        @endforeach

@endsection
