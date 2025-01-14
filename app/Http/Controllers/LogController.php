<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

use App\Http\Requests;

class LogController extends Controller
{
    /**
     * LogController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:log');
        $this->middleware('permission:log-orcamento', ['only' => 'orcamento']);
        $this->middleware('permission:log-ordem-compra', ['only' => 'ordemCompra']);
    }

    /**
     * Página com log dos orçamentos.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orcamento()
    {
        $title = 'Logs dos Orçamentos';
        $description = 'Log de todas as ações feitas nos orçamentos.';
        $logs = Log::latest('created_at')->orcamentos()->paginate(30);
        $controller = 'OrcamentoController@edit';

        // return $logs;
        return view('logs.log', compact('title', 'description', 'logs', 'controller'));
    }

    /**
     * Página com log das ordensCompra de serviço
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ordemCompra()
    {
        $title = 'Logs dos Orçamentos';
        $description = 'Log de todas as ações feitas nos orçamentos.';
        $logs = Log::latest('created_at')->ordemCompra()->paginate(30);
        $controller = 'OrdemCompraController@edit';
        return view('logs.log', compact('title', 'description', 'logs', 'controller'));
    }
}
