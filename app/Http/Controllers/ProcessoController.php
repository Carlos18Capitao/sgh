<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Processo;
use App\Models\Estoque;
use App\Models\Categoria;

class ProcessoController extends Controller
{
    private $empresa;

    public function __construct(Processo $processo)
    {
        $this->processo = $processo;
    }
    public function index()
    {
        $processos = Processo::all()->sortBy("numero");
        $title = 'Cadastro de Processos';

        return view('processo.consProcesso', compact('title', 'processos'));
    }

    public function create()
    {
        $title = 'Cadastro de Processos';
        $categorias = Categoria::all();

        return view('processo.cadProcesso', compact('title','categorias'));
    }

    public function store(Request $request)
    {
        $processoForm = $request->all();
        $insert   = $this->processo->create($processoForm);

        if ($insert)
            return redirect()->route('processo.show',[$insert->id]);
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
