<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    private $entrada;

    public function __construct(Entrada $entrada, Estoque $estoque, Produto $produto)
    {
        $this->entrada  = $entrada;
        $this->estoque = $estoque;
        $this->produto = $produto;
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

        return view('entradaestoque.cadEntradaEstoque', compact('title','produtos','estoque_id','estoques'));
    }

    public function store(Request $request)
    {
        //
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