<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAlta;

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
