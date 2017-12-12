<?php

namespace App\Http\Controllers;

use App\Models\Prestador;
use App\Models\TipoPrestador;
use App\Models\Ala;
use Illuminate\Http\Request;

class PrestadorController extends Controller
{
    private $prestador;

    public function __construct(Prestador $prestador, Ala $ala, TipoPrestador $tipoprestador)
    {
        $this->prestador = $prestador;
        $this->ala = $ala;
        $this->tipoprestador = $tipoprestador;
    }

    public function index()
    {
        $prestadors = Prestador::with('TipoPrestador')->sortable()->paginate(100);
        $title = 'Cadastro de Prestadores';

        return view('prestador.consPrestador', compact('title', 'prestadors'));
    }

    public function create()
    {
        $title = 'Cadastro de Prestadores';
        $alas = Ala::all();
        $tipoprestadors = TipoPrestador::all();

        return view('prestador.cadPrestador', compact('title','alas','tipoprestadors'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->prestador->create($dataForm);

        if ($insert)
            return redirect()->route('prestador.index');
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
      $prestadors = Prestador::find($id);
      $title = "Editar cadastro do prestador: $prestadors->nm_nome";

      return view('prestador.cadPrestador', compact('title', 'prestadors'));
    }

    public function update(Request $request, $id)
    {
      $dataForm = $request->all();
      $prestadors = Prestador::find($id);
      $update = $prestadors->update($dataForm);

      if ($update)
          return redirect()->route('prestador.index', $id);
      else
          return redirect()->route('prestador.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        //
    }
}
