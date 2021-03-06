<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Lotes;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ProdutoSaida;
use App\Models\Setor;
use Illuminate\Http\Request;
use App\Http\Requests\PedidoFormRequest;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DB;
use Illuminate\Database\QueryException;


class PedidoController extends Controller
{
    private $pedido;

    public function __construct(Pedido $pedido, Estoque $estoque, Produto $produto, Setor $setor)
    {
        $this->pedido  = $pedido;
        $this->estoque = $estoque;
        $this->produto = $produto;
        $this->setor = $setor;
    }
    public function index($estoque_id)
    {
        $pedidos =  Pedido::sortable(['datapedido' => 'desc'])->where('estoque_id','=',$estoque_id)->get();
        $title   = 'Saída de Produtos';

        return view('pedidoestoque.consPedidoEstoque', compact('title', 'pedidos','estoque_id'));
    }

    public function create($estoque_id)
    {
        $title    = 'Saída de Produtos';
        $estoques = Estoque::with('produto')->where('id','=',$estoque_id)->get();
        $produtos = Produto::all()->sortBy('produto');
        $setors   = Setor::all()->sortBy('setor');

        return view('pedidoestoque.cadPedidoEstoque', compact('title','produtos','setors','estoque_id','estoques'));
    }

    public function store(PedidoFormRequest $request)
    {
        $pedidoForm = $request->all();
        $insert   = $this->pedido->create($pedidoForm);

        if ($insert)
            return redirect()->route('pedido.show',[$insert->id]);
        else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $pedido = Pedido::find($id);
        $produtosaidas = ProdutoSaida::where('pedido_id','=',$id)->orderBy('id','desc')->get();
        $title = 'Saída de Produtos';
//        $produtos = Produto::all();
        $estoques = Estoque::with('produto')->where('id','=',$pedido->estoque_id)->get();
        $produtos = DB::table('produtos')->pluck("produto","id")->all();
        $list = count($produtosaidas);

        return view('pedidoestoque.cadItemPedidoEstoque', compact('title','produtos','pedido','produtosaidas','estoques','list'));

    }

