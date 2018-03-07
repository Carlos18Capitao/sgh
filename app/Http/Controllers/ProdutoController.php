<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Estoque;
use App\Http\Requests\ProdutoFormRequest;
use DB;

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

//        $estoques = DB::select("SELECT
//              estoques.id as estoque_id
//              ,categorias.descricao
//              ,categorias.id as categoria_id
//              ,produtos.codigo
//              ,produtos.produto
//              ,produtos.id as produto_id
//              ,produtos.unidade
//              ,sum(produto_entradas.qtd) as entradas
//              ,sum(produto_saidas.qtd) as saidas
//            FROM estoques
//              LEFT JOIN produto_estoques pe ON estoques.id = pe.estoque_id
//              LEFT JOIN produtos ON pe.produto_id = produtos.id
//              LEFT JOIN produto_entradas ON produtos.id = produto_entradas.produto_id
//              LEFT JOIN categorias ON produtos.categoria_id = categorias.id
//              LEFT JOIN produto_saidas ON produtos.id = produto_saidas.produto_id
//            WHERE
//              estoques.id = $estoque_id
//            GROUP BY
//              produtos.id
//              ,estoques.id
//              ,categorias.descricao
//              ,categorias.id
//              ,produtos.codigo
//              ,produtos.produto
//              ,produtos.unidade
//            ORDER BY produtos.produto
//              ");

        // $produtos = Produto::with('estoque','produto_id')->sortable()->get();
        $estoques   = Estoque::with('produto')
                                    ->where('id','=',$estoque_id)
                                    ->sortable(['produto' => 'asc'])->get();
        //dd($estoques);
        $title      = 'Posição de Estoque';
//        $categorias = Categoria::all();
        // $estoque_id = Estoque::where('id','=',$estoque_id)->value('id');

        return view('produto.relPosicaoEstoque', compact('title', 'estoques','estoque_id','produtos'));
    }

    public function catrelposicaoestoque($estoque_id,$categoria_id)
    {

       $estoques = DB::select("SELECT
              estoques.id as estoque_id
              ,categorias.descricao
              ,categorias.id as categoria_id
              ,produtos.codigo
              ,produtos.produto
              ,produtos.id as produto_id
              ,produtos.unidade
              ,sum(produto_entradas.qtd) as entradas
              ,sum(produto_saidas.qtd) as saidas

            FROM estoques
              LEFT JOIN produto_estoques pe ON estoques.id = pe.estoque_id
              LEFT JOIN produtos ON pe.produto_id = produtos.id
              LEFT JOIN produto_entradas ON produtos.id = produto_entradas.produto_id
              LEFT JOIN categorias ON produtos.categoria_id = categorias.id
              LEFT JOIN produto_saidas ON produtos.id = produto_saidas.produto_id
            WHERE
              estoques.id = $estoque_id
              and categorias.id = $categoria_id
            GROUP BY
              produtos.id
              ,estoques.id
              ,categorias.descricao
              ,categorias.id
              ,produtos.codigo
              ,produtos.produto
              ,produtos.unidade
            ORDER BY produtos.produto
              ");

//        $estoques = DB::table('estoques')
//            ->join('produto_estoques', 'estoques.id', '=', 'produto_estoques.estoque_id')
//            ->join('produtos', 'produto_estoques.produto_id', '=', 'produtos.id')
//            ->join('produto_entradas','produtos.id','=','produto_entradas.produto_id')
//            ->select('estoques.*', 'produto_estoques.*','produtos.*','produto_entradas.qtd')
//            ->where('estoques.id','=',$estoque_id)
//            ->get();
//        dd($estoques);
        $title      = 'Posição de Estoque';
        $categorias = Categoria::all();
        // $estoque_id = Estoque::where('id','=',$estoque_id)->value('id');

        return view('produto.relPosicaoEstoque', compact('title', 'produtos','estoques','estoque_id','categorias'));
    }

    public function pdfproduto($id)
    {
        $produtos = Produto::find($id);

        return \PDF::loadView('produto.pdfProduto', compact('produtos'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->setPaper('a4', 'landscape')
//            ->download('etiquetaproduto.pdf');
            ->stream();
    }

}
