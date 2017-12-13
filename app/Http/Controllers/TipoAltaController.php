<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAlta;
use App\Http\Requests\TipoAltaFormRequest;

class TipoAltaController extends Controller
{
    private $tipoalta;

    public function __construct(TipoAlta $tipoalta)
    {
      $this->tipoalta = $tipoalta;
    }
    public function index()
    {
      $tipoaltas =  TipoAlta::sortable()->paginate(10);
      $title = 'Cadastro de Tipo de Altas';

      return view('tipoalta.consTipoAlta', compact('title', 'tipoaltas'));
    }

    public function create()
    {
      $title = 'Cadastro de Tipo de Alta';

      return view('tipoalta.cadTipoAlta', compact('title'));
    }

    public function store(TipoAltaFormRequest $request)
    {
      $dataForm = $request->all();
      $insert = $this->tipoalta->create($dataForm);

      if ($insert)
          return redirect()->route('tipoalta.index');
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
      $tipoaltas = TipoAlta::find($id);
      $title = "Editar tipo de alta: $tipoaltas->descricao";

      return view('tipoalta.cadTipoAlta', compact('title', 'tipoaltas'));
    }

    public function update(Request $request, $id)
    {
      $dataForm = $request->all();
      $tipoaltas = TipoAlta::find($id);
      $update = $tipoaltas->update($dataForm);

      if ($update)
          return redirect()->route('tipoalta.index', $id);
      else
          return redirect()->route('tipoalta.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
      $tipoaltas = TipoAlta::find($id);
      $delete = $tipoaltas->delete();

      if ($delete)
          return redirect()->route('tipoalta.index');
      else
          return redirect()->route('tipoalta.index')->with(['errors' => 'Falha ao editar']);
    }
}
