<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoPrestadors;

class TipoPrestadorController extends Controller
{

    private $tipoprestador;

    public function __construct(TipoPrestadors $tipoprestador)
    {
        $this->tipoprestador = $tipoprestador;
    }

    public function index()
    {
        $tipoprestadors =  TipoPrestadors::sortable()->paginate(10);
        $title = 'Cadastro de Tipos de Prestadores';

        return view('tipoprestador.consTipoPrestador', compact('title', 'tipoprestadors'));
    }

    public function create()
    {
        $title = 'Cadastro de Tipos de Prestadores';

        return view('tipoprestador.cadTipoPrestador', compact('title'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->tipoprestador->create($dataForm);

        if ($insert)
            return redirect()->route('tipoprestador.index');
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
        $tipoprestadors = TipoPrestadors::find($id);
        $title = "Editar tipo de prestador: $tipoprestadors->descricao";

        return view('tipoprestador.cadTipoPrestador', compact('title', 'tipoprestadors'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $tipoprestadors = TipoPrestadors::find($id);
        $update = $tipoprestadors->update($dataForm);

        if ($update)
            return redirect()->route('tipoprestador.index', $id);
        else
            return redirect()->route('tipoprestador.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $tipoprestadors = TipoPrestadors::find($id);

//         $tipoprestador->delete();
//        $tipoprestadors = $this->tipoprestador->find($id);
        $delete = $tipoprestadors->delete();

        if ($delete)
            return redirect()->route('tipoprestador.index');
        else
            return redirect()->route('tipoprestador.index')->with(['errors' => 'Falha ao editar']);
    }
}