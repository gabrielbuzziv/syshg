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
    <i class="icon-403"></i>
    <div class="text-center">
        <h2 class="green-bg">Você não tem permissão</h2>
    </div>
    <p>Você não tem permissão para acessar essa página.</p>
    <a href="{{ url('/') }}" class="back-btn">Voltar para o Dashboard</a>
</section>

</body>
</html>
