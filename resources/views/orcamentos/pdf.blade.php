<!doctype html>
<html>
<head>
    <title>Orçamento</title>

    <style>
        *{ margin:0; padding:0; }
        .principal{ background:#fff; color:#333; font-family: 'Helvetica', 'verdana', 'sans-serif'; font-weight:300; margin:20px 20px; }
        .principal b{ font-weight:700; }
        .header .logo img { max-height: 60px; }
        .header .dados{ padding:0 0 0 20px; }
        .header .dados h1{ color:#333; font-size:22px; font-weight:800; margin:25px 0 0; text-transform:uppercase; }
        .header .dados h2{ color:#333; font-size:14px; font-weight:700; margin-bottom: 10px; }
        .header .dados .endereco{ color:#333; font-size:11px; font-weight:400; }
        .header .dados .contato span{ color:#333; font-size:11px; font-weight:400; margin:0 10px 0 0; }
        .header .data{ color:#333; font-size:14px; font-weight:300; }
        .header .data b{ display:block; margin-bottom: 10px; }
        .detalhes{ border-bottom:1px dotted #666; padding-top: 30px; }
        .detalhes h3{ border-bottom:1px dotted #666; color:#333; display:block; font-size:18px; font-weight:700; padding:0 0 3px; }
        .detalhes .lista{ color:#333; font-size:12px; font-weight:300; padding:5px 0;  }
        .detalhes .lista th,
        .detalhes .lista td{ color:#333; font-size:12px; font-weight:400; padding:3px 0; }
        .detalhes .lista th{ font-weight:700; text-align:left; padding-right: 10px; }
        .servicos { padding:1px 0 0; }
        .servicos h3{ color:#333; border-bottom:2px dotted #999; font-size:14px; font-weight:800; padding:0 0 3px; text-transform:uppercase; }
        .servicos .lista-servicos { border-bottom:2px dotted #999; padding:0 0 5px; }
        .servicos .lista-servicos th{ border-bottom:1px dotted #666; color:#333; font-size:12px; font-weight:700; margin:0 0 5px; padding:5px 0 4px; }
        .servicos .lista-servicos td{ color:#555; font-size:12px; font-weight:400; padding:2px 0; }
        .servicos .lista-servicos tr:last-child td{ padding:2px 0 5px; }
        .produtos { padding: 1px 0 0; }
        .produtos h3{ color:#333; border-bottom:2px dotted #999; font-size:14px; font-weight:800; padding:0 0 3px; text-transform:uppercase; }
        .produtos .lista-produtos { border-bottom:2px dotted #999; padding:0 0 5px; }
        .produtos .lista-produtos.extra { border-bottom:2px dotted #999; padding:0 0 5px; margin-top: 40px; }
        .produtos .lista-produtos th{ border-bottom:1px dotted #666; color:#333; font-size:12px; font-weight:700; margin:0 0 5px; padding:5px 0 4px; }
        .produtos .lista-produtos td{ color:#555; font-size:12px; font-weight:400; padding:2px 0; }
        .produtos .lista-produtos tr:last-child td{ padding:2px 0 5px; }
        .totais { padding: 5px 15px; }
        .total { font-size: 13px; padding-bottom: 5px; display:block }
        .total b { font-size: 15px; }
        .total .valor { text-align:right }
        .assinatura{ padding:20px 0 0; }
        .assinatura .linha{ border-top:1px dotted #666; display:block; font-size:13px; font-weight:300; margin:0 auto; padding:5px 0 0; text-align:center; width:370px; }
        .obs{ padding:10px 0; }
        .obs b{ color:#333; font-size:13px; font-weight:700; text-transform:uppercase; }
        .obs p{ font-size:13px; font-weight:400; }
        .pagamento{ padding:5px 0; }
        .pagamento b{ color:#333; font-size:13px; font-weight:700; text-transform:uppercase; }
        .pagamento p{ font-size:13px; font-weight:400; }
        .validade p{ color:#333; font-size:11px; font-weight:400; }
        .page-break { page-break-after: always;  }
    </style>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" class="principal">
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="95%" class="header">
                <tr>
                    <td width="20%" class="logo">
                        <img src="{{ url('/uploads/empresas/' . $orcamento->empresa->logo) }}" alt="">
                    </td>
                    <td width="60%" valign="top">
                        <table border="0" cellspacing="0" cellpadding="0" class="dados">
                            <tr>
                                <td>
                                    <h2>{{ $orcamento->empresa->nome }}</h2>
                                    <p class="endereco">
                                        {{ $orcamento->empresa->rua }}, {{ $orcamento->empresa->numero }} - {{ $orcamento->empresa->bairro }}
                                        - {{ $orcamento->empresa->cep }} - {{ $orcamento->empresa->cidade }} - {{ $orcamento->empresa->estado }}
                                    </p>
                                    <p class="contato">
                                        <span><b>Telefone:</b> {{ $orcamento->empresa->telefone }}</span>
                                        <span><b>E-mail</b> {{ $orcamento->empresa->email }}</span>
                                    </p>

                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="20%" valign="top" align="right">
                        <span class="data">
                            <b>Data do Orçamento:</b>
                            @php
                                $timestamp = $orcamento->created_at;
                                $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, 'UTC');
                                $date->setTimezone('America/Sao_Paulo');
                            @endphp
                            {{ date('d/m/Y', strtotime($date)) }}
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" class="detalhes" width="95%">
                <tr>
                    <td colspan="2">
                        <h3>Orçamento Nº {{ str_pad($orcamento->id, 10, "0", STR_PAD_LEFT) }}</h3>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="lista">
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <th>Cliente:</th>
                                            <td>{{ $orcamento->cliente }}</td>
                                        </tr>
                                        <tr>
                                            <th>Endereço:</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Telefone:</th>
                                            <td>
                                                @if ($orcamento->telefone_comercial)
                                                {{ $orcamento->telefone_comercial }} 
                                                    @if ($orcamento->telefone_residencial)
                                                        |
                                                    @endif
                                                @endif
                                                @if ($orcamento->telefone_residencial)
                                                {{ $orcamento->telefone_residencial  }} 
                                                    @if ($orcamento->celular)
                                                     |
                                                    @endif
                                                @endif
                                                @if ($orcamento->celular)
                                                {{ $orcamento->celular }}</td>
                                                @endif
                                        </tr>
                                        <tr>
                                            <th>Funcionário:</th>
                                            <td>{{ $orcamento->user->name }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="lista">
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <th>Placa:</th>
                                            <td>
                                                @if ($orcamento->placa)
                                                {{ $orcamento->placa }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Veículo:</th>
                                            <td>
                                                @if ($orcamento->veiculo)
                                                {{ $orcamento->veiculo }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Ano do Veículo:</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Quilometragem:</th>
                                            <td>
                                                @if ($orcamento->km)
                                                {{ $orcamento->km }} km
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    @if (count($servicos) > 0)
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" class="servicos" width="95%">
                <tr>
                    <td align="center">
                        <h3>Serviços</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" class="lista-servicos" width="100%">
                            <tr>
                                <th align="left">Serviço</th>
                                <th align="center">Quantidade</th>
                                <th align="left">Valor</th>
                                <th align="left">SubTotal</th>
                                <th align="left">Desconto</th>
                                <th align="left" width="75px">Total</th>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            @foreach($servicos as $servico)
                            <tr>
                                <td align="left">{{ $servico['servico'] }}</td>
                                <td align="center">
                                    {{ $servico['quantidade'] }}
                                    {{ $servico['lancamento'] == true ? 'x' : 'hrs' }}
                                </td>
                                <td align="left">R$ {{ number_format($servico['valor'], 2, ',', '.') }}</td>
                                <td align="left">R$ {{ number_format($servico['quantidade'] * $produto['valor'], 2, ',', '.') }}</td>
                                <td align="left">{{ $servico['discount'] }}%</td>
                                <td align="left">R$ {{ number_format($servico['total'], 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    @endif
    @if(count($produtos) > 0)
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" class="produtos" width="95%">
                <tr>
                    <td align="center">
                        <h3>Produtos</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" class="lista-produtos {{ count($produtos) > 20 ? 'page-break' : '' }}" width="100%">
                            <tr>
                                <th align="left">Código</th>
                                <th align="left">Produto</th>
                                <th align="center">Quantidade</th>
                                <th align="left">Valor</th>
                                <th align="left">SubTotal</th>
                                <th align="left">Desconto</th>
                                <th align="left" width="75px">Total</th>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            @php
                            $paginate = 31
                            @endphp

                            @foreach($produtos as $key => $produto)
                                <tr>
                                    <td align="left">{{ str_pad($produto['codigo'], 10, "0", STR_PAD_LEFT) }}</td>
                                    <td align="left">{{ $produto['produto'] }}</td>
                                    <td align="center">{{ $produto['quantidade'] }}x</td>
                                    <td align="left">R$ {{ number_format($produto['valor'], 2, ',', '.') }}</td>
                                    <td align="left">R$ {{ number_format($produto['quantidade'] * $produto['valor'], 2, ',', '.') }}</td>
                                    <td align="left">{{ $produto['discount'] }}%</td>
                                    <td align="left">R$ {{ number_format($produto['total'], 2, ',', '.') }}</td>
                                </tr>

                                @if ($key > 0 && $key % $paginate === 0)
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" class="lista-produtos extra {{ (count($produtos) - ($key + 1)) >= $paginate ? 'page-break' : '' }}"width="100%">
                                        <tr>
                                            <th align="left">Código</th>
                                            <th align="left">Produto</th>
                                            <th align="center">Quantidade</th>
                                            <th align="left">SubTotal</th>
                                            <th align="left">Desconto</th>
                                            <th align="left">Valor</th>
                                            <th align="left" width="75px">Total</th>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                        </tr>
                                @endif
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    @endif
    <tr>
        <td align="left">
            <table border="0" cellpadding="0" cellspacing="0" width="95%">
                <tr>
                    <td class="pagamento" valign="top">
                        <b>Condições de Pagamento</b>
                        <p>
                            @if ($orcamento->condicoes_pagamento)
                            {!! nl2br($orcamento->condicoes_pagamento) !!}
                            @endif
                        </p>
                    </td>
                    <td class="totais" valign="bottom" align="right">
                        <span class="total">
                            Total de Serviços:
                            <span class="valor">R$ {{ number_format($totalServicos, 2, ',', '.') }}</span>
                        </span>
                        <span class="total">
                            Total de Produtos:
                            <span class="valor">R$ {{  number_format($totalProdutos, 2, ',', '.') }}</span>
                        </span>
                        <b class="total">
                            Total:
                            <span class="valor">R$ {{  number_format($total, 2, ',', '.') }}</span>
                        </b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellspacing="0" cellpadding="0" width="95%" class="assinatura obs">
                <tr>
                    <td width="50%">
                        <b>Observação:</b>
                        <p>
                            @if ($orcamento->observacao)
                            {!! nl2br($orcamento->observacao) !!}
                            @endif
                        </p>
                    </td>
                    <td align="left" valign="bottom" width="50%">
                        <span class="linha">
                            {{ $orcamento->cliente }}
                        </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="validade">
            <p>Validade do Orçamento: 5 dias após a Data do Orçamento.</p>
        </td>
    </tr>
</table>
</body>
</html>