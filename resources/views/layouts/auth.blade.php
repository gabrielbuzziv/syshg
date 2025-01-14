<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('/images/favicon.ico') }}">
    <title>Login</title>

    <link href="{{ url('/css/all.css') }}" rel="stylesheet">

</head>

<body class="login-body">

<div class="login-logo">
    <img src="{{ url('/images/syshg.png') }}" alt=""/>
</div>

<h2 class="form-heading">login</h2>
<div class="container log-row">
    @yield('content')
</div>

<script src="{{ url('/js/all.js') }}"></script>

</body>
</html>
