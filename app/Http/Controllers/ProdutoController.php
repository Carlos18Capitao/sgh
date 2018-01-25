<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Estoque;
use App\Http\Requests\ProdutoFormRequest;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct(Produto $produto, Categoria $categoria, Estoque $estoque)
    {
        $this->produto = $produto;
        $this->categoria = $categoria;
        $this->estoque = $estoque;
    }

    public function index()
    {
        $produtos =  Produto::sortable()->paginate(50);
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

    public function store(ProdutoFormRequest $request)
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

        return view('produto.showProduto', compact('title','produtos'));
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

    public function relposicaoestoque($estoque_id)
    {
        // $produtos = Produto::with('estoque','produto_id')->sortable()->get();
        $estoques = Estoque::with('produto')->where('id','=',$estoque_id)->sortable()->get();
        // dd($estoques);
        $title    = 'Posição de Estoque';
        // $estoque_id = Estoque::where('id','=',$estoque_id)->value('id');
        // dd($estoques);

        return view('produto.relPosicaoEstoque', compact('title', 'produtos','estoques'));
    }
}
