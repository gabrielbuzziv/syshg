<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Item;
use App\Log;
use App\OrdemCompra;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\OrdemCompraRequest;
use Illuminate\Support\Facades\Session;

class OrdemCompraController extends Controller
{
    /**
     * OrdemCompraController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ordem-compra');
        $this->middleware('permission:create-ordem-compra', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-ordem-compra', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-ordem-compra', ['only' => 'destroy']);
        $this->middleware('permission:lancar-ordem-compra', ['only' => ['lancar', 'relatorio', 'relatorioImprimir']]);
        $this->middleware('permission:detail-ordem-compra', ['only' => 'detail']);
        $this->middleware('permission:print-ordem-compra', ['only' => 'imprimir']);
    }

    /**
     * Show a list of all Ordens de Serviço
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Ordens de Compra';
        $description = 'Gerencie as o ordens de compra';
        $ordensCompra = OrdemCompra::latest('created_at')->paginate(30);

        return view('ordensCompra.index', compact('title', 'description', 'ordensCompra'));
    }


    public function create()
    {
        $title = 'Nova Ordem de Compra';
        $description = 'Crie uma nova ordem de compra.';

        $empresas = Empresa::lists('apelido', 'id');
        $users = User::lists('name', 'id');

        Session::forget('itens');

        return view('ordensCompra.create', compact('title', 'description', 'empresas', 'users'));
    }

    /**
     * Armazena no banco de dados a Ordem de Serviço
     *
     * @param OrdemCompraRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrdemCompraRequest $request)
    {
        $data = array_add($request->all(), 'user_id', \Auth::user()->id);
        $ordemCompra = OrdemCompra::create($data);

        $this->saveItem($ordemCompra, Session::get('itens'));

        Log::log($ordemCompra->id, 'adicionado', 'ordemCompra');

        return redirect('ordens-compra')->with([
            'flash_message' => 'Ordem de Compra Criada com Sucesso'
        ]);
    }

    /**
     * Página de edição de OrdemCompra
     *
     * @param OrdemCompra $ordemCompra
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(OrdemCompra $ordemCompra) {
        $title = 'Editar Ordem de Compra';
        $description = 'Você está editando a Ordem de Compra #' . $ordemCompra->id;

        $empresas = Empresa::lists('apelido', 'id');
        $users = User::lists('name', 'id');

        $itens = Item::where('ordem_compra_id', '=', $ordemCompra->id)->orderBy('order', 'asc')->get();
        $sessionItens = $this->getItens($ordemCompra, $itens);

        Session::put('itens', $sessionItens);

        return view('ordensCompra.edit', compact('title', 'description', 'empresas', 'users', 'ordemCompra', 'itens'));
    }

    /**
     * Update data in database
     *
     * @param OrdemCompra $ordemCompra
     * @param OrdemCompraRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrdemCompra $ordemCompra, OrdemCompraRequest $request)
    {
        $ordemCompra->update($request->all());

        $this->saveItem($ordemCompra, Session::get('itens'));

        Session::forget('itens');

        Log::log($ordemCompra->id, 'editado', 'ordemCompra');

        return redirect('ordens-compra')->with([
            'flash_message' => 'Ordem de compra atualizada com sucesso!'
        ]);
    }

    /**
     * Delete data from database and relationships
     *
     * @param OrdemCompra $ordemCompra
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(OrdemCompra $ordemCompra)
    {
        $ordemCompra->item()->delete();
        $ordemCompra->delete();

        Log::log($ordemCompra->id, 'removido', 'ordemCompra');

        return redirect('ordens-compra')->with([
            'flash_message' => 'Ordem de Compra removida com sucesso!'
        ]);
    }

    /**
     * Retorna os detalhes da OrdemCompra
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $ordemCompra = OrdemCompra::findOrFail($request->input('id'));

        $itens = Item::where('ordem_compra_id', '=', $ordemCompra->id)->orderBy('order', 'asc')->get();
        $itens = $this->getItens($ordemCompra, $itens);

        $total = $this->getTotal($itens);

        return view('ordensCompra.detail', compact('ordemCompra', 'itens', 'total'));
    }

    /**
     * Lista Ordens de Serviço em PDF
     *
     * @param $id
     * @return mixed
     */
    public function imprimir($id)
    {
        $id = base64_decode($id);
        $ordemCompra = OrdemCompra::findOrFail($id);

        $itens = Item::where('ordem_compra_id', '=', $ordemCompra->id)->orderBy('order', 'asc')->get();
        $itens = $this->getItens($ordemCompra, $itens);

        $total = $this->getTotal($itens);

        Log::log($ordemCompra->id, 'impresso', 'ordemCompra');

        $html = view('ordensCompra.pdf', compact('ordemCompra', 'itens', 'total'));
        $html = preg_replace('/>\s+</', '><', $html);
        $pdf = \PDF::loadHTML(stripslashes($html));
        // return @$pdf->stream();
        return $html;
    }

