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
{{-- <i class="fa fa-fw fa-truck fa-4x"></i> --}}
{{-- <i class="fa fa-fw fa-cart-arrow-down fa-4x"></i> --}}

<div class="col-sm-2">
       <a href="{{url('/estoque/entrada')}}">
       {{-- <a href="{{route('estoque.entrada')}}"> --}}

         {{-- <a href="{{ route('estoque.menu',$estoque->id) }}"> --}}

	       <div class="panel panel-yellow">
	           <div class="panel-heading">
	               <div class="row">
	                   <div class="col-xs-2">
                            <i class="fa fa-fw fa-truck fa-4x"></i>
	                   </div>
	               </div>
	           </div>

               <div class="panel-footer">
                   <span class="pull-left">Entrada de Produtos</span>
                   <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                   <div class="clearfix"></div>
               </div>
	       </div>
       </a>
  </div>

  <div class="col-sm-2">
        <a href="{{route('estoque.saida',$estoque->id)}}">
  	       <div class="panel panel-yellow">
  	           <div class="panel-heading">
  	               <div class="row">
  	                   <div class="col-xs-2">
                              <i class="fa fa-fw fa-cart-arrow-down fa-4x"></i>
  	                   </div>
  	               </div>
  	           </div>

                 <div class="panel-footer">
                     <span class="pull-left">Saída para Setor</span>
                     <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                     <div class="clearfix"></div>
                 </div>
  	       </div>
         </a>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-user').select2();
        });
    </script>
@endsection
