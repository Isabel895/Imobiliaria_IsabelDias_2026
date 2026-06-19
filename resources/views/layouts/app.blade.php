<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Imobiliária</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/imobiliaria.css') }}" rel="stylesheet">
</head>
<body>
<nav class="id-navbar navbar navbar-expand-lg">
    <div class="container id-navbar-inner">
        <a class="id-brand" href="/">
            <span class="id-brand-mark">🏠</span>
            <span class="id-brand-name">Imobiliária</span>
        </a>

        <button class="navbar-toggler id-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="id-nav-links">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                        Dashboard
                    </a>
                </li>
                <li><a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}">Clientes</a></li>
                <li><a href="{{ route('apartamentos.index') }}" class="{{ request()->routeIs('apartamentos.*') ? 'active' : '' }}">Apartamentos</a></li>
                <li><a href="{{ route('vendas.index') }}" class="{{ request()->routeIs('vendas.*') ? 'active' : '' }}">Vendas</a></li>
            </ul>

            <ul class="id-nav-links id-nav-right">
                @auth
                    <li class="id-user-pill">{{ Auth::user()->name }}</li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn-logout" title="Logout">
                                <span class="sign">
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 13v-2H7V8l-5 4 5 4v-3z"/>
                                        <path d="M20 3h-9a2 2 0 0 0-2 2v4h2V5h9v14h-9v-4H9v4a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </span>
                                <span class="text">Logout</span>
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}" class="id-cta">Registar</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container id-page">
    @if(session('success'))
        <div class="id-alert">
            {{ session('success') }}
        </div>
    @endif
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
