<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    private $estadocivil;

    public function __construct(EstadoCivil $estadocivil)
    {
        $this->estadocivil = $estadocivil;
    }

    public function index()
    {
        $estadocivils =  EstadoCivil::paginate(10);
        $title = 'Cadastro de Estado Civil';

        return view('estadocivil.consEstadoCivil', compact('title', 'estadocivils'));
    }

    public function create()
    {
        $title = 'Cadastro de Estado Civil';

        return view('estadocivil.cadEstadoCivil', compact('title'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->estadocivil->create($dataForm);

        if ($insert)
            return redirect()->route('estadocivil.index');
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
        $estadocivils = EstadoCivil::find($id);
        $title = "Editar estado civil: $estadocivils->descricao";

        return view('estadocivil.cadEstadoCivil', compact('title', 'estadocivils'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $estadocivils = EstadoCivil::find($id);
        $update = $estadocivils->update($dataForm);

        if ($update)
            return redirect()->route('estadocivil.index', $id);
        else
            return redirect()->route('estadocivil.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $estadocivils = EstadoCivil::find($id);

//         $estadocivil->delete();
//        $estadocivils = $this->estadocivil->find($id);
        $delete = $estadocivils->delete();

        if ($delete)
            return redirect()->route('estadocivil.index');
        else
            return redirect()->route('estadocivil.index')->with(['errors' => 'Falha ao editar']);
    }
}
