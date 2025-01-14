<?php

namespace App\Http\Controllers;

use App\Email;
use App\Orcamento;
use App\OrdemCompra;
use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return page Dashboard
     * Route: "/"
     */
    public function dashboard()
    {
        $title = 'Dashboard';
        $description = 'Bem vindo ao Dashboard do SysHG';

        $orcamentos = Orcamento::latest()->count();
        $emails = Email::latest()->count();
        $ordensCompra = OrdemCompra::latest()->count();
        $ordensLancadas = OrdemCompra::where('status', '=', '1')->count();

        return view('pages.dashboard', compact('title', 'description', 'orcamentos', 'emails', 'ordensCompra', 'ordensLancadas'));
    }
}
