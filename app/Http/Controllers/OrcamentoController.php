<?php

namespace App\Http\Controllers;

use App\Log;
use App\Produto;
use App\Servico;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\OrcamentoRequest;
use App\Orcamento;
use App\Empresa;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrcamentoController extends Controller
{
    /**
     * OrcamentoController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'imprimir']);

        $this->middleware('role:orcamentos', ['except' => 'imprimir']);
        $this->middleware('permission:create-orcamento', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-orcamento', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-orcamento', ['only' => 'destroy']);
        $this->middleware('permission:email-orcamento', ['only' => ['email', 'send']]);
        $this->middleware('permission:detail-orcamento', ['only' => 'detail']);
    }

    /**
     * Show a list with all Orçamentos in a page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $title = 'Orçamentos';
        $description = 'Gerencie todos os orçamentos.';

        $orcamentos = Orcamento::latest();

        if (app('request')->input('id')) {
            $id = app('request')->input('id');

            $orcamentos = $orcamentos->where('id', $id);
        }

        if (app('request')->input('funcionario')) {
            $funcionario = app('request')->input('funcionario');

            $orcamentos = $orcamentos->leftJoin('users', 'users.id', '=', 'orcamentos.user_id')
                ->where('users.name', 'like', "%{$funcionario}%");
        }

        if (app('request')->input('cliente')) {
            $cliente = app('request')->input('cliente');
            $orcamentos = $orcamentos->where('cliente', 'like', "%{$cliente}%");
        }

        $orcamentos = $orcamentos->paginate(30);

        return view('orcamentos.index', compact('title', 'description', 'orcamentos'));
    }

    /**
     * Show a Orçamento create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Novo Orçamento';
        $description = 'Crie um novo orçamento.';

        $empresas = Empresa::lists('apelido', 'id');
        $users = User::lists('name', 'id');
        Session::forget('servicos');
        Session::forget('produtos');

        return view('orcamentos.create', compact('title', 'description', 'empresas', 'users'));
    }

    /**
     * Store Orçament in database
     *
     * @param OrcamentoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrcamentoRequest $request)
    {
        $total = $this->getTotal(Session::get('servicos')) + $this->getTotal(Session::get('produtos'));
        $data = array_add($request->all(), 'total', $total);
        $data = array_add($data, 'user_id', Auth::user()->id);
        $orcamento = Orcamento::create($data);

        $this->saveServico($orcamento, Session::get('servicos'));
        $this->saveProduto($orcamento, Session::get('produtos'));

        Session::forget('servicos');
        Session::forget('produtos');

        Log::log($orcamento->id, 'adicionado', 'orcamentos');

        return redirect('orcamentos')->with([
            'flash_message' => 'Orçamento criado com sucesso!'
        ]);
    }

    /**
     * Show a edit form in page, and load the servicos and produtos in sessions
     *
     * @param Orcamento $orcamento
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Orcamento $orcamento) {
        $title = 'Editar Orçamento';
        $description = 'Você está editando o orçamento #' . $orcamento->id;

        $empresas = Empresa::lists('apelido', 'id');
        $users = User::lists('name', 'id');

        $servicos = Servico::where('orcamento_id', '=', $orcamento->id)->orderBy('order', 'asc')->get();
        $sessionServicos = $this->getServicoProduto($orcamento, $servicos, 'service');

        $produtos = Produto::where('orcamento_id', '=', $orcamento->id)->orderBy('order', 'asc')->get();
        $sessionProdutos = $this->getServicoProduto($orcamento, $produtos, 'product');

        Session::put('servicos', $sessionServicos);
        Session::put('produtos', $sessionProdutos);

        return view('orcamentos.edit', compact('title', 'description', 'empresas', 'users', 'orcamento'));
    }

    /**
     * Update data in database
     *
     * @param Orcamento $orcamento
     * @param OrcamentoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Orcamento $orcamento, OrcamentoRequest $request)
    {
        $total = $this->getTotal(Session::get('servicos')) + $this->getTotal(Session::get('produtos'));
        $data = array_add($request->all(), 'total', $total);
        $orcamento->update($data);

        $this->saveServico($orcamento, Session::get('servicos'));
        $this->saveProduto($orcamento, Session::get('produtos'));

        Session::forget('servicos');
        Session::forget('produtos');

        Log::log($orcamento->id, 'editado', 'orcamentos');

        return redirect('orcamentos')->with([
            'flash_message' => 'Orçamento atualizada com sucesso!'
        ]);
    }

    /**
     * Delete data from database and relationships
     *
     * @param Orcamento $orcamento
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Orcamento $orcamento)
    {
        $orcamento->servicos()->delete();
        $orcamento->produtos()->delete();
        $orcamento->delete();

        Log::log($orcamento->id, 'removido', 'orcamentos');

        return redirect('orcamentos')->with([
            'flash_message' => 'Orçamento removido com sucesso!'
        ]);
    }

    /**
     * Show the total sum of both sessions Servido and Produto
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function total()
    {
        $servicos = (Session::has('servicos')) ? Session::get('servicos') : [];
        $produtos = (Session::has('produtos')) ? Session::get('produtos') : [];
        $total = $this->getTotal($servicos) + $this->getTotal($produtos);
        return view('orcamentos.total', compact('total'));
    }

    /**
     * This method return the details of the orçamento
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $orcamento = Orcamento::findOrFail($request->input('id'));

        $servicos = Servico::where('orcamento_id', '=', $orcamento->id)->orderBy('order', 'asc')->get();
        $servicos = $this->getServicoProduto($orcamento, $servicos, 'service');

        $produtos = Produto::where('orcamento_id', '=', $orcamento->id)->orderBy('order', 'asc')->get();
        $produtos = $this->getServicoProduto($orcamento, $produtos, 'product');

        $totalServicos = $this->getTotal($servicos);
        $totalProdutos = $this->getTotal($produtos);
        $total = $totalServicos + $totalProdutos;

        return view('orcamentos.detail', compact('orcamento', 'servicos', 'produtos', 'totalServicos', 'totalProdutos', 'total'));
    }

    /**
     * E-mail Orçamento Form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function email(Request $request)
    {
        $title = 'Enviar Orçamento por e-mail';
        $orcamento = Orcamento::findOrFail($request->input('id'));
        return view('orcamentos.email', compact('title', 'orcamento'));
    }

    /**
     * Send E-mail
     *
     * @param Request $request
     */
    public function send(Request $request)
    {
        $data = json_decode($request->input('values'));
        $orcamento = Orcamento::findOrFail($data->id);
        Mail::send('emails.orcamento', ['data' => $data, 'orcamento' => $orcamento], function ($mail) use ($data) {
            $mail->from('hg@hgdiesel.com.br', 'SysHG - HG Diesel');
            $mail->to($data->email, $data->nome);
            $mail->subject('Segue Orçamento');
            $mail->getSwiftMessage();
        });

        $data = get_object_vars($data);
        $data = array_add($data, 'user_id', Auth::user()->id);
        $data = array_add($data, 'orcamento_id', $orcamento->id);
        $orcamento->emails()->create($data);
    }

    /**
     * Show orçamento data in a pdf
     *
     * @param $id
     * @return mixed
     */
    public function imprimir($id)
    {
        $id = base64_decode($id);
        $orcamento = Orcamento::findOrFail($id);

        $servicos = Servico::where('orcamento_id', '=', $orcamento->id)->orderBy('order', 'asc')->get();
        $servicos = $this->getServicoProduto($orcamento, $servicos, 'service');

        $produtos = Produto::where('orcamento_id', '=', $orcamento->id)->orderBy('order', 'asc')->get();
        $produtos = $this->getServicoProduto($orcamento, $produtos, 'product');

        $totalServicos = $this->getTotal($servicos);
        $totalProdutos = $this->getTotal($produtos);
        $total = $totalServicos + $totalProdutos;

        $html = view('orcamentos.pdf', compact('orcamento', 'servicos', 'produtos', 'totalServicos', 'totalProdutos', 'total'));

        $html = preg_replace('/>\s+</', '><', $html);
        $pdf = \PDF::loadHTML(stripslashes($html));
        // return @$pdf->stream();
       return $html;
    }

    /**
     * Save the Servico using relationship with Orcamento
     *
     * @param array $servicos
     */
    private function saveServico(Orcamento $orcamento, $servicos)
    {
        $values = [];
        if (is_array($servicos) && count($servicos) > 0)
        {
            foreach ($servicos as $index => $servico)
            {
                unset($servico['total']);
                unset($servico['id']);
                unset($servico['created_at']);
                unset($servico['updated_at']);
                unset($servico['subtotal']);
                unset($servico['order']);
                $servico = array_add($servico, 'orcamento_id', $orcamento->id);
                $servico = array_add($servico, 'order', $index);
                $values[] = $servico;
            }

            $orcamento->servicos()->delete();
            $orcamento->servicos()->insert($values);
        } else {
            $orcamento->servicos()->delete();
        }
    }

    /**
     * Save the Servico using relationship with Orcamento
     *
     * @param array $servicos
     */
    private function saveProduto(Orcamento $orcamento, $produtos)
    {
        $values = [];
        if (is_array($produtos) && count($produtos) > 0)
        {
            foreach ($produtos as $index => $produto)
            {
                unset($produto['total']);
                unset($produto['id']);
                unset($produto['created_at']);
                unset($produto['updated_at']);
                unset($produto['subtotal']);
                unset($produto['order']);
                $produto = array_add($produto, 'orcamento_id', $orcamento->id);
                $produto = array_add($produto, 'order', $index);
                $values[] = $produto;
            }

            $orcamento->produtos()->delete();
            $orcamento->produtos()->insert($values);
        } else {
            $orcamento->produtos()->delete();
        }
    }

    /**
     * Return the calculate value from the sum of total of each array
     *
     * @param array $array
     * @return int
     */
    private function getTotal($array)
    {
        $total = 0;
        if (is_array($array) && count($array) > 0)
        {
            foreach ($array as $arr)
                $total += $arr['total'];
        } else {
            $total = 0;
        }

        return $total;
    }

    /**
     * Create Collection
     *
     * @param Orcamento $orcamento
     * @param $collections
     * @return array
     */
    private function getServicoProduto(Orcamento $orcamento, $collections, $type)
    {
        $sessions = [];

        foreach ($collections as $collection) {
            $discount = array_key_exists('discount', $collection['attributes']) ? $collection['attributes']['discount'] : 0;
            $subTotal = $collection['attributes']['quantidade'] * $collection['attributes']['valor'];
            $totalWithDiscount = $subTotal - ($subTotal * ($discount / 100));
            
            
            $collectionWithSubTotal = array_add($collection['attributes'], 'subtotal', $subTotal);
            $sessions[] = array_add($collectionWithSubTotal, 'total', $totalWithDiscount);
            
        }

        return $sessions;
    }
}
