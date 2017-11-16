<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\ProdutoEntrada;

class ProdutoEntradaController extends Controller
{
    private $produtoentrada;

    public function __construct(ProdutoEntrada $produtoentrada, Produto $produto)
    {
        $this->produtoentrada = $produtoentrada;
    }

    public function index()
    {
        $produtoentradas =  ProdutoEntrada::sortable()->paginate(10);
//        dd($produtoentradas);
        $title = 'Entrada de Produtos no Estoque';

        return view('produtoentrada.consProdutoEntrada', compact('title', 'produtoentradas'));
    }

    public function create()
    {
        $title = 'Entrada de Produtos no Estoque';
        $produtos = Produto::all();

        return view('produtoentrada.cadProdutoEntrada', compact('title','produtos'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->produtoentrada->create($dataForm);

        if ($insert)
            return redirect()->route('entrada.index');
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
        $produtoentradas = ProdutoEntrada::find($id);
        $title = "Editar produtoentrada: $produtoentradas->descricao";

        return view('produtoentrada.cadProdutoEntrada', compact('title', 'produtoentradas'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $produtoentradas = ProdutoEntrada::find($id);
        $update = $produtoentradas->update($dataForm);

        if ($update)
            return redirect()->route('entrada.index', $id);
        else
            return redirect()->route('entrada.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $produtoentradas = ProdutoEntrada::find($id);

//         $produtoentrada->delete();
//        $produtoentradas = $this->produtoentrada->find($id);
        $delete = $produtoentradas->delete();

        if ($delete)
            return redirect()->route('entrada.index');
        else
            return redirect()->route('entrada.index')->with(['errors' => 'Falha ao editar']);
    }
}
