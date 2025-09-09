<td colspan="7">
    <div class="col-md-6 col-sm-12">
        <h3>Dados do Orçamento</h3>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="orcamento">
            <tr>
                <th>Empresa</th>
                <td>{{ $orcamento->empresa->nome }}</td>
            </tr>
            <tr>
                <th>Cliente</th>
                <td>{{ $orcamento->cliente }}</td>
            </tr>
            <tr>
                <th>Placa</th>
                <td>{{ $orcamento->placa }}</td>
            </tr>
            <tr>
                <th>Veículo</th>
                <td>{{ $orcamento->veiculo }}</td>
            </tr>
            <tr>
                <th>Quilometragem</th>
                <td>{{ $orcamento->km }}</td>
            </tr>
            <tr>
                <th>Observação</th>
                <td>{{ $orcamento->observacao }}</td>
            </tr>
            <tr>
                <th>Telefone Comercial</th>
                <td>{{ $orcamento->telefone_comercial }}</td>
            </tr>
            <tr>
                <th>Telefone Residencial</th>
                <td>{{ $orcamento->telefone_residencial }}</td>
            </tr>
            <tr>
                <th>Celular</th>
                <td>{{ $orcamento->celular }}</td>
            </tr>
            <tr>
                <th>Funcionário</th>
                <td>{{ $orcamento->user->name }}</td>
            </tr>
            <tr>
                <th>Condições de Pagamento</th>
                <td>{{ $orcamento->condicoes_pagamento }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6 col-sm-12">
        @if (count($servicos) > 0)
        <h3>Serviços</h3>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th>Serviço</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>SubTotal</th>
                <th>Desconto</th>
                <th>Total</th>
            </tr>
            @foreach($servicos as $servico)
                <tr>
                    <td>{{ $servico['servico'] }}</td>
                    <td>{{ $servico['quantidade'] }}</td>
                    <td>R$ {{ number_format($servico['valor'], 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($servico['quantidade'] * $servico['valor'], 2, ',', '.') }}</td>
                    <td>{{ $servico['discount'] }}%</td>
                    <td>R$ {{ number_format($servico['total'], 2, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">Total</td>
                <td>R$ {{ number_format($totalServicos, 2, ',', '.') }}</td>
            </tr>
        </table>
        @endif

        @if (count($produtos) > 0)
        <h3>Produtos</h3>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th>Código</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>SubTotal</th>
                <th>Desconto</th>
                <th>Total</th>
            </tr>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{ $produto['codigo'] }}</td>
                    <td>{{ $produto['produto'] }}</td>
                    <td>{{ $produto['quantidade'] }}</td>
                    <td>R$ {{ number_format($produto['valor'], 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($produto['quantidade'] * $produto['valor'], 2, ',', '.') }}</td>
                    <td>{{ $produto['discount'] }}%</td>
                    <td>R$ {{ number_format($produto['total'], 2, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">Total</td>
                <td>R$ {{ number_format($totalProdutos, 2, ',', '.') }}</td>
            </tr>
        </table>
        @endif

        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="total">
            <tr>
                <td>
                    Total
                </td>
                <td>R$ {{ number_format($total, 2, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</td>