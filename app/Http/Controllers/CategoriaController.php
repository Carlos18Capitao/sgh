<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    public function index()
    {
        $categorias =  Categoria::sortable()->paginate(10);
        $title = 'Cadastro de Categoria';

        return view('categoria.consCategoria', compact('title', 'categorias'));
    }

    public function create()
    {
        $title = 'Cadastro de Categoria';

        return view('categoria.cadCategoria', compact('title'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->categoria->create($dataForm);

        if ($insert)
            return redirect()->route('categoria.index');
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
        $categorias = Categoria::find($id);
        $title = "Editar categoria: $categorias->descricao";

        return view('categoria.cadCategoria', compact('title', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $categorias = Categoria::find($id);
        $update = $categorias->update($dataForm);

        if ($update)
            return redirect()->route('categoria.index', $id);
        else
            return redirect()->route('categoria.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $categorias = Categoria::find($id);

//         $categoria->delete();
//        $categorias = $this->categoria->find($id);
        $delete = $categorias->delete();

        if ($delete)
            return redirect()->route('categoria.index');
        else
            return redirect()->route('categoria.index')->with(['errors' => 'Falha ao editar']);
    }
}
