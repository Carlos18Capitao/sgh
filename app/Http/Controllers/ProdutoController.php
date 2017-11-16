<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct(Produto $produto, Categoria $categoria)
    {
        $this->produto = $produto;
        $this->categoria = $categoria;
    }

    public function index()
    {
        $produtos =  Produto::sortable()->paginate(10);
//        dd($produtos);
        $title = 'Cadastro de Produto';

        return view('produto.consProduto', compact('title', 'produtos'));
    }

    public function create()
    {
        $title = 'Cadastro de Produto';
        $categorias =  Categoria::all();

        return view('produto.cadProduto', compact('title','categorias'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->produto->create($dataForm);

        if ($insert)
            return redirect()->route('produto.index');
        else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $produtos = Produto::find($id);
        $title = "Detalhes do Produto";

        return view('produto.ShowProduto', compact('title','produtos'));

    }

    public function edit($id)
    {
        $produtos = Produto::find($id);
        $title = "Editar produto: $produtos->descricao";

        return view('produto.cadProduto', compact('title', 'produtos'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $produtos = Produto::find($id);
        $update = $produtos->update($dataForm);

        if ($update)
            return redirect()->route('produto.index', $id);
        else
            return redirect()->route('produto.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $produtos = Produto::find($id);

//         $produto->delete();
//        $produtos = $this->produto->find($id);
        $delete = $produtos->delete();

        if ($delete)
            return redirect()->route('produto.index');
        else
            return redirect()->route('produto.index')->with(['errors' => 'Falha ao editar']);
    }
}
