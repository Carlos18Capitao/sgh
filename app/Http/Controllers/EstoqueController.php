<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\User;

class EstoqueController extends Controller
{
    private $estoque;

    public function __construct(Estoque $estoque, User $user)
    {
      $this->estoque = $estoque;
      $this->user    = $user;
    }
    public function index()
    {
      $estoques =  Estoque::sortable()->paginate(10);
      $title = 'Estoques';

      return view('estoque.consEstoque', compact('title', 'estoques'));
    }

    public function select()
    {
      $estoques =  Estoque::sortable()->get();
      $title = 'Estoques';

      return view('estoque.selectEstoque', compact('title', 'estoques'));
    }

    public function create()
    {
      $title = 'Estoque';

      return view('estoque.cadEstoque', compact('title'));
    }

    public function store(Request $request)
    {
      $dataForm = $request->all();
      $insert = $this->estoque->create($dataForm);

      if ($insert)
          return redirect()->route('estoque.index');
      else {
          return redirect()->back();
      }
    }

    public function userstore($estoque_id, Request $request)
    {
      $estoque = Estoque::find($estoque_id);
      $user_id = $request['user_id'];

      $estoque->user()->attach($user_id);

      // return view('estoque.showEstoque', compact('title','estoque','users'));
      return redirect()->back()->with(['success'=>'Usuário vinculado com sucesso!!!']);
    }

    public function show($id)
    {
        $estoque = Estoque::find($id);
        $title = 'Estoque';
        $users = User::all();

        return view('estoque.showEstoque', compact('title','estoque','users'));
    }

    public function edit($id)
    {
      $estoques = Estoque::find($id);
      $title = "Editar estoque: $estoques->descricao";

      return view('estoque.cadEstoque', compact('title', 'estoques'));
    }

    public function update(Request $request, $id)
    {
      $dataForm = $request->all();
      $estoques = Estoque::find($id);
      $update = $estoques->update($dataForm);

      if ($update)
          return redirect()->route('estoque.index', $id);
      else
          return redirect()->route('estoque.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
      $estoques = Estoque::find($id);
      $delete = $estoques->delete();

      if ($delete)
          return redirect()->route('estoque.index');
      else
          return redirect()->route('estoque.index')->with(['errors' => 'Falha ao editar']);
    }
}
