<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('/images/favicon.ico') }}">
    <title>Página Não encontrada</title>

    <link rel="stylesheet" href="{{ url('/css/all.css') }}">

</head>

<body class="body-500">

<section class="error-wrapper">
    <i class="icon-500"></i>
    <div class="text-center">
        <h2 class="green-bg">algo deu errado</h2>
    </div>
    <p>Tente atualizar a página ou entre em contato com o administrador</p>
    <a href="{{ url('/') }}" class="back-btn">Voltar para o Dashboard</a>
</section>

</body>
</html>
