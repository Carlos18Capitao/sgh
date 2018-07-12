<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Empenho;
use App\Models\Entrada;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\ProdutoEntrada;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;

class EntradaController extends Controller
{
    private $entrada;

    public function __construct(Entrada $entrada, Estoque $estoque, Produto $produto, Empresa $empresa)
    {
        $this->entrada = $entrada;
        $this->estoque = $estoque;
        $this->produto = $produto;
        $this->empresa = $empresa;
    }

    public function index($estoque_id)
    {
        $entradas = Entrada::sortable(['dataentrada' => 'desc'])->where('estoque_id', '=', $estoque_id)->paginate(2000);
        $title = 'Entrada de Produtos';

        return view('entradaestoque.consEntradaEstoque', compact('title', 'entradas', 'estoque_id'));
    }

    public function create($estoque_id)
    {
        $title = 'Entrada de Produtos';
        $estoques = Estoque::with('produto')->where('id', '=', $estoque_id)->get();
        $produtos = Produto::all()->sortBy('produto');
        $empresas = Empresa::all()->sortBy('nome');

        return view('entradaestoque.cadEntradaEstoque', compact('title', 'produtos', 'estoque_id', 'estoques', 'empresas'));
    }

    public function store(Request $request)
    {
        $entradaForm = $request->all();
        $insert = $this->entrada->create($entradaForm);

        if ($insert)
            return redirect()->route('entrada.show', [$insert->id]);
        else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $entrada = Entrada::find($id);
        $produtoentradas = ProdutoEntrada::where('entrada_id', '=', $id)->get();
        $title = 'Adicionar Produtos';
        $produtos = Produto::all();
        $estoques = Estoque::with('produto')->where('id', '=', $entrada->estoque_id)->get();
        $total = DB::select("select sum(item.total) as total_nf from
                (select
                p.id
                ,p.produto_id
                ,p.qtd
                ,p.preco
                ,p.qtd * p.preco as total
                from
                produto_entradas p
                where p.entrada_id = $id) as item");

        return view('entradaestoque.cadItemEntradaEstoque', compact('title', 'produtos', 'entrada', 'produtoentradas', 'estoques', 'total'));
    }

    public function edit($id)
    {
        $entradas = Entrada::find($id);
        $title = "Editar Nota de Entrada";
        $estoque_id = $entradas->estoque_id;
        $estoques = Estoque::with('produto')->where('id', '=', $estoque_id)->get();
        $produtos = Produto::all()->sortBy('produto');
        $empresas = Empresa::all()->sortBy('nome');

        return view('entradaestoque.cadEntradaEstoque', compact('title', 'entradas', 'estoque_id', 'estoques', 'produtos', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $entradas = Entrada::find($id);
        $update = $entradas->update($dataForm);

        if ($update)
            return redirect()->back();
        else
            return redirect()->route('estoque.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        try{
            $entradas = Entrada::find($id);
            $delete = $entradas->delete();

            return redirect()->back()->with(['success'=>'Excluído com sucesso!!!!']);

//            return redirect()->back();

        } catch (QueryException $e){
            return redirect()->back()->with(['errors'=>'Não foi possível excluir! Existem registros vinculados a essa entrada!']);
//            return redirect()->back()->withErrors('msg', 'Erro ao realizar a operação');
//            return redirect()->route('entrada.index')->with(['errors' => 'Falha ao excluir']);
        }

    }

    public function entradaempenho($estoque_id)
    {
        $empenhos = Empenho::all();
        $title = 'Entrada de Produtos com Empenho';
        $estoques = Estoque::with('produto')->where('id', '=', $estoque_id)->get();
        $produtos = Produto::all()->sortBy('produto');
        $empresas = Empresa::all()->sortBy('nome');

        return view('entradaestoque.cadEntradaEstoqueEmpenho', compact('title', 'produtos', 'estoque_id', 'estoques', 'empenhos', 'empresas'));
    }

    public function storeentradaempenho(Request $request)
    {
        $entradaForm = $request->all();
        $insert = $this->entrada->create($entradaForm);

        if ($insert)
            return redirect()->route('entrada.showentradaempenho', [$insert->id]);
        else {
            return redirect()->back();
        }
    }

    public function showentradaempenho($id, Request $request)
    {
        $entrada = Entrada::find($id);
        $produtoentradas = ProdutoEntrada::where('entrada_id', '=', $id)->get();
        $title = 'Adicionar Produtos';
        $empenhos = Empenho::with('itemempenho')->where('id','=',$entrada->empenho_id)->get();
//        $estoques = Estoque::with('produto')->where('id', '=', $entrada->estoque_id)->get();
        $total = DB::select("select sum(item.total) as total_nf from
                (select
                p.id
                ,p.produto_id
                ,p.qtd
                ,p.preco
                ,p.qtd * p.preco as total
                from
                produto_entradas p
                where p.entrada_id = $id) as item");

        return view('entradaestoque.cadItemEntradaEstoqueEmpenho', compact('title', 'produtos','entrada', 'empenhos', 'produtoentradas', 'estoques', 'total'));
    }

    public function ajaxEmpenho(Request $request)
    {
        if ($request->ajax()) {
            $empenhos = Empenho::select(
                DB::raw("nrempenho, id"))
                ->where('empresa_id', $request->empresa_id)
                ->pluck('nrempenho', 'id')
                ->all();

            //$empenhos = DB::table('empenhos')->where('empresa_id',$request->empresa_id)->pluck("nrempenho","id")->all();
            $data = view('entradaestoque.ajax-empenho', compact('empenhos'))->render();
            return response()->json(['options' => $data]);
        }
    }

}