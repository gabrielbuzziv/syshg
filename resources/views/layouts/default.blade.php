<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Gabriel Buzzi Venturi" />
    <meta name="description" content="" />
    <link rel="shortcut icon" href="{{ url('/images/favicon.ico') }}">

    <title>{{ $title }} | SysHG</title>

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic"/>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Abel"/>
    <link rel="stylesheet" href="{{ url('/css/all.css') }}">
</head>

<body class="sticky-header">

<section>
    @include('partials.sidenav')
    <div class="body-content" >
        @include('partials.head')
        @yield('content')
        @include('partials.foot')
    </div>
</section>

<script>
    //<![CDATA[
    var currentRoute = '{{ Route::current()->getName() }}';
    //]]>
</script>
<script src="{{ url('/js/all.js') }}"></script>
@yield('footer')

</body>
</html>
