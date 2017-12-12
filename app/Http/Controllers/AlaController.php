<?php

namespace App\Http\Controllers;

use App\Models\Ala;
use Illuminate\Http\Request;
use App\Http\Requests\AlaFormRequest;

class AlaController extends Controller
{
    private $ala;

    public function __construct(Ala $ala)
    {
        $this->ala = $ala;
    }

    public function index()
    {
        $alas =  Ala::sortable()->paginate(10);
        $title = 'Cadastro de Alas';

        return view('ala.consAla', compact('title', 'alas'));
    }

    public function create()
    {
        $title = 'Cadastro de Alas';

        return view('ala.cadAla', compact('title'));
    }

    public function store(AlaFormRequest $request)
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
        $alas = Ala::find($id);
        $title = "Editar tipo de prestador: $alas->descricao";

        return view('ala.cadAla', compact('title', 'alas'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $alas = Ala::find($id);
        $update = $alas->update($dataForm);

        if ($update)
            return redirect()->route('ala.index', $id);
        else
            return redirect()->route('ala.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $alas = Ala::find($id);

//         $ala->delete();
//        $alas = $this->ala->find($id);
        $delete = $alas->delete();

        if ($delete)
            return redirect()->route('ala.index');
        else
            return redirect()->route('ala.index')->with(['errors' => 'Falha ao editar']);
    }
}
