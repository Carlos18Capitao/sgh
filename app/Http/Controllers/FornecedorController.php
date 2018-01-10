<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    private $fornecedor;

    public function __construct(Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }
    public function index()
    {
        $fornecedors =  Fornecedor::all();
        $title = 'Cadastro de Fornecedores';

        return view('fornecedor.consFornecedor', compact('title', 'fornecedors'));
    }

    public function create()
    {
        $title = 'Cadastro de Fornecedores';

        return view('fornecedor.cadFornecedor', compact('title'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->fornecedor->create($dataForm);

        if ($insert) {
            return redirect()->route('fornecedor.index');
        } else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $fornecedors = Fornecedor::find($id);
        $title = "Editar: $fornecedors->descricao";

        return view('fornecedor.cadFornecedor', compact('title', 'fornecedors'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $fornecedors = Fornecedor::find($id);
        $update = $fornecedors->update($dataForm);

        if ($update) {
            return redirect()->route('fornecedor.index', $id);
        } else {
            return redirect()->route('fornecedor.edit', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function destroy($id)
    {
        $fornecedors = Fornecedor::find($id);
        $delete = $fornecedors->delete();

        if ($delete) {
            return redirect()->route('fornecedor.index');
        } else {
            return redirect()->route('fornecedor.index')->with(['errors' => 'Falha ao editar']);
        }
    }
}
