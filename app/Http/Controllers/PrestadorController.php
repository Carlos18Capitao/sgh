<?php

namespace App\Http\Controllers;

use App\Models\Prestadors;
use Illuminate\Http\Request;

class PrestadorController extends Controller
{
    private $prestador;

    public function __construct(Prestadors $prestador)
    {
        $this->prestador = $prestador;
    }

    public function index()
    {
        $prestadors =  Prestadors::all()->sortBy("nome");
        $title = 'Cadastro de Prestadores';

        return view('prestador.consPrestador', compact('title', 'prestadors'));
    }

    public function create()
    {
        $title = 'Cadastro de Prestadores';

        return view('prestador.cadPrestador', compact('title'));
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
