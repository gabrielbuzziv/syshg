<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    /**
     * Lista todos os Itens.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $itens = Session::get('itens');
        $total = $this->getTotal($itens);
        return view('itens.show', compact('itens', 'total'));
    }

    /**
     * Página adicionar novo Item.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Novo Item';
        return view('itens.create', compact('title'));
    }

    /**
     * Armazena na sessão os itens cadastrados.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $data = json_decode($request->input('values'));
        $itens = $this->saveItem($data);

        $total = $this->getTotal($itens);

        return view('itens.show', compact('itens', 'total'));
    }

    /**
     * Formulário de edição do item
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = 'Editar Itens';

        $index = $request->input('index');
        $item = Session::get('itens')[$index];
        return view('itens.edit', compact('title', 'item', 'index'));
    }

    /**
     * Atualiza itens na Session
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $data = json_decode($request->input('values'));
        $itens = $this->saveItem($data, $data->index);

        $total = $this->getTotal($itens);

        return view('itens.show', compact('itens', 'total'));
    }

    /**
     * Remove item da array list pela index
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Request $request)
    {
        $itens = Session::get('itens');

        unset($itens[$request->input('index')]);
        $itens = array_values($itens);
        Session::put('itens', $itens);

        $total = $this->getTotal($itens);

        return view('itens.show', compact('itens', 'total'));
    }

    /**
     * Ordena indexes baseado no nestable
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order(Request $request)
    {
        $indexes = $request->input('indexes');

        $itens = Session::get('itens');

        $order = [];
        foreach($indexes as $index){
            $order[] = $itens[$index];
        }
        Session::put('itens', $order);
        $itens = $order;

        $total = $this->getTotal($itens);

        return view('itens.show', compact('itens', 'total'));
    }

    /**
     * Metodo salva itens em uma array
     *
     * @param $data
     * @param null $index
     * @return array
     */
    private function saveItem($data, $index = null)
    {
        $itens = Session::get('itens');
        $item = [
            'quantidade' => $data->quantidade,
            'item' => $data->item,
            'valor' => $this->convertPrice($data->valor),
            'total' => $data->quantidade * $this->convertPrice($data->valor)
        ];

        if ($index != null) {
            $itens[$index] = $item;
        } else {
            $itens[] = $item;
        }

        Session::put('itens', $itens);

        return $itens;
    }

    /**
     * Convert the price value masked in a true float
     *
     * @param $price
     * @return mixed
     */
    private function convertPrice($price)
    {
        return str_replace(['.', ','], ['', '.'], $price);
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
