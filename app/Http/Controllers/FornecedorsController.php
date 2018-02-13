<?php

namespace App\Http\Controllers\Fornecedor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fornecedor\Fornecedor;
use Carbon\Carbon;
use App\Http\Requests\FornecedorFormRequest;
//use App\Http\Middleware\RedirRoute;

class FornecedorsController extends Controller
{
    private $fornecedor;

    public function __construct(Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fornecedors = $this->fornecedor->all()->sortBy("nome");
        $title = 'Cadastro de Fornecedor';

        return view('fornecedor.consFornecedor', compact('title', 'fornecedors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastro de Fornecedor';
        return view('fornecedor.cadFornecedor', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedorFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->fornecedor->create($dataForm);

        if ($insert)
            return redirect()->route('fornecedor.index');
        else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fornecedors = $this->fornecedor->find($id);
        $title = "Informações do Fornecedor"; //: $fornecedors->nome";
        $hoje = Carbon::now();

        return view('fornecedor.showFornecedor', compact('fornecedors', 'title','hoje'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fornecedors = $this->fornecedor->find($id);
        $title = "Editar fornecedor: $fornecedors->nome";

        return view('fornecedor.cadFornecedor', compact('title', 'fornecedors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $fornecedors = $this->fornecedor->find($id);
        $update = $fornecedors->update($dataForm);

        if ($update)
            return redirect()->route('fornecedor.index', $id);
        else
            return redirect()->route('fornecedor.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fornecedors = $this->fornecedor->find($id);
        $delete = $fornecedors->delete();

        if ($delete)
            return redirect()->route('fornecedor.index');
        else
            return redirect()->route('fornecedor.showFornecedor', $id)->with(['errors' => 'Falha ao editar']);
    }
}
