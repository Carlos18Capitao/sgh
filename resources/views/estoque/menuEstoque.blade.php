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
{{-- {{ $estoque->id }} --}}
@foreach (Auth::user()->estoques as $stoq)

  @if ($estoque->id == $stoq->pivot->estoque_id)

{{-- @if($estoque->id == Auth::user()->user_estoques->id) --}}

<div class="col-sm-2">
       {{-- <a href="{{url('/estoque/entrada')}}"> --}}
       <a href="{{route('estoque.entrada',$estoque->id)}}">

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
                     <span class="pull-left">Saída de Produtos </span>
                     <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                     <div class="clearfix"></div>
                 </div>
  	       </div>
         </a>
    </div>

{{--<div class="col-sm-2">--}}
    {{--<a href="{{route('estoque.pedido',$estoque->id)}}">--}}
        {{--<div class="panel panel-yellow">--}}
            {{--<div class="panel-heading">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-xs-2">--}}
                        {{--<i class="fa fa-fw fa-cart-arrow-down fa-4x"></i>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="panel-footer">--}}
                {{--<span class="pull-left">Pedido de Produtos</span>--}}
                {{--<span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>--}}
                {{--<div class="clearfix"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</a>--}}
{{--</div>--}}

    <div class="col-sm-2">
          <a href="{{route('relposicaoestoque',$estoque->id)}}">
             <div class="panel panel-yellow">
                 <div class="panel-heading">
                     <div class="row">
                         <div class="col-xs-2">
                                <i class="fa fa-fw fa-file-text fa-4x"></i>
                         </div>
                     </div>
                 </div>

                   <div class="panel-footer">
                       <span class="pull-left">Relatório Posição de Estoque</span>
                       <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                       <div class="clearfix"></div>
                   </div>
             </div>
           </a>
      </div>

<div class="col-sm-2">
    <a href="{{route('negados',$estoque->id)}}">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-fw fa-exclamation-triangle fa-4x"></i>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <span class="pull-left">Relatório Negados por Período</span>
                <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </div>
    </a>
</div>

<div class="col-sm-2">
    <a href="{{route('reldemandaestoque',$estoque->id)}}">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-fw fa-line-chart fa-4x"></i>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <span class="pull-left">Relatório Demanda x Estoque</span>
                <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </div>
    </a>
</div>

<div class="col-sm-2">
    <a href="{{route('relLoteValidade',$estoque->id)}}">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-fw fa-calendar-times-o fa-4x"></i>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <span class="pull-left">Relatório Lote e Validade</span>
                <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                <div class="clearfix"></div> 
            </div>
        </div>
    </a>

</div>

<div class="col-sm-2">
        <a href="{{route('relposicaoestoquelotes',$estoque->id)}}">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-2">
                            <i class="fa fa-fw fa-cubes fa-4x"></i>
                        </div>
                    </div>
                </div>
    
                <div class="panel-footer">
                    <span class="pull-left">Estoque com Lote e Validade</span>
                    <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                    <div class="clearfix"></div> 
                </div>
            </div>
        </a>
    
    </div>

<div class="col-sm-2">
    <a href="{{route('requisicao',$estoque->id)}}">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-2">
                        <i class="fa fa-fw fa-cart-plus fa-4x"></i>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <span class="pull-left">Requisição</span>
                <span class="pull-right"><i class="fa fa-fw fa-lg fa-arrow-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </div>
    </a>
</div>
    @else
      
    @endif
  @endforeach
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.js-user').select2();
        });
    </script>
@endsection
