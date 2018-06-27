<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Setor;

class RequisitionController extends Controller
{
    public function index($estoque_id)
    {
        $requisitions =  Requisition::where('estoque_id','=',$estoque_id)->get();

        $title   = 'Requisição de Produtos';

        return view('requisition.consRequisitionEstoque', compact('title', 'requisitions','estoque_id'));
    }

    public function create($estoque_id)
    {
        $title    = 'Requisição de Produtos';
        $estoques = Estoque::with('produto')->where('id','=',$estoque_id)->get();
        $produtos = Produto::all()->sortBy('produto');
        $setors   = Setor::all()->sortBy('setor');

        return view('requisition.cadRequisitionEstoque', compact('title','produtos','setors','estoque_id','estoques'));
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
