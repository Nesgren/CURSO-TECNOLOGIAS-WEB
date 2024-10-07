@extends('layouts.app')

@section('content')
<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    @can('is-company')
        @if(Auth::user()->company)
            {{-- <a class="dropdown-item" href="{{ route('company.profile') }}">Perfil de la Empresa</a> --}}
        @endif
    @elsecan('is-employee')
        {{-- <a class="dropdown-item" href="{{ route('employee.profile') }}">Mi Perfil</a> --}}
    @endcan
    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
@endsection