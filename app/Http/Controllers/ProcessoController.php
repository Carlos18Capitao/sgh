<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Processo;
use App\Models\Empresa;
use App\Models\Categoria;
use App\Models\Setor;
use App\Http\Requests\ProcessoFormRequest;

class ProcessoController extends Controller
{
    private $empresa;

    public function __construct(Processo $processo, Categoria $categoria)
    {
        $this->processo = $processo;
        $this->categoria = $categoria;
    }
    public function index()
    {
        $processos = Processo::all()->sortByDesc('numero');
        $title = 'Cadastro de Processos';

        return view('processo.consProcesso', compact('title', 'processos'));
    }

    public function create()
    {
        $title = 'Cadastro de Processos';
        $categorias = Categoria::all();

        return view('processo.cadProcesso', compact('title','categorias'));
    }

    public function store(ProcessoFormRequest $request)
    {
        $processoForm = $request->all();
        $insert   = $this->processo->create($processoForm);

        if ($insert)
//            return redirect()->route('processo.show',[$insert->id]);
            return redirect()->route('processo.index');
        else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $processos = Processo::find($id);
        $empresas = Empresa::all()->sortBy('nome');
        $title = "Informações do Processo"; //: $empresas->nome";
        $setors = Setor::all()->sortBy('setor');
//        $hoje = Carbon::now();

        return view('processo.showProcesso', compact('processos', 'title','empresas','setors'));
    }

    public function edit($id)
    {
        $processos = Processo::find($id);
        $title = "Editar Processo";
        $empresas = Empresa::all()->sortBy('nome');

        return view('processo.cadProcesso', compact('title', 'processos','empresas'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $processos = Processo::find($id);
        $update = $processos->update($dataForm);

        if ($update)
            return redirect()->route('processo.show',[$id]);
//            return view('processo.showProcesso', compact('processos', 'title'));
        else
            return redirect()->route('processo.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

     public function destroy($id)
    {
        $processos = Processo::find($id);
        $delete = $processos->delete();

        if ($delete)
            return redirect()->route('processo.index')->with(['errors' => 'Falha ao editar']);
        else
            return redirect()->route('processo.index')->with(['errors' => 'Falha ao editar']);
    }
}
