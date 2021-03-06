<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\ProdutoEstoque;
use App\User;
use DB;
use Carbon\Carbon;
use Auth;
use App\Models\Setor;

class EstoqueController extends Controller
{
    private $estoque;

    public function __construct(Estoque $estoque, User $user, Produto $produto)
    {
      $this->estoque = $estoque;
      $this->user    = $user;
      $this->produto    = $produto;
    }
    public function index()
    {
      $estoques =  Estoque::sortable()->paginate(10);
      $title = 'Estoques';

      return view('estoque.consEstoque', compact('title', 'estoques'));
    }

    public function select()
    {
      $hoje = Carbon::now('America/Sao_Paulo');
      $user = Auth::user()->id;
      $users = User::where('id', $user)->update(['last_access' => $hoje]); 

      $estoques =  Estoque::sortable()->get();
      $title = 'Estoques';  

      return view('estoque.selectEstoque', compact('title', 'estoques'));
    }

    public function menu($id)
    {
        $estoque = Estoque::find($id);
        $title = $estoque->descricao;

        return view('estoque.menuEstoque', compact('title','estoque'));
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

    public function userstore($estoque_id, Request $request)
    {
      $estoque = Estoque::find($estoque_id);
      $user_id = $request['user_id'];

      $estoque->user()->attach($user_id);

      return redirect()->back()->with(['success'=>'Usuário vinculado com sucesso!!!']);
    }

    public function produtostore($estoque_id, Request $request)
    {
      $estoque = Estoque::find($estoque_id);
      $produto_id = $request['produto_id'];

      $estoque->produto()->attach($produto_id);

      return redirect()->back()->with(['success'=>'Produto vinculado com sucesso!!!']);
    }

    public function show($id)
    {
        $estoque  = Estoque::find($id);
        $title    = 'Estoque';
        $users    = User::all()->sortBy('name');
        $produtos  = Produto::all()->sortBy('produto');
        $produtoestoque = ProdutoEstoque::all();

        return view('estoque.showEstoque', compact('title','estoque','users','produtos','produtoestoque'));
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

    public function relposicaoestoque($id)
    {
        $produtos =  Produto::sortable()->paginate(1000);
        $title = 'Posição de Estoque';

        return view('estoque.relPosicaoEstoque', compact('title', 'produtos'));
    }

    public function reldemandaestoque($id)
    {
        $demandas = DB::select("
            select
              produtos.codigo,
              concat(produtos.produto, ' - ', produtos.unidade) as produto,
              (select sum(demandas.qtd) from  demandas where demandas.produto_id = produtos.id group by demandas.produto_id) as anual,
              (select ceiling(sum(demandas.qtd/12)) from  demandas where demandas.produto_id = produtos.id group by demandas.produto_id) as mensal,
              (select ceiling(sum(demandas.qtd/52)) from  demandas where demandas.produto_id = produtos.id group by demandas.produto_id) as semanal,
              (select sum(produto_entradas.qtd) as entradas from produto_entradas where produto_entradas.produto_id = produtos.id and produto_entradas.deleted_at is null group by produto_entradas.produto_id) as entrada,
              (select sum(produto_saidas.qtd) as saidas from  produto_saidas where produto_saidas.produto_id = produtos.id and produto_saidas.deleted_at is null group by produto_saidas.produto_id) as saida,
              (select sum(produto_entradas.qtd) as entradas from produto_entradas where produto_entradas.produto_id = produtos.id and produto_entradas.deleted_at is null group by produto_entradas.produto_id) -
                  (select sum(produto_saidas.qtd) as saidas from  produto_saidas where produto_saidas.produto_id = produtos.id and produto_saidas.deleted_at is null group by produto_saidas.produto_id) as saldo,
              round(((select sum(produto_entradas.qtd) as entradas from produto_entradas where produto_entradas.produto_id = produtos.id and produto_entradas.deleted_at is null group by produto_entradas.produto_id) -
                  (select sum(produto_saidas.qtd) as saidas from  produto_saidas where produto_saidas.produto_id = produtos.id and produto_saidas.deleted_at is null group by produto_saidas.produto_id))/
                  (select sum(demandas.qtd/52) from  demandas where demandas.produto_id = produtos.id group by demandas.produto_id),1) as prev_semanas,
              round(((select sum(produto_entradas.qtd) as entradas from produto_entradas where produto_entradas.produto_id = produtos.id and produto_entradas.deleted_at is null group by produto_entradas.produto_id) -
                  (select sum(produto_saidas.qtd) as saidas from  produto_saidas where produto_saidas.produto_id = produtos.id and produto_saidas.deleted_at is null group by produto_saidas.produto_id))/
                  (select sum(demandas.qtd/12) from  demandas where demandas.produto_id = produtos.id group by demandas.produto_id),1) as prev_meses
            from
              produto_estoques
              left join produtos on produto_estoques.produto_id = produtos.id
            where
              produto_estoques.estoque_id = $id
              and produtos.deleted_at is null
            order by produtos.produto
              ");
        $title = 'Demanda x Posição de Estoque';
        $estoque_id = $id;
        return view('estoque.relDemandaEstoque', compact('title', 'demandas','estoque_id'));
    }

    public function relLoteValidade($id, Request $request)
    {
        $dataInicio = $request->dataInicio;
        $dataFim = $request->dataFim;

       // if(isset($dataInicio)){

        $lotes = DB::select("
        select
        p.codigo
        ,p.produto
        ,p.unidade
        ,l.lote
        ,l.validade
        ,l.qtd
      from
        lotes as l
        left join produtos p on l.produto_id = p.id
        left join produto_estoques e on p.id = e.produto_id
      where
        l.qtd <> 0
        and e.estoque_id = $id
        and l.validade between '$dataInicio' and '$dataFim'
      order by p.produto;");
        $title = 'Relatório de Produtos com Lote e Validade';
        $estoque_id = $id;
        return view('estoque.relLoteValidade', compact('title', 'lotes','estoque_id'));

       // }
    }

    public function reldemandasetor($id, Request $request)
    {
      $setor_id = $request->setor_id;
      $codigo = $request->codigo;

      if(isset($setor_id)){
        $demandas = DB::select("
        select
        produtos.codigo,
        concat(produtos.produto, ' - ', produtos.unidade) as produto,
        (select sum(demandas.qtd) from  demandas where demandas.produto_id = produtos.id and demandas.setor_id = $setor_id group by demandas.produto_id) as anual,
        (select ceiling(sum(demandas.qtd/12)) from  demandas where demandas.produto_id = produtos.id and demandas.setor_id = $setor_id group by demandas.produto_id) as mensal,
        (select ceiling(sum(demandas.qtd/52)) from  demandas where demandas.produto_id = produtos.id and demandas.setor_id = $setor_id group by demandas.produto_id) as semanal,
        (select sum(produto_entradas.qtd) as entradas from produto_entradas where produto_entradas.produto_id = produtos.id and produto_entradas.deleted_at is null group by produto_entradas.produto_id) -
        (select sum(produto_saidas.qtd) as saidas from  produto_saidas where produto_saidas.produto_id = produtos.id and produto_saidas.deleted_at is null group by produto_saidas.produto_id) as saldo
    from
        produto_estoques
        left join produtos on produto_estoques.produto_id = produtos.id
    where
        produto_estoques.estoque_id = $id
        and produtos.codigo in ($codigo)
        order by produtos.produto
              ");
        $title = 'Demanda por Unidade';
        $setors = Setor::all()->sortBy('setor');
        $estoque_id = $id;
        return view('estoque.relDemandaSetor', compact('title', 'demandas','estoque_id','setors'));
      }
      $title = 'Demanda por Unidade';
      $estoque_id = $id;
      $setors = Setor::all()->sortBy('setor');

      return view('estoque.relDemandaSetor1', compact('title','demandas','estoque_id','setors'));

    }

}
