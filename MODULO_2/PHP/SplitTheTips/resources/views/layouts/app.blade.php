<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SplitTheTips - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link:hover {
            background-color: #e9ecef;
            color: #007bff;
        }

        .alert {
            margin-top: 20px;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-footer .btn {
            margin-left: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>
    @if(session('pending_invitation'))
        @include('partials.pending_invitation')
    @endif

    @php
        $employee = null;
        if (Auth::check() && Auth::user()->role === 'employee') {
            $employee = Auth::user()->employee; // Obtener el empleado relacionado
        }
    @endphp

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Split The Tips
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(Auth::user()->role === 'company')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('company.dashboard') ? 'active' : '' }}" href="{{ route('company.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('company.areas.*') ? 'active' : '' }}" href="{{ route('company.areas.index') }}">Áreas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('company.employees.*') ? 'active' : '' }}" href="{{ route('company.employees.index') }}">Empleados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('company.calculate-tips') ? 'active' : '' }}" href="{{ route('company.tip_pools.index') }}">Propinas</a>
                            </li>
                        @elseif(Auth::user()->role === 'employee')
                            @php
                                $employee = Auth::user()->employee; // Obtener el empleado relacionado
                            @endphp
                            @if($employee && $employee->company)
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}" href="{{ route('employee.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('employee.my-tips') ? 'active' : '' }}" href="{{ route('employee.my-tips') }}">Mis Propinas</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <span class="nav-link text-danger">Rol de usuario no válido</span>
                                </li>
                            @endif
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                @if($employee && $employee->company)
                                    ({{ $employee->company->name }})
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->role === 'company')
                                    @if(Auth::user()->company)
                                        <a class="dropdown-item" href="{{ route('company.profile') }}">Perfil de la Empresa</a>
                                    @endif
                                @elseif(Auth::user()->role === 'employee')
                                    <a class="dropdown-item" href="{{ route('employee.profile') }}">Mi Perfil</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')

        @if(session('pending_invitation'))
            <div class="modal fade" id="invitationModal" tabindex="-1" role="dialog" aria-labelledby="invitationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="invitationModalLabel">Invitación Pendiente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Has sido invitado a unirte al área "{{ session('pending_invitation')->area->name ?? 'desconocida' }}" en la empresa "{{ session('pending_invitation')->company->name ?? 'desconocida' }}".
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('employee.accept-invitation', session('pending_invitation')) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </form>
                            <form action="{{ route('employee.reject-invitation', session('pending_invitation')) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Rechazar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('invitationModal'));
                    myModal.show();
                });
            </script>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
