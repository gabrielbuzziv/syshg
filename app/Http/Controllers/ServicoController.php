<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ServicoController extends Controller
{
    /**
     * Show all Produtos in session produtos.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $servicos = Session::get('servicos');

        $total = $this->getTotal($servicos);
        return view('servicos.show', compact('servicos', 'total'));
    }
    /**
     * Generate the create serviço view form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Novo Serviço';
        return view('servicos.create', compact('title'));
    }

    /**
     * Stores Servicos into a Session
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $data = json_decode($request->input('values'));
        $servicos = $this->saveServico($data);

        $total = $this->getTotal($servicos);

        return view('servicos.show', compact('servicos', 'total'));
    }

    /**
     * Genenerate the edit form with array index value
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = 'Editar Serviço';
        $index = $request->input('index');
        $servico = Session::get('servicos')[$index];

        return view('servicos.edit', compact('title', 'servico', 'index'));
    }

    /**
     * Update Serviço in the Session
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $data = json_decode($request->input('values'));
        $servicos = $this->saveServico($data, $data->index);

        $total = $this->getTotal($servicos);

        return view('servicos.show', compact('servicos', 'total'));
    }

    /**
     * Remove serviço from array and update indexes
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Request $request)
    {
        $servicos = Session::get('servicos');

        unset($servicos[$request->input('index')]);
        $servicos = array_values($servicos);
        Session::put('servicos', $servicos);

        $total = $this->getTotal($servicos);

        return view('servicos.show', compact('servicos', 'total'));
    }

    /**
     * Reindex Serviços
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order(Request $request)
    {
        $indexes = $request->input('indexes');
        $servicos = Session::get('servicos');

        $order = [];
        foreach($indexes as $index){
            $order[] = $servicos[$index];
        }

        Session::put('servicos', $order);
        $servicos = $order;

        $total = $this->getTotal($servicos);

        return view('servicos.show', compact('servicos', 'total'));
    }

    /**
     * This method save the servico into array session
     * 
     * @param $data
     * @param null $index
     * @return array
     */
    private function saveServico($data, $index = null)
    {
        $discount = $data->discount;
        $subTotal = $data->quantidade * $this->convertPrice($data->valor);
        $totalWithDiscount = $subTotal - ($subTotal * ($this->convertPrice($discount) / 100));

        $servicos = Session::get('servicos');
        $servico = [
            'servico' => $data->servico,
            'quantidade' => $data->quantidade,
            'valor' => $this->convertPrice($data->valor),
            'lancamento' => $data->lancamento,
            'subtotal' => $subTotal,
            'discount' => $this->convertPrice($data->discount),
            'total' => $totalWithDiscount
        ];

        if ($index != null) {
            $servicos[$index] = $servico;

        } else {
            $servicos[] = $servico;
        }

        Session::put('servicos', $servicos);

        return $servicos;
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
