<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empenho;
use App\Models\ItemEmpenho;
use Carbon\Carbon;
use App\Models\Produto;
use DB;
use App\Http\Requests\EmpenhoFormRequest;
use Illuminate\Database\QueryException;

class EmpenhoController extends Controller
{
    private $empenho;

    public function __construct(Empenho $empenho/*,  ItemEmpenho $itemempenho*/)
    {
        $this->empenho = $empenho;
//        $this->itemempenho = $itemempenho;
    }

    public function index()
    {
        $hoje = Carbon::today();
        $empenhos = Empenho::where('id','>','1')->get();
        $title = 'Empenhos';
        return view('empenho.consEmpenho', compact('title', 'empenhos'));
    }

    public function create()
    {
        $title = 'Cadastro de Empenhos';
        $empresas = Empresa::all()->sortBy('nome');

        return view('empenho.cadEmpenho',compact('title','empresas'));
    }

    public function store(EmpenhoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->empenho->create($dataForm);

        if ($insert) {
            return redirect()->route('empenho.show', $insert->id);
        } else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $empenhos = Empenho::find($id);
        $title = "Empenhos";
        $produtos = Produto::all()->sortBy('produto');
        $itemempenhos = ItemEmpenho::where('empenho_id',$id)->get();

        $total = DB::select("select sum(item.total) as total_nf from
        (select
          i.id
          ,i.produto_id
          ,i.qtd
          ,i.preco
          ,i.qtd * i.preco as total
        from
          item_empenhos i
        where i.empenho_id = $id) as item");
        return view('empenho.showEmpenho', compact('empenhos', 'title','produtos','itemempenhos','total'));
    }

    public function jsonprodutos(Request $request)
    {
    	$data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("produtos")
            		->selectRaw("id, concat_ws('', codigo, ' - ', produto, ' - ', unidade) as produto")
                    //->select("id","produto")
                    ->whereraw("(codigo LIKE '%$search%' or produto LIKE '%$search%') and (deleted_at is null)")
                  //  ->where('produto','LIKE',"%$search%")
                  //  ->orWhere('codigo','LIKE',"%$search%")
                    //->whereNull('deleted_at')
            		->get();
        }

        return response()->json($data);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function relempenho($id)
    {
        $empenhos = Empenho::find($id);
        $title = "Relatório de Acompanhamento de empenhos";

        $itempenhos = DB::select("select
        e.id
        ,e.nrempenho
        ,e.dataemissao
        ,e.valortotal
        ,e.modalidade
        ,ie.produto_id
        ,ie.preco as preco_empenho
        ,e2.numeroentrada
        ,e2.dataentrada
        ,p.codigo
        ,p.produto
        ,p.unidade
        ,ie.qtd as qtd_empenho
        ,e3.qtd as qtd_nf
        ,e3.preco as preco_nf
        ,ie.qtd - e3.qtd as saldo_empenho
      from
        empenhos as e
        left join item_empenhos as ie on e.id = ie.empenho_id
        left join produtos as p on ie.produto_id = p.id
        left join entradas e2 on e.id = e2.empenho_id
        left join produto_entradas e3 on e2.id = e3.entrada_id
      where e. id = $id
        and ie.produto_id = e3.produto_id
      group by
        e.id
        ,e.nrempenho
        ,e.dataemissao
        ,e.valortotal
        ,e.modalidade
        ,ie.produto_id
        ,ie.qtd
        ,ie.preco
        ,e2.numeroentrada
        ,e2.dataentrada
        ,p.produto
        ,e3.qtd
        ,e3.preco
        ,p.codigo
        ,p.unidade");

        $total = DB::select("select sum(item.total) as total_nf from
        (select
          i.id
          ,i.produto_id
          ,i.qtd
          ,i.preco
          ,i.qtd * i.preco as total
        from
          item_empenhos i
        where i.empenho_id = $id) as item");

        return view('empenho.relEmpenho', compact('empenhos', 'title','itempenhos','total'));

    }

}