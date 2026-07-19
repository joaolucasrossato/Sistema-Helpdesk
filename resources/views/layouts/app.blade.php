<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>HelpDesk</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="/dashboard">
            HelpDesk
        </a>

        <div class="navbar-nav">

            <a class="nav-link" href="/dashboard">
                Dashboard
            </a>

            <a class="nav-link" href="/categories">
                Categorias
            </a>

            <a class="nav-link" href="{{ route('tickets.index') }}">
                Chamados
            </a>

        </div>

    </div>
</nav>

<div class="container mt-4">

    @yield('content')

</div>

</body>
</html>
