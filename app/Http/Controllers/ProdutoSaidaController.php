<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Setor;
use Illuminate\Http\Request;
use App\Models\ProdutoSaida;

class ProdutoSaidaController extends Controller
{
    private $produtosaida;

    public function __construct(ProdutoSaida $produtosaida, Produto $produto, Setor $setor)
    {
        $this->produtosaida = $produtosaida;
        $this->produto = $produto;
        $this->setor = $setor;
    }

    public function index()
    {
        $produtosaidas =  ProdutoSaida::sortable()->paginate(10);
//        dd($produtosaidas);
        $title = 'Saida de Produtos por Setor';

        return view('produtosaida.consProdutoSaida', compact('title', 'produtosaidas'));
    }

    public function create()
    {
        $title = 'Saida de Produtos por Setor';
        $produtos = Produto::all();
        $setors = Setor::all();

        return view('produtosaida.cadProdutoSaida', compact('title','produtos','setors'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->produtosaida->create($dataForm);

        if ($insert)
            return redirect()->route('saida.index');
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
        $produtosaidas = ProdutoSaida::find($id);
        $title = "Editar produtosaida: $produtosaidas->descricao";

        return view('produtosaida.cadProdutoSaida', compact('title', 'produtosaidas'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $produtosaidas = ProdutoSaida::find($id);
        $update = $produtosaidas->update($dataForm);

        if ($update)
            return redirect()->route('saida.index', $id);
        else
            return redirect()->route('saida.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $produtosaidas = ProdutoSaida::find($id);

//         $produtosaida->delete();
//        $produtosaidas = $this->produtosaida->find($id);
        $delete = $produtosaidas->delete();

        if ($delete)
            return redirect()->route('saida.index');
        else
            return redirect()->route('saida.index')->with(['errors' => 'Falha ao editar']);
    }
}
