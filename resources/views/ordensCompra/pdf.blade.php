<!doctype html>
<html>
<head>
    <title>Ordem de Compra</title>

    <style type="text/css">
        *{ margin:0; padding:0; }
        .principal{ background:#fff; color:#333; font-family: 'Helvetica', 'verdana', 'sans-serif'; font-weight:300; margin:20px 20px; }
        .principal b{ font-weight:700; }
        .header .logo img { max-width:100%; }
        .header .dados{ padding:0 0 0 20px; }
        .header .dados h1{ color:#333; font-size:22px; font-weight:800; margin:15px 0 0; text-transform:uppercase; }
        .header .dados h2{ color:#333; font-size:18px; font-weight:700; margin-bottom: 6px; }
        .header .dados .endereco{ color:#333; font-size:11px; font-weight:400; }
        .header .dados .contato span{ color:#333; font-size:11px; font-weight:400; margin:0 10px 0 0; }
        .header .data{ color:#333; font-size:14px; font-weight:300; }
        .header .data b{ display:block; margin-bottom: 10px; }
        .detalhes{ border-bottom:1px dotted #000; padding-top: 10px; }
        .detalhes h3{ border-bottom:1px dotted #666; color:#333; display:block; font-size:18px; font-weight:700; padding:0 0 3px; }
        .detalhes .lista{ color:#333; font-size:12px; font-weight:300; padding:5px 0; }
        .detalhes .lista th,
        .detalhes .lista td{ color:#333; font-size:12px; font-weight:400; padding:1px 0; }
        .detalhes .lista th{ font-weight:700; text-align:left; padding-right: 10px; }
        .produtos { padding:5px 0 0; }
        .produtos h3{ color:#333; border-bottom:2px dotted #999; font-size:14px; font-weight:800; padding:0 0 3px; text-transform:uppercase; }
        .produtos .lista-produtos { border-bottom:2px dotted #999; padding:0 0 5px; }
        .produtos .lista-produtos th{ border-bottom:1px dotted #666; color:#333; font-size:13px; font-weight:700; padding:3px 0; }
        .produtos .lista-produtos td{ color:#555; font-size:12px; font-weight:400; padding:2px 0; }
        .produtos .lista-produtos tr:last-child td{ padding:2px 0 4px; }
        .info { font-size: 13px; }
        .info .valor{ padding: 0 20px; }
        .assinatura{ padding:30px 0 20px; }
        .assinatura .linha{ border-top:1px dotted #666; display:inline-block; font-size:13px; font-weight:300; margin:0 20px; padding:5px 0 0; text-align:center; width:330px; }
        .assinatura .linha b { display:block; }
        .nfe p{ border-top:2px dotted #999; color:#333; font-size:11px; font-weight:300; padding:5px 0 0; text-align:center; width:100%; }
        .recorte{ border-top:1px dashed #222; display:block; }
    </style>
</head>
<body>
@for($i = 0; $i < 2; $i++)
<table border="0" cellpadding="0" cellspacing="0" class="principal" align="center;" width="100%">
    <tr>
        <td>
            <table border="0" cellspacing="0" cellpadding="0" class="header" width="100%">
                <tr>
                    <td width="20%">
                    </td>
                    <td width="60%" valign="top">
                        <table border="0" cellspacing="0" cellpadding="0" class="dados">
                            <tr>
                                <td>
                                    <h2>{{ $ordemCompra->empresa->nome }}</h2>
                                    <p class="endereco">
                                        {{ $ordemCompra->empresa->rua }}, {{ $ordemCompra->empresa->numero }} - {{ $ordemCompra->empresa->bairro }}
                                        - {{ $ordemCompra->empresa->cep }} - {{ $ordemCompra->empresa->cidade }} - {{ $ordemCompra->empresa->estado }}
                                    </p>
                                    <p class="contato">
                                        <span><b>Telefone:</b> {{ $ordemCompra->empresa->telefone }}</span>
                                        <span><b>E-mail</b> {{ $ordemCompra->empresa->email }}</span>
                                    </p>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h1>Ordem de Compra</h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="20%" align="right" valign="top">
                        <span class="data">
                            <b>Data de Emissão:</b>
                            @php
                                $timestamp = $ordemCompra->created_at;
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
            <table border="0" cellpadding="0" cellspacing="0" class="detalhes" width="100%">
                <tr>
                    <td colspan="2">
                        <h3>Nº {{ str_pad($ordemCompra->id, 10, "0", STR_PAD_LEFT) }}</h3>
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="lista">
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <th>Endereço:</th>
                                            <td>{{ $ordemCompra->empresa->rua }}, {{ $ordemCompra->empresa->numero }}</td>
                                        </tr>
                                        <tr>
                                            <th>CEP:</th>
                                            <td>{{ $ordemCompra->empresa->cep }}</td>
                                        </tr>
                                        <tr>
                                            <th>CNPJ:</th>
                                            <td>{{ $ordemCompra->empresa->cpnj }}</td>
                                        </tr>
                                        <tr>
                                            <th>Telefone:</th>
                                            <td>{{ $ordemCompra->empresa->telefone }}</td>
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
                                            <th>Cidade:</th>
                                            <td>{{ $ordemCompra->empresa->cidade }} - {{ $ordemCompra->empresa->estado }}</td>
                                        </tr>
                                        <tr>
                                            <th>Inscrição Estadual:</th>
                                            <td>{{ $ordemCompra->empresa->ie }}</td>
                                        </tr>
                                        <tr>
                                            <th>NFE:</th>
                                            <td>{{ $ordemCompra->empresa->email_nfe }}</td>
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
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" class="produtos" width="100%">
                <tr>
                    <td align="center">
                        <h3>Itens</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" class="lista-produtos" width="100%">
                            <tr>
                                <th align="left">Quantidade</th>
                                <th align="left">Produto</th>
                                <th align="left">Valor</th>
                                <th align="left" width="80px">Total</th>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            @foreach ($itens as $item)
                            <tr>
                                <td align="left">{{ $item['quantidade'] }}x</td>
                                <td align="left">{{ $item['item'] }}</td>
                                <td align="left">
                                    @if($item['valor'])
                                        R$ {{ number_format($item['valor'], 2, ',', '.') }}
                                    @endif
                                </td>
                                <td align="left">
                                    @if($item['total'])
                                        R$ {{ number_format($item['total'], 2, ',', '.') }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="info">
                            <tr>
                                <td align="left" width="33%">
                                    <span>
                                        <b>Condições de Pagamento:</b>
                                        30 dias
                                    </span>
                                </td>
                                <td align="left" width="33%"></td>
                                <td align="right" width="33%">
                                    @if($total)
                                    <span>
                                        <b>Total de itens:</b>
                                        <span class="valor">
                                            R$ {{ number_format($total, 2, ',', '.') }}
                                        </span>
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellspacing="0" cellpadding="0" width="100%" class="assinatura">
                <tr>
                    <td align="center">
                            <span class="linha">
                                Autorizado por:
                                <b>{{ $ordemCompra->user->name }}</b>
                            </span>
                            <span class="linha">
                                Autorizado para:
                                <b>{{ $ordemCompra->para }}</b>
                            </span>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td class="nfe">
            <p>Favor, constar o número desta ordem na NF</p>
        </td>
    </tr>
</table>
@if($i == 0)
    <div class="recorte"></div>
@endif
@endfor
</body>
</html>