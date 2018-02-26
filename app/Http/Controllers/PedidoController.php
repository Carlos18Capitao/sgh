<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\ProdutoSaida;
use App\Models\Setor;
use Illuminate\Http\Request;
use App\Http\Requests\PedidoFormRequest;

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
        $title   = 'Pedidos de Produtos';

        return view('pedidoestoque.consPedidoEstoque', compact('title', 'pedidos','estoque_id'));
    }

    public function create($estoque_id)
    {
        $title    = 'Pedido de Produtos';
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
        $produtosaidas = ProdutoSaida::where('pedido_id','=',$id)->get();
        $title = 'Adicionar Produtos ao Pedido';
        $produtos = Produto::all();
        $estoques = Estoque::with('produto')->where('id','=',$pedido->estoque_id)->get();


        return view('pedidoestoque.cadItemPedidoEstoque', compact('title','produtos','pedido','produtosaidas','estoques'));

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
