<!doctype html>
<html>
<head>
    <title>Ordem de Compra</title>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #header,
        #footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }

        #header {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            top: 0;
            background: #fff;
            width: 100%;
            display: block;
            z-index: 9999999999999;
            padding: 20px;
        }

        #footer {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            bottom: 0px;
        }

        .pagenum:before {
            content: counter(page);
        }

        #content {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            color: #333;
            display: block;
            width: 100%;
        }

        #content table {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            width: 100%;
            padding: 80px 0 0;
        }

        #content table:nth-child(1) {
            padding: 40px 0 !important;
        }

        #content table tr th,
        #content table tr td {
            padding: 7px 5px;
            border: 1px solid #ccc;
        }

        @media all {
            .page-break {
                display: none;
            }
        }

        @media print {
            @page {
                size: auto;
                margin: 0;
            }

            body {
                margin: 1cm;
            }

            .page-break {
                display: block;
                page-break-before: always;
            }
        }

    </style>
</head>
<body>
<script>window.print()</script>
<div id="header">
    <h1>Relatório Ordens de Compra</h1>
</div>
<div id="content">
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <th>#</th>
            <th>Empresa</th>
            <th>Autorizado por</th>
            <th>Autorizado para</th>
            <th>Gerado em</th>
            <th>Status</th>
        </tr>
        @foreach ($ordensCompra as $index => $ordemCompra)
            @if ($index != 0 && $index % 20 == 0)
                </table>
                <div class="page-break"></div>
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Autorizado por</th>
                        <th>Autorizado para</th>
                        <th>Gerado em</th>
                        <th>Status</th>
                    </tr>
            @endif
        <tr>
            <td>{{ $ordemCompra->id }}</td>
            <td>{{ $ordemCompra->empresa->apelido }}</td>
            <td>{{ $ordemCompra->user->name }}</td>
            <td>{{ $ordemCompra->para }}</td>
            <td>{{ date('d/m/Y', strtotime($ordemCompra->created_at)) }}</td>
            <td>
                {{ ($ordemCompra->status == 1) ? 'Lançado' : 'Não Lançado' }}
            </td>
        </tr>
        @endforeach
    </table>
</div>

</body>
</html>