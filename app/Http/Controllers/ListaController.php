<?php

namespace App\Http\Controllers;

use App\Lista;
use Illuminate\Http\Request;

use App\Http\Requests;

class ListaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:gerenciar-listas');
    }

    public function index()
    {
        $title = 'Lista de Contatos';
        $description = 'Gerencia as listas de contato para enviar e-mails.';

        $listas = Lista::latest()->paginate(30);

        return view('listas.index', compact('title', 'description', 'listas'));
    }

    public function create()
    {
        $title = 'Nova Lista';
        $description = 'Crie uma nova lista.';

        return view('listas.create', compact('title', 'description'));
    }

    public function store(Request $request)
    {
        if (! Lista::create($request->all())) {
            return redirect('listas-de-contatos')->with([
                'flash_message' => 'Não foi possível adicionar a lista.'
            ]);
        }

        return redirect('listas-de-contatos')->with([
            'flash_message' => 'Lista adicionada com sucesso.'
        ]);
    }

    public function edit(Lista $lista)
    {
        $title = 'Editar Lista';
        $description = 'Editando lista de contato existente.';

        return view('listas.edit', compact('title', 'description', 'lista'));
    }

    public function update(Lista $lista, Request $request)
    {
        if (! $lista->update($request->all())) {
            return redirect('listas-de-contatos')->with([
                'flash_message' => 'Não foi possível adicionar a lista.'
            ]);
        }

        return redirect('listas-de-contatos')->with([
            'flash_message' => 'Lista adicionada com sucesso.'
        ]);
    }

    public function destroy(Lista $lista)
    {
        if (! $lista->delete()) {
            return redirect('listas-de-contatos')->with([
                'flash_message' => 'Não foi possível remover a lista.'
            ]);
        }

        return redirect('listas-de-contatos')->with([
            'flash_message' => 'Lista removida com sucesso.'
        ]);
    }
}
