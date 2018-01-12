<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdemBancaria;


class OrdemBancariaController extends Controller
{
  private $ordembancaria;

  public function __construct(OrdemBancaria $ordembancaria)
  {
      $this->ordembancaria = $ordembancaria;
  }
  public function index()
  {
      $ordembancarias =  OrdemBancaria::all();
      $title = 'Cadastro de Ordem Bancaria';

      return view('ordembancaria.consOrdemBancaria', compact('title', 'ordembancarias'));
  }

  public function create()
  {
      $title = 'Cadastro de Ordem Bancaria';

      return view('ordembancaria.cadProcesso', compact('title'));
  }

  public function store(Request $request)
  {
      $dataForm = $request->all();
      $insert = $this->ordembancaria->create($dataForm);

      if ($insert) {
          // return redirect()->route('ordembancaria.index');
          return redirect()->back()->with(['success'=>'Processo cadastrado com sucesso!!!']);
      } else {
          return redirect()->back()->with(['success'=>'Processo cadastrado com sucesso!!!']);
      }
  }

  public function show($id)
  {
      $ordembancarias = OrdemBancaria::find($id);

      return view('ordembancaria.showOrdemBancaria', compact('ordembancarias'));
  }

  public function edit($id)
  {
      $ordembancarias = OrdemBancaria::find($id);
      $title = "Editar: $ordembancarias->descricao";

      return view('ordembancaria.cadOrdemBancaria', compact('title', 'ordembancarias'));
  }

  public function update(Request $request, $id)
  {
      $dataForm = $request->all();
      $ordembancarias = OrdemBancaria::find($id);
      $update = $ordembancarias->update($dataForm);

      if ($update) {
        return redirect()->back()->with(['success'=>'Cadastrado com sucesso!!!']);
          // return redirect()->route('ordembancaria.index', $id);
      } else {
          return redirect()->route('ordembancaria.edit', $id)->with(['errors' => 'Falha ao editar']);
      }
  }

  public function destroy($id)
  {
      $ordembancarias = OrdemBancaria::find($id);
      $delete = $ordembancarias->delete();

      if ($delete) {
          return redirect()->route('ordembancaria.index');
      } else {
          return redirect()->route('ordembancaria.index')->with(['errors' => 'Falha ao editar']);
      }
  }
}
