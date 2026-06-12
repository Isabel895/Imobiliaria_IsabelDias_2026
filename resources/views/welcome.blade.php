<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Imobiliária</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand fw-bold">🏠 Imobiliária</span>
        <div class="ms-auto d-flex gap-2">
            @auth
                <span class="navbar-text text-light me-2">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-light btn-sm">Registar</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container text-center py-5 mt-4">
    <span style="font-size: 4rem;">🏠</span>
    <h1 class="display-4 fw-bold mt-3">Imobiliária</h1>
    <p class="text-muted fs-5 mb-5">Gestão de clientes, apartamentos e vendas</p>

    <div class="row justify-content-center g-4">
        <div class="col-md-3">
            <a href="{{ route('clientes.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100"
                     onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 .5rem 1.5rem rgba(0,0,0,.15)'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''"
                     style="transition: transform .2s, box-shadow .2s; cursor:pointer;">
                    <div class="card-body py-5">
                        <div style="font-size:2.8rem;">👤</div>
                        <h4 class="fw-semibold text-dark mt-3">Clientes</h4>
                        <p class="text-muted small mb-0">Consultar e gerir clientes</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('apartamentos.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100"
                     onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 .5rem 1.5rem rgba(0,0,0,.15)'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''"
                     style="transition: transform .2s, box-shadow .2s; cursor:pointer;">
                    <div class="card-body py-5">
                        <div style="font-size:2.8rem;">🏢</div>
                        <h4 class="fw-semibold text-dark mt-3">Apartamentos</h4>
                        <p class="text-muted small mb-0">Consultar e gerir apartamentos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('vendas.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100"
                     onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 .5rem 1.5rem rgba(0,0,0,.15)'"
                     onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''"
                     style="transition: transform .2s, box-shadow .2s; cursor:pointer;">
                    <div class="card-body py-5">
                        <div style="font-size:2.8rem;">💼</div>
                        <h4 class="fw-semibold text-dark mt-3">Vendas</h4>
                        <p class="text-muted small mb-0">Consultar e gerir vendas</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