    public function edit($id)
    {
        $pedidos = Pedido::find($id);
        $title = "Editar Saída";
        $estoque_id = $pedidos->estoque_id;
        $estoques = Estoque::with('produto')->where('id','=',$estoque_id)->get();
        $produtos = Produto::all()->sortBy('produto');
        $setors = Setor::all()->sortBy('setor');

        return view('pedidoestoque.cadPedidoEstoque', compact('title', 'pedidos','estoque_id','estoques','produtos','setors'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $pedidos = Pedido::find($id);
        $update = $pedidos->update($dataForm);

        if ($update)
            return redirect()->route('pedido.show', $id);
        else
            return redirect()->route('pedido.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $pedidos = Pedido::find($id);
        $delete = $pedidos->delete();

        try{
            return redirect()->back()->with(['success'=>'Excluído com sucesso!!!!']);
        }catch (QueryException $e){
            return redirect()->back()->with(['errors'=>'Não foi possível excluir! Existem registros vinculados ao pedido!']);
        }
    }

    public function recibopedidoestoque($id)
    {
        $pedido = Pedido::find($id);
        $produtosaidas = ProdutoSaida::where('pedido_id','=',$id)->get();
        $estoques = Estoque::with('produto')->where('id','=',$pedido->estoque_id)->get();

        return \PDF::loadView('pedidoestoque.reciboPedidoEstoque', compact('pedido','produtosaidas','estoques'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
//            ->setPaper('a4', 'landscape')
//            ->download('etiquetaproduto.pdf');
            ->stream();
    }

    public function negados($estoque_id, Request $request)
    {
        $setor_id = $request->setor_id;
        $dataInicio = $request->dataInicio;
        $dataFim = $request->dataFim;

        if(isset($setor_id)){

        $negados = DB::select("
            select
               produtos.codigo
              ,concat(produtos.produto , ' - ', produtos.unidade) as produto
              ,pedidos.datapedido
            from
              pedidos
              left join produto_saidas as saida on pedidos.id = saida.pedido_id
              left join setors as s on pedidos.setor_id = s.id
              left join produtos on saida.produto_id = produtos.id
            where saida.qtd = 0
                and pedidos.setor_id =$setor_id
                and pedidos.estoque_id = $estoque_id
                and pedidos.datapedido between '$dataInicio' and '$dataFim'
            group by
                produtos.codigo
                ,produtos.produto
                ,produtos.unidade
                ,pedidos.datapedido
            order by produtos.produto,pedidos.datapedido
              ");
        //dd($negados);

        $title = 'Itens Negados';
        $setors = Setor::all()->sortBy('setor');

        return view('pedidoestoque.relNegados', compact('title', 'negados','estoque_id','setors','setor_id','dataInicio','dataFim'));
        }
        $title = 'Itens Negados';
        $setors = Setor::all()->sortBy('setor');

        return view('pedidoestoque.relNegados', compact('title', 'negados','estoque_id','setors','setor_id'));
    }

    public function selectAjax(Request $request)
    {
        if($request->ajax()){
            $lotes = Lotes::select(
                DB::raw("concat(lote, ' (Saldo: ', qtd, ')') as lotes, lote"))
                ->where([['produto_id',$request->produto_id],['qtd','>',0],['lote', '<>','null']])
//                ->where('qtd','>',0)
                ->pluck('lotes','lote')
                ->all();

//            $lotes = DB::table('lotes')->where('produto_id',$request->produto_id)->where('qtd','<>',0)->pluck("qtd","lote")->all();
            $data = view('pedidoestoque.ajax-select',compact('lotes'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function selectValidade(Request $request)
    {
        if($request->ajax()){
            $validades = Lotes::select(
                DB::raw("date_format(validade, '%d/%m/%Y') as val, validade"))
                ->where('lote',$request->lote)
                ->pluck('val','validade')
                ->all();

//            $lotes = DB::table('lotes')->where('produto_id',$request->produto_id)->where('qtd','<>',0)->pluck("qtd","lote")->all();
            $data = view('pedidoestoque.select-validade',compact('validades'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function selectQtd(Request $request)
    {
        if($request->ajax()){
            $qtds = Lotes::select(
                DB::raw("qtd, lote"))
                ->where('lote',$request->lote)
                ->where('qtd','>',0)
                ->pluck('qtd','lote')
                ->all();

          //  $qtds = DB::table('lotes')->where('lote',$request->lote)->where('qtd','>',0)->pluck("qtd","lote")->all();
            $data = view('pedidoestoque.select-qtd',compact('qtds'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function atendidos($estoque_id, Request $request)
    {
        $setor_id = $request->setor_id;
        $dataInicio = $request->dataInicio;
        $dataFim = $request->dataFim;

        if(isset($setor_id)){

            $atendidos = DB::select("
            select
               produtos.codigo
              ,concat(produtos.produto , ' - ', produtos.unidade) as produto
              ,sum(saida.qtd) as qtd
              ,pedidos.datapedido
            from
              pedidos
              left join produto_saidas as saida on pedidos.id = saida.pedido_id
              left join setors as s on pedidos.setor_id = s.id
              left join produtos on saida.produto_id = produtos.id
            where saida.qtd > 0
                and pedidos.setor_id in ($setor_id)
                and pedidos.estoque_id = $estoque_id
                and pedidos.datapedido between '$dataInicio' and '$dataFim'
            group by
                produtos.codigo
                ,produtos.produto
                ,produtos.unidade
                ,pedidos.datapedido
            order by produtos.produto,pedidos.datapedido
              ");
            //dd($negados);

            $title = 'Itens Atendidos';
            $setors = Setor::all()->sortBy('setor');

            return view('pedidoestoque.relAtendidos', compact('title', 'atendidos','estoque_id','setors','setor_id','dataInicio','dataFim'));
        }
        $title = 'Itens Atendidos';
        $setors = Setor::all()->sortBy('setor');

        return view('pedidoestoque.relAtendidos', compact('title', 'atendidos','estoque_id','setors','setor_id'));
    }
}
