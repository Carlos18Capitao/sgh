<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Setor;
use Illuminate\Http\Request;

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
        $pedidos =  Pedido::sortable(['datapedido' => 'desc'])->where('estoque_id','=',$estoque_id)->paginate(20);
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

    public function store(Request $request)
    {
        $pedidoForm = $request->all();
        $insert   = $this->pedido->create($pedidoForm);

        if ($insert)
            return redirect()->route('estoque.pedido',[$insert->estoque_id]);
        else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        //
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
