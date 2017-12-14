<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;

class EstoqueController extends Controller
{
    private $estoque;

    public function __construct(Estoque $estoque)
    {
      $this->estoque = $estoque;
    }
    public function index()
    {
      $estoques =  Estoque::sortable()->paginate(10);
      $title = 'Estoques';

      return view('estoque.consEstoque', compact('title', 'estoques'));
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

    public function show($id)
    {
        //
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