    /**
     * Troca status da ordem de compra
     *
     * @param OrdemCompra $ordemCompra
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lancar(OrdemCompra $ordemCompra)
    {
        $ordemCompra->status = true;
        $ordemCompra->save();

        return redirect('ordens-compra')->with([
            'flash_message' => 'Ordem de compra lançado com sucesso!'
        ]);
    }

    /**
     * Listagem com filtro
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relatorio(Request $request)
    {
        $title = 'Relatório de ordens de compra';
        $description = 'Tire relatórios de Ordens de Compra';

        $ordensCompra = OrdemCompra::latest('created_at')->paginate(15);
        if ($request->all()) {
            $ordensCompra = OrdemCompra::where('status', $request->input('status'))
                ->latest('created_at')->paginate(15);

            if ($request->input('empresa')) {
                $ordensCompra = OrdemCompra::where('empresa_id', $request->input('empresa'))
                    ->where('status', $request->input('status'))
                    ->latest('created_at')->paginate(15);
            }
        }

        $empresas = Empresa::lists('apelido', 'id')->all();
        $empresas = ['' => 'Selecione a empresa'] + $empresas;
        $status = [
            '' => 'Selecione o Status',
            '1' => 'Lançado',
            '0' => 'Não Lançado'
        ];

        return view('ordensCompra.relatorio', compact('title', 'description', 'ordensCompra', 'empresas', 'status'));
    }

    public function relatorioImprimir(Request $request)
    {
        $ordensCompra = OrdemCompra::latest('created_at')->paginate(15);
        if ($request->all()) {
            $ordensCompra = OrdemCompra::where('status', $request->input('status'))
                ->latest('created_at')->get();

            if ($request->input('empresa')) {
                $ordensCompra = OrdemCompra::where('empresa_id', $request->input('empresa'))
                    ->where('status', $request->input('status'))
                    ->latest('created_at')->paginate(15);
            }
        }

        $html = view('ordensCompra.relatorioPdf', compact('ordensCompra'));
//        $pdf = \PDF::loadHTML($html);
//        return $pdf->stream();
//        $file = 'relatorios/' . md5(uniqid(rand(), true)) . '.pdf';
//        return \PDF::loadHTML($html)->save($file)->stream('relatporio.pdf');
        return $html;
    }

    /**
     * Salva itens na relação
     *
     * @param OrdemCompra $ordemCompra
     * @param array $itens
     */
    private function saveItem(OrdemCompra $ordemCompra, array $itens)
    {
        $values = [];
        foreach ($itens as $index => $item) {
            unset($item['total']);
            unset($item['id']);
            unset($item['created_at']);
            unset($item['updated_at']);
            unset($item['order']);
            $item = array_add($item, 'ordem_compra_id', $ordemCompra->id);
            $item = array_add($item, 'order', $index);
            $values[] = $item;
        }

        $ordemCompra->item()->delete();
        $ordemCompra->item()->insert($values);
    }

    /**
     * Cria colleção
     *
     * @param OrdemCompra $ordemCompra
     * @param $collections
     * @return array
     */
    private function getItens(OrdemCompra $ordemCompra, $collections)
    {
        $sessions = [];
        foreach ($collections as $collection) {
            $sessions[] = array_add($collection['attributes'], 'total', ($collection['attributes']['quantidade'] * $collection['attributes']['valor']));
        }
        return $sessions;
    }

    /**
     * Return the calculate value from the sum of total of each array
     *
     * @param array $array
     * @return int
     */
    private function getTotal(array $array)
    {
        $total = 0;
        foreach ($array as $arr)
            $total += $arr['total'];

        return $total;
    }
}
