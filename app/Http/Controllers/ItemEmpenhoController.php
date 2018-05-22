<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ItemEmpenho;

class ItemEmpenhoController extends Controller
{
    private $itemempenho;

    public function __construct(ItemEmpenho $itemempenho)
    {
        $this->itemempenho  = $itemempenho;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->itemempenho->create($dataForm);
  
        if ($insert) {
            // return redirect()->route('ordembancaria.index');
            return redirect()->back()->with(['success'=>'Item cadastrado com sucesso!!!']);
        } else {
            return redirect()->back()->with(['success'=>'Item cadastrado com sucesso!!!']);
        }
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
