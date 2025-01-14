<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('/images/favicon.ico') }}">
    <title>Página Não encontrada</title>

    <link rel="stylesheet" href="{{ url('/css/all.css') }}">

</head>

<body class="body-404">

<section class="error-wrapper">
    <i class="icon-404"></i>
    <div class="text-center">
        <h2 class="green-bg">página não encontrada</h2>
    </div>
    <p>Algo deu errado ou essa página não existe ainda.</p>
    <a href="{{ url('/') }}" class="back-btn">Voltar para o Dashboard</a>
</section>

</body>
</html>
