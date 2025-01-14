<?php

namespace App\Http\Controllers;

use App\Item;
use App\Log;
use App\Orcamento;
use App\OrdemCompra;
use App\Produto;
use App\Servico;
use Illuminate\Http\Request;

use App\Http\Requests;

class IntegracaoController extends Controller
{
    protected $users = [
        1 => 5, // Gabriel
        3 => 4, // Adriana
        4 => 6, // Nilza
        5 => 7, // Fernando
        6 => 8, // Maicon
        7 => 13, // Giovanni
        8 => 15, // Elsa
        9 => 4, // Felipe -> Adriana
        10 => 10, // Rosana
        11 => 11, // Ligia
        12 => 10, // Luiz Bogo -> Rosana
        13 => 9, // Larcio -> Rodrigo
        14 => 18, // Danilo
        15 => 17, // Eduardo
        16 => 12, // Francisco
        17 => 9, // Rodrigo
    ];

    protected $empresas = [
        1 => 1, // HG RSL
        2 => 3, // HG Blu
        3 => 4, // Sul RSL
        4 => 5, // Sul Blu
    ];

    protected $status = [
        'S' => 1, // Sim
        'N' => 0, // Não
    ];

    protected $acao = [
        'add' => 'adicionado',
        'edt' => 'editado',
        'lan' => 'lancado',
    ];

    protected $tipo = [
        'ordem-de-compra' => 'ordemCompra',
        'ordem-compra' => 'ordemCompra',
        'orcamento' => 'orcamentos',
    ];

    /**
     * IMporta os orçamentos
     */
    public function orcamento()
    {
        $file = public_path() . '/orcamentos.csv';
        if (file_exists($file)) {
            $file = fopen($file, 'r');
            $arr = [];
            while (($line = fgetcsv($file)) !== FALSE) {
                $orcamento = new Orcamento();
                if ($line[1] != 0 && $line[10] != 0) {
                    $orcamento->id = $line[0];
                    $orcamento->empresa_id = $this->empresas[$line[1]];
                    $orcamento->cliente = $line[2];
                    $orcamento->placa = $line[3];
                    $orcamento->veiculo = $line[4];
                    $orcamento->km = $line[5];
                    $orcamento->observacao = $line[6];
                    $orcamento->telefone_comercial = $line[7];
                    $orcamento->telefone_residencial = $line[8];
                    $orcamento->celular = $line[9];
                    $orcamento->user_id = $this->users[$line[10]];
                    $orcamento->condicoes_pagamento = $line[11];
                    $orcamento->created_at = $line[12];

                    $orcamento->save();
                }
            }
            fclose($file);
        } else {
            echo 'Não foi encontrado o arquivo para integração.';
        }
    }

    /**
     * Importa os Serviços
     */
    public function orcamentoServicos()
    {
        $file = public_path() . '/orcamentos_servicos.csv';
        if (file_exists($file)) {
            $file = fopen($file, 'r');
            $arr = [];
            while (($line = fgetcsv($file)) !== FALSE) {
                $servico = new Servico();
                if ($line[6] != 0) {
                    $servico->id = $line[0];
                    $servico->servico = $line[1];

                    if(!empty($line[2]) && empty($line[3])) {
                        $tempo = explode(':', $line[2]);
                        $minutos = (100 * $tempo[1]) / 60;
                        $quantidade = $tempo[0] . '.' . ceil($minutos);

                        $servico->quantidade = $quantidade;
                    } else {
                        $servico->quantidade = $line[3];
                    }

                    $servico->valor = $line[4];
                    $servico->lancamento = $line[5];
                    $servico->orcamento_id = $line[6];

                    $servico->save();
                }

            }


            fclose($file);
        } else {
            echo 'Não foi encontrado o arquivo para integração.';
        }
    }

    /**
     * Importa os produtos
     */
    public function orcamentoProdutos()
    {
        $file = public_path() . '/orcamentos_produtos.csv';
        if (file_exists($file)) {
            $file = fopen($file, 'r');
            $arr = [];
            while (($line = fgetcsv($file)) !== FALSE) {
                $produto = new Produto();
                if ($line[5] != 0) {
                    $produto->id = $line[0];
                    $produto->codigo = $line[1];
                    $produto->produto = $line[2];
                    $produto->quantidade = $line[3];
                    $produto->valor = $line[4];
                    $produto->orcamento_id = $line[5];

                    $produto->save();
                }
            }

            fclose($file);
        } else {
            echo 'Não foi encontrado o arquivo para integração.';
        }
    }

    /**
     * Calcula total dos  servicos e produtos de cada orçamento e atualiza a tabela orçamento
     */
    public function orcamentoTotal()
    {
        $orcamentos = Orcamento::latest()->get();
        foreach ($orcamentos as $orcamento) {
            $total = 0;
            $servicos = Servico::where('orcamento_id', '=', $orcamento->id)->get();
            foreach ($servicos as $servico) {
                $total += $servico->quantidade * $servico->valor;
            }

            $produtos = Produto::where('orcamento_id', '=', $orcamento->id)->get();
            foreach ($produtos as $produto) {
                $total += $produto->quantidade * $produto->valor;
            }

            $orcamento->total = $total;
            $orcamento->save();
        }
    }

    /**
     * Importa os ordem de compra
     */
    public function ordemCompra()
    {
        $file = public_path() . '/ordens_compra.csv';
        if (file_exists($file)) {
            $file = fopen($file, 'r');
            $arr = [];
            while (($line = fgetcsv($file)) !== FALSE) {
                $ordemCompra = new OrdemCompra();
                if ($line[1] != 0 && $line[2] != 0) {
                    $ordemCompra->id = $line[0];
                    $ordemCompra->empresa_id = $this->empresas[$line[1]];
                    $ordemCompra->user_id = $this->users[$line[2]];
                    $ordemCompra->para = $line[3];
                    $ordemCompra->onde_comprar = $line[4];
                    $ordemCompra->created_at = $line[5];
                    $ordemCompra->status = $this->status[$line[6]];

                    $ordemCompra->save();
                }
            }

            fclose($file);
        } else {
            echo 'Não foi encontrado o arquivo para integração.';
        }
    }

    /**
     * Importa os itens
     */
    public function ordemCompraItens()
    {
        $file = public_path() . '/ordens_compra_itens.csv';
        if (file_exists($file)) {
            $file = fopen($file, 'r');
            $arr = [];
            while (($line = fgetcsv($file)) !== FALSE) {
                $item = new Item();
                if ($line[1] != 0) {
                    if (OrdemCompra::find($line[1])) {
                        $item->id = $line[0];
                        $item->ordem_compra_id = $line[1];
                        $item->quantidade = $line[2];
                        $item->item = $line[3];

                        $item->save();
                    }
                }
            }

            fclose($file);
        } else {
            echo 'Não foi encontrado o arquivo para integração.';
        }
    }

    /**
     * Importa os logs
     */
    public function log()
    {
        $file = public_path() . '/logs.csv';
        if (file_exists($file)) {
            $file = fopen($file, 'r');
            $arr = [];
            while (($line = fgetcsv($file)) !== FALSE) {
                $log = new Log();
                if ($line[2] != 0) {
                    $log->relacao_id = $line[1];
                    $log->user_id = $this->users[$line[2]];
                    $log->acao = $this->acao[$line[3]];
                    $log->tipo = $this->tipo[$line[4]];
                    $log->created_at = $line[5];

                    $log->save();
                }
            }

            fclose($file);
        } else {
            echo 'Não foi encontrado o arquivo para integração.';
        }
    }
}
