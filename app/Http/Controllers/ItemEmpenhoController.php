<?php

namespace App\Http\Controllers\Ata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ata\Ata;
use App\Models\Fornecedor\Fornecedor;
use App\Models\Objeto\Objeto;
use App\Models\Item\Item;
use App\Models\Ata\ItemAta;
use Carbon\Carbon;
use DB;
 
class ItemAtasController extends Controller
{
    private $itemata;

    public function __construct(ItemAta $itemata, Fornecedor $fornecedor, Objeto $objeto, Ata $ata, Item $item)
    {
        $this->itemata = $itemata;
        $this->fornecedor = $fornecedor;
        $this->objeto = $objeto;
        $this->ata = $ata;
        $this->item = $item;
    }
    public function index()
    {
        //
    }

    public function create($id)
    {
//        $atas = $this->ata->find($id);
//        $title = "ATA AMGESP";
//        $hoje = Carbon::now();
//        $fimAta = $atas->vigencia->diffInDays($hoje);
//        $items = $this->item->all()->sortByDesc("descricao")->where('objeto_id', '=', $atas->objeto->id);;
//
//        return view('ata.cadItemAta', compact('atas', 'title','fimAta','items'));
    }

//    public function store(Request $request)
//    {
//        $dataForm = $request->all();
//        for ($i = 0; $i < count($dataForm['ata_id']); $i++) {
//            if (isset($dataForm['qtdreg']) && !is_null($dataForm['qtdreg'][$i])) {
//                $arrayForm = array(
//                    'ata_id' => $dataForm['ata_id'][$i],
//                    'item_id' => $dataForm['item_id'][$i],
//                    'itemarp' => $dataForm['itemarp'][$i],
//                    'precoreg' => $dataForm['precoreg'][$i],
//                    'qtdreg' => $dataForm['qtdreg'][$i],
//                    'descdoe' => $dataForm['descdoe'][$i],
//                    'marca' => $dataForm['marca'][$i]
//                );
//            }
//            if (count($arrayForm) > 0) {
//                $this->itemata->create($arrayForm);
//            }
//        }
//
//        $atas = $this->ata->all()->sortBy("arp");
//        $title = 'Lista de Atas';
//        $hoje = Carbon::now();
//        $objetos = $this->objeto->all();
//        return view('ata.consAta', compact('title', 'atas','hoje','objetos'));
//    }
    public function store(Request $request)
    {
        $dataForm = $request->all();
        $insert = $this->itemata->create($dataForm);

        if ($insert)
//            return redirect()->route('itemata.editar', $itematas->ata_id);
            return redirect()->back();
        else {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $atas = $this->ata->find($id);
        $title = "ATA AMGESP";
        $hoje = Carbon::now();
        $fimAta = $atas->vigencia->diffInDays($hoje);
        $items = $this->item->all()
            ->sortByDesc("descricao")
            ->where('objeto_id', '=', $atas->objeto->id)
            ->where('active','=','1');
        $itematas = $this->itemata->all();

        return view('ata.cadItemAta', compact('atas', 'title','fimAta','items','shorttitle'));
    }

    public function edit($id)
    {
        //
    }
    public function editar($id)
    {
        $atas = $this->ata->find($id);

//        $atas = $this->ata->where('id','=',$ata_id)->get();
        $itematas = $this->itemata->where('ata_id','=',$id)->get();

        $title = "ATA AMGESP";
        //    $hoje = Carbon::now();
        //    $fimAta = $atas->vigencia->diffInDays($hoje);
//        $items = $this->item->all()
//            ->sortByDesc('descricao')
//            ->where('objeto_id', '=', $atas->objeto->id)
//            ->where('active','=','1');

        $items = $this->item->all()
            ->sortByDesc('descricao')
            ->where('objeto_id', '=', $atas->objeto->id)
            ->where('active','=','1');

        return view('ata.editItemAta', compact('itematas','atas', 'title','items'));

    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $itematas = $this->itemata->find($id);
        $update = $itematas->update($dataForm);

        if ($update)
            return redirect()->route('itemata.editar', $itematas->ata_id);
        else
            return redirect()->route('itemata.editar', $itematas->ata_id)->with(['errors' => 'Falha ao editar']);

//        return 'Cadastro efetuado com sucesso';
        /*    if ($update)
                return redirect()->route('unidade.index', $id);
            else
                return redirect()->route('unidade.edit', $id)->with(['errors' => 'Falha ao editar']);*/
    }

    public function destroy($id)
    {
        $itematas = $this->itemata->find($id);
        $delete = $itematas->delete();

        if ($delete)
            return redirect()->route('itemata.editar', $itematas->ata_id);
        else
            return redirect()->route('itemata.showItemAta', $id)->with(['errors' => 'Falha ao editar']);
    }
    public function atasvalidas()
    {
//item_atas.qtdreg - sum(item_processos.qtd) saldo,

        $title = "Itens com Atas Vigentes";
        $hoje = Carbon::today();
        $consultas = DB::table('atas')
            ->leftJoin ('item_atas', 'atas.id', '=', 'item_atas.ata_id')
            ->leftJoin ('item_processos', 'item_atas.id', '=', 'item_processos.item_ata_id')
            ->leftJoin ('processos', 'item_processos.processo_id', '=', 'processos.id')
            ->leftJoin ('objetos', 'atas.objeto_id', '=', 'objetos.id')
            ->leftJoin ('items', 'item_atas.item_id', '=', 'items.id')
            ->where('atas.vigencia','>=',$hoje)
       //     ->orwhere('item_processos.devolvido','=','0')
            ->selectRaw('objetos.objeto,
                      atas.id ata_id,
                      atas.arp,
                      atas.pls,
                      atas.vigencia,
                      atas.obs,
                      item_atas.itemarp,
                      item_atas.precoreg,
                      item_atas.qtdreg,
                      item_atas.descdoe,
                      item_atas.marca,
                      item_atas.unidade unidadedoe,
                      items.descricao,
                      items.codigo,
                      items.unidade,
                      items.dose,
                      items.formafarmaceutica,
                      item_atas.qtdreg - sum(item_processos.qtd)  saldo,                      
                      items.id')
            ->groupby('objetos.objeto',
                'atas.arp',
                'atas.pls',
                'atas.vigencia',
                'atas.obs',
                'item_atas.itemarp',
                'item_atas.precoreg',
                'item_atas.qtdreg',
                'item_atas.descdoe',
                'item_atas.marca',
                'item_atas.unidade',
                'items.descricao',
                'items.unidade',
                'items.dose',
                'items.formafarmaceutica',
                'items.codigo',
                'items.id')
            ->orderby('atas.vigencia','desc')
            ->get();
        $objetos = $this->objeto->all()->sortBy('objeto');
//        $itematas = $this->itemata->all();
        return view('ata.atasvalidas', compact('consultas','hoje','title','objetos'));
    }

    public function itemataObjeto($id)
    {
        $title = "Itens com Atas Vigentes";
        $hoje = Carbon::now();
        $consultas = DB::table('atas')
            ->leftJoin ('item_atas', 'atas.id', '=', 'item_atas.ata_id')
            ->leftJoin ('item_processos', 'item_atas.id', '=', 'item_processos.item_ata_id')
            ->leftJoin ('processos', 'item_processos.processo_id', '=', 'processos.id')
            ->leftJoin ('objetos', 'atas.objeto_id', '=', 'objetos.id')
            ->leftJoin ('items', 'item_atas.item_id', '=', 'items.id')
            ->where('atas.vigencia','>=',$hoje)
    //        ->orwhere('item_processos.devolvido','=','0')                                    
            ->where('objetos.id','=',$id)
            ->selectRaw('objetos.objeto,
                      atas.id ata_id,
                      atas.arp,
                      atas.pls,
                      atas.vigencia,
                      atas.obs,
                      item_atas.itemarp,
                      item_atas.precoreg,
                      item_atas.qtdreg,
                      item_atas.descdoe,
                      item_atas.marca,
                      item_atas.unidade unidadedoe,
                      items.descricao,
                      items.codigo,
                      items.unidade,
                      items.dose,
                      items.formafarmaceutica,
                      item_atas.qtdreg - sum(item_processos.qtd) saldo,
                      items.id')
            ->groupby('objetos.objeto',
                'atas.arp',
                'atas.pls',
                'atas.vigencia',
                'atas.obs',
                'item_atas.itemarp',
                'item_atas.precoreg',
                'item_atas.qtdreg',
                'item_atas.descdoe',
                'item_atas.marca',
                'item_atas.unidade',
                'items.descricao',
                'items.unidade',
                'items.dose',
                'items.formafarmaceutica',
                'items.codigo',
                'items.id')
            ->orderby('atas.vigencia','desc')
            ->get();
        $objetos = $this->objeto->all()->sortBy('objeto');

        return view('ata.atasvalidas', compact('consultas','hoje','title','objetos'));
    }
}