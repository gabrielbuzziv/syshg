<td colspan="6">
    <div class="col-md-6 col-sm-12">
        <h3>Dados da Ordem de Compra</h3>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="orcamento">
            <tr>
                <th>Empresa</th>
                <td>{{ $ordemCompra->empresa->nome }}</td>
            </tr>
            <tr>
                <th>Autorizado por</th>
                <td>{{ $ordemCompra->user->name }}</td>
            </tr>
            <tr>
                <th>Autorizado para</th>
                <td>{{ $ordemCompra->para }}</td>
            </tr>
            <tr>
                <th>Onde Comprar</th>
                <td>{{ $ordemCompra->onde_comprar }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6 col-sm-12">
        <h3>Itens</h3>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th>Item</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>Total</th>
            </tr>
            @foreach($itens as $item)
                <tr>
                    <td>{{ $item['item'] }}</td>
                    <td>{{ $item['quantidade'] }}</td>
                    <td>
                        @if($item['valor'])
                            R$ {{ number_format($item['valor'], 2, ',', '.') }}
                        @endif
                    </td>
                    <td>
                        @if($item['total'])
                            R$ {{ number_format($item['total'], 2, ',', '.') }}
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                @if($total)
                <td colspan="3" align="right">Total</td>
                <td colspan="3">R$ {{ number_format($total, 2, ',', '.') }}</td>
                @endif
            </tr>
        </table>
    </div>
</td>