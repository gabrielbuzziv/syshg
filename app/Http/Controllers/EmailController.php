<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

use App\Http\Requests;

class EmailController extends Controller
{
    /**
     * EmailController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:enviados');
        $this->middleware('permission:enviados-orcamento', ['only' => 'index']);
    }

    /**
     * Show a list of e-mails that already sent
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'E-mails Enviados';
        $description = 'Relatório de orçamentos enviados através do e-mail.';
        $emails = Email::latest('created_at')->paginate(15);

        return view('orcamentos.enviados', compact('title', 'description', 'emails'));
    }
}
