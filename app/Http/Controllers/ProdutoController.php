<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ProdutoController extends Controller
{
    /**
     * Show all Produtos in session produtos.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $produtos = Session::get('produtos');
        $total = $this->getTotal($produtos);
        return view('produtos.show', compact('produtos', 'total'));
    }

    /**
     * Generate the create produto view form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Novo Produto';
        return view('produtos.create', compact('title'));
    }

    /**
     * Stores Produtos into a Session
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $data = json_decode($request->input('values'));
        $produtos = $this->saveProduto($data);

        $total = $this->getTotal($produtos);

        return view('produtos.show', compact('produtos', 'total'));
    }

    /**
     * Genenerate the edit form with array index value
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = 'Editar Produto';
        $index = $request->input('index');
        $produto = Session::get('produtos')[$index];

        return view('produtos.edit', compact('title', 'produto', 'index'));
    }

    /**
     * Update Produto in the Session
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request)
    {
        $data = json_decode($request->input('values'));
        $produtos = $this->saveProduto($data, $data->index);

        $total = $this->getTotal($produtos);

        return view('produtos.show', compact('produtos', 'total'));
    }

    /**
     * Remove produto from array and update indexes
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(Request $request)
    {
        $produtos = Session::get('produtos');

        unset($produtos[$request->input('index')]);
        $produtos = array_values($produtos);
        Session::put('produtos', $produtos);

        $total = $this->getTotal($produtos);

        return view('produtos.show', compact('produtos', 'total'));
    }

    /**
     * Reindex Produtos
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order(Request $request)
    {
        $indexes = $request->input('indexes');

        $produtos = Session::get('produtos');

        $order = [];
        foreach($indexes as $index){
            $order[] = $produtos[$index];
        }
        Session::put('produtos', $order);
        $produtos = $order;

        $total = $this->getTotal($produtos);

        return view('produtos.show', compact('produtos', 'total'));
    }

    /**
     * This method save the servico into array session
     *
     * @param $data
     * @param null $index
     * @return array
     */
    private function saveProduto($data, $index = null)
    {
        $discount = $data->discount;
        $subTotal = $data->quantidade * $this->convertPrice($data->valor);
        $totalWithDiscount = $subTotal - ($subTotal * ($this->convertPrice($discount) / 100));

        $produtos = Session::get('produtos');
        $produto = [
            'codigo' => $data->codigo,
            'produto' => $data->produto,
            'quantidade' => $data->quantidade,
            'valor' => $this->convertPrice($data->valor),
            'subtotal' => $subTotal,
            'discount' => $this->convertPrice($data->discount),
            'total' => $totalWithDiscount
        ];

        if ($index != null) {
            $produtos[$index] = $produto;
        } else {
            $produtos[] = $produto;
        }

        Session::put('produtos', $produtos);

        return $produtos;
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
