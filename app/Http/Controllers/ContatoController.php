<?php

namespace App\Http\Controllers;

use App\Contato;
use Illuminate\Http\Request;

use App\Http\Requests;

class ContatoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:gerenciar-contatos');
    }

    public function index()
    {
        $title = 'Contatos';
        $description = 'Gerenciar contatos';

        $contatos = Contato::latest()->paginate(30);

        return view('contatos.index', compact('title', 'description', 'contatos'));
    }

    public function create()
    {
        $title = 'Nova Contato';
        $description = 'Crie uma nova contato.';

        return view('contatos.create', compact('title', 'description'));
    }

    public function store(Request $request)
    {
        if (! Contato::create($request->all())) {
            return redirect('contatos')->with([
                'flash_message' => 'Não foi possível adicionar a contato.'
            ]);
        }

        return redirect('contatos')->with([
            'flash_message' => 'Contato adicionada com sucesso.'
        ]);
    }

    public function edit(Contato $contato)
    {
        $title = 'Editar Contato';
        $description = 'Editando contato de contato existente.';

        return view('contatos.edit', compact('title', 'description', 'contato'));
    }

    public function update(Contato $contato, Request $request)
    {
        if (! $contato->update($request->all())) {
            return redirect('contatos')->with([
                'flash_message' => 'Não foi possível adicionar a contato.'
            ]);
        }

        return redirect('contatos')->with([
            'flash_message' => 'Contato adicionada com sucesso.'
        ]);
    }

    public function destroy(Contato $contato)
    {
        if (! $contato->delete()) {
            return redirect('contatos')->with([
                'flash_message' => 'Não foi possível remover a contato.'
            ]);
        }

        return redirect('contatos')->with([
            'flash_message' => 'Contato removida com sucesso.'
        ]);
    }
}
