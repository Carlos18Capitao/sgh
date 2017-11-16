<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;

class SetorController extends Controller
{
    private $setor;

    public function __construct(Setor $setor)
    {
        $this->setor = $setor;
    }

    public function index()
    {
        $setors =  Setor::sortable()->paginate(10);
        $title = 'Cadastro de Setor';

        return view('setor.consSetor', compact('title', 'setors'));
    }

    public function create()
    {
        $title = 'Cadastro de Setor';

        return view('setor.cadSetor', compact('title'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->setor->create($dataForm);

        if ($insert)
            return redirect()->route('setor.index');
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
        $setors = Setor::find($id);
        $title = "Editar setor: $setors->descricao";

        return view('setor.cadSetor', compact('title', 'setors'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $setors = Setor::find($id);
        $update = $setors->update($dataForm);

        if ($update)
            return redirect()->route('setor.index', $id);
        else
            return redirect()->route('setor.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $setors = Setor::find($id);

//         $setor->delete();
//        $setors = $this->setor->find($id);
        $delete = $setors->delete();

        if ($delete)
            return redirect()->route('setor.index');
        else
            return redirect()->route('setor.index')->with(['errors' => 'Falha ao editar']);
    }
}
