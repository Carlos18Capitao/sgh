<?php

namespace App\Http\Controllers;

use App\Models\Alas;
use Illuminate\Http\Request;

class AlaController extends Controller
{
    private $ala;

    public function __construct(Alas $ala)
    {
        $this->ala = $ala;
    }

    public function index()
    {
        $alas =  Alas::sortable()->paginate(10);
        $title = 'Cadastro de Alas';

        return view('ala.consAla', compact('title', 'alas'));
    }

    public function create()
    {
        $title = 'Cadastro de Alas';

        return view('ala.cadAla', compact('title'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->ala->create($dataForm);

        if ($insert)
            return redirect()->route('ala.index');
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
        $alas = Alas::find($id);
        $title = "Editar tipo de prestador: $alas->descricao";

        return view('ala.cadAla', compact('title', 'alas'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $alas = Alas::find($id);
        $update = $alas->update($dataForm);

        if ($update)
            return redirect()->route('ala.index', $id);
        else
            return redirect()->route('ala.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $alas = Alas::find($id);

//         $ala->delete();
//        $alas = $this->ala->find($id);
        $delete = $alas->delete();

        if ($delete)
            return redirect()->route('ala.index');
        else
            return redirect()->route('ala.index')->with(['errors' => 'Falha ao editar']);
    }
}