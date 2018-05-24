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
        $empenhos = Empenho::all()->sortByDesc('dataemissao');
        $title = 'Empenhos';
        return view('empenho.consEmpenho', compact('title', 'empenhos'));
    }

    public function create()
    {
        $title = 'Cadastro de Empenhos';
        $empresas = Empresa::all()->sortBy('nome');

        return view('empenho.cadEmpenho',compact('title','empresas'));
    }

    public function store(Request $request)
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

    public function edit($id)
    {
        $atas = $this->ata->find($id);
        $title = "Editar ARP: $atas->arp";
        $objetos = $this->objeto->all()->sortBy("objeto");
        $fornecedors = $this->fornecedor->all()->sortBy("nome");

        return view('ata.cadAta', compact('title', 'atas','objetos','fornecedors'));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $atas = $this->ata->find($id);
        $update = $atas->update($dataForm);

        if ($update)
            return redirect()->route('itemata.editar', $id);
//            return redirect()->route('ata.index', $id);
        else
            return redirect()->route('ata.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function destroy($id)
    {
        $atas = $this->ata->find($id);
//        $itematas = $atas->itemata->all();
//        actions()->detach();
//        dd($atas);
//        $delete2 = $itematas->delete();
        $delete = $atas->delete();


        if ($delete)
            return redirect()->route('ata.index');
        else
            return redirect()->route('ata.show', $id)->with(['errors' => 'Falha ao editar']);
    }

    public function ataObjeto($id)
    {
        $hoje = Carbon::today();
        $atas = $this->ata->all()->sortByDesc('vigencia')->where('objeto_id','=',$id)->where('vigencia','>=',$hoje);
        $title = 'Lista de Atas Vigentes';
        $objetos = $this->objeto->all()->sortBy('objeto');
        return view('ata.consAta', compact('title', 'atas','hoje','objetos'));
    }

    public function atasVencidas()
    {
        $hoje = Carbon::today();
        $atas = $this->ata->all()->sortByDesc('vigencia')->where('vigencia','<=',$hoje);
        $title = 'Lista de Atas Vencidas';
        $objetos = $this->objeto->all()->sortBy('objeto');
        return view('ata.consAta', compact('title', 'atas','hoje','objetos'));
    }

    public function ataObjetoVenc($id)
    {
        $hoje = Carbon::today();
        $atas = $this->ata->all()->sortBy('vigencia')->where('objeto_id','=',$id)->where('vigencia','<=',$hoje);
        $title = 'Lista de Atas Vencidas';
        $objetos = $this->objeto->all()->sortBy('objeto');
        return view('ata.consAta', compact('title', 'atas','hoje','objetos'));
    }

    public function emailAta($id)
    {
        $atas = $this->ata->find($id);
        $title = "ATA AMGESP";
        $hoje = Carbon::today();
        $fimAta = $atas->vigencia->diffInDays($hoje);

        return view('ata.emailAta', compact('atas', 'title','fimAta'));
    }

    public function memo($id)
    {
        $atas = $this->ata->find($id);
        $title = "MODELO PARA COPIAR E COLAR EM MEMO PARA ENVIO DO EMPENHO";

        return view('fornecedor.memoFornecedor', compact('atas', 'title'));
    }
}