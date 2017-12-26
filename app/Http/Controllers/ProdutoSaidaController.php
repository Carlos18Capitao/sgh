<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Setor;
use Illuminate\Http\Request;
use App\Models\ProdutoSaida;
use App\Models\Estoque;
use App\Http\Requests\ProdutoSaidaFormRequest;

class ProdutoSaidaController extends Controller
{
    private $produtosaida;

    public function __construct(ProdutoSaida $produtosaida, Produto $produto, Setor $setor, Estoque $estoque)
    {
        $this->produtosaida = $produtosaida;
        $this->produto      = $produto;
        $this->setor        = $setor;
        $this->estoque      = $estoque;
    }

    public function index($estoque_id)
    {
        $produtosaidas  =  ProdutoSaida::sortable()->where('estoque_id','=',$estoque_id)->paginate(20);
        $title          = 'Saida de Produtos por Setor';

        return view('produtosaida.consProdutoSaida', compact('title', 'produtosaidas','estoque_id'));
    }

    public function create($estoque_id)
    {
        $title    = 'Saida de Produtos por Setor';
        $produtos = Produto::all()->sortBy('produto');
        $setors   = Setor::all()->sortBy('setor');

        return view('produtosaida.cadProdutoSaida', compact('title','produtos','setors','estoque_id'));
    }

    public function store(ProdutoSaidaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert   = $this->produtosaida->create($dataForm);

        if ($insert)
            return redirect()->route('estoque.saida',[$insert->estoque_id]);
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
        $title          = "Editar produtosaida: $produtosaidas->descricao";

        return view('produtosaida.cadProdutoSaida', compact('title', 'produtosaidas'));
    }

    public function update(Request $request, $id)
    {
        $dataForm      = $request->all();
        $produtosaidas = ProdutoSaida::find($id);
        $update        = $produtosaidas->update($dataForm);

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
