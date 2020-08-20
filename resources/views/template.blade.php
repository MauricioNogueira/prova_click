<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>@yield('title')</title>
        <style>
            .title-page {
                display: flex;
                justify-content: center;
                margin-top: 2rem;
            }
        </style>
    </head>
    <body>
        <main id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="/">Fruit Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('fruta.create') }}">Cadastrar Fruta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('venda.index') }}">Área de venda</a>
                    </li>
                  </ul>
                </div>
            </nav>
            @yield('content')
        </main>
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
</html>