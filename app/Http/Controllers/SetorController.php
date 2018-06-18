<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;
use App\Http\Requests\SetorFormRequest;
use App\User;
use Auth;

class SetorController extends Controller
{
    private $setor;

    public function __construct(Setor $setor)
    {
        $this->setor = $setor;
    }

    public function index()
    {
        $setors =  Setor::orderBy('setor')->get();
        $title = 'Cadastro de Setor';

        return view('setor.consSetor', compact('title', 'setors'));
    }

    public function create()
    {
        $title = 'Cadastro de Setor';

        return view('setor.cadSetor', compact('title'));
    }

    public function store(SetorFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->setor->create($dataForm);

        if ($insert)
            return redirect()->route('setor.index');
        else {
            return redirect()->back();
        }
    }

    public function usersetor($setor_id, Request $request)
    {
        $setors = Setor::find($setor_id);
        $user_id = $request['user_id'];

        $setors->user()->attach($user_id);

        return redirect()->back()->with(['success'=>'Usuário vinculado com sucesso!!!']);
    }

    public function show($id)
    {
        $setors  = Setor::find($id);
        $title    = 'Unidades UNCISAL';
        $users    = User::all()->sortBy('name');

        return view('setor.showSetor', compact('title','users', 'setors'));
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
