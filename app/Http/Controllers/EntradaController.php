<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Entrada;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\ProdutoEntrada;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    private $entrada;

    public function __construct(Entrada $entrada, Estoque $estoque, Produto $produto, Empresa $empresa)
    {
        $this->entrada  = $entrada;
        $this->estoque = $estoque;
        $this->produto = $produto;
        $this->empresa = $empresa;
    }

    public function index($estoque_id)
    {
        $entradas =  Entrada::sortable(['dataentrada' => 'desc'])->where('estoque_id','=',$estoque_id)->paginate(20);
        $title   = 'Entrada de Produtos';

        return view('entradaestoque.consEntradaEstoque', compact('title', 'entradas','estoque_id'));
    }

    public function create($estoque_id)
    {
        $title    = 'Entrada de Produtos';
        $estoques = Estoque::with('produto')->where('id','=',$estoque_id)->get();
        $produtos = Produto::all()->sortBy('produto');
        $empresas = Empresa::all()->sortBy('nome');

        return view('entradaestoque.cadEntradaEstoque', compact('title','produtos','estoque_id','estoques','empresas'));
    }

    public function store(Request $request)
    {
        $entradaForm = $request->all();
        $insert   = $this->entrada->create($entradaForm);

        if ($insert)
            return redirect()->route('entrada.show',[$insert->id]);
        else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $entrada = Entrada::find($id);
        $produtoentradas = ProdutoEntrada::where('entrada_id','=',$id)->get();
        $title = 'Adicionar Produtos';
        $produtos = Produto::all();
        $estoques = Estoque::with('produto')->where('id','=',$entrada->estoque_id)->get();

        return view('entradaestoque.cadItemEntradaEstoque', compact('title','produtos','entrada','produtoentradas','estoques'));
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