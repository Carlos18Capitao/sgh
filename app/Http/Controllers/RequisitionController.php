<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function index($estoque_id)
    {
        $requisitions =  Requisition::where('estoque_id','=',$estoque_id)->get();

        $title   = 'Requisição de Produtos';

        return view('requisition.consRequisitionEstoque', compact('title', 'requisitions','estoque_id'));
    }

    public function create()
    {
        //
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
