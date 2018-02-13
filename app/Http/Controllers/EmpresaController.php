<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EmpresaController extends Controller
{
    private $empresa;

    public function __construct(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }

    public function index()
    {
        $empresas = Empresa::all()->sortBy("nome");
        $title = 'Cadastro de Empresa';

        return view('empresa.consEmpresa', compact('title', 'empresas'));
    }

    public function create()
    {
        $title = 'Cadastro de Empresa';
        return view('empresa.cadEmpresa', compact('title'));
    }

    public function store(EmpresaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->empresa->create($dataForm);

        if ($insert)
            return redirect()->route('empresa.index');
        else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $empresas = Empresa::find($id);
        $title = "Informações do Fornecedor"; //: $empresas->nome";
        $hoje = Carbon::now();

        return view('empresa.showEmpresa', compact('empresas', 'title','hoje'));
    }

    public function edit($id)
    {
        $empresas = Empresa::find($id);
        $title = "Editar empresa: $empresas->nome";

        return view('empresa.cadEmpresa', compact('title', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $empresas = Empresa::find($id);
        $update = $empresas->update($dataForm);

        if ($update)
            return redirect()->route('empresa.index', $id);
        else
            return redirect()->route('empresa.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $empresas = $this->empresa->find($id);
        $delete = $empresas->delete();

        if ($delete)
            return redirect()->route('empresa.index');
        else
            return redirect()->route('empresa.showEmpresa', $id)->with(['errors' => 'Falha ao editar']);
    }
}
