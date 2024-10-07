@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    <div class="text-center">
        <h1>Bienvenido a SplitTheTips</h1>
        <p>La mejor manera de gestionar y distribuir propinas.</p>
    </div>
    @if(Auth::check())
        <div class="alert alert-info">
            Usuario actual: {{ Auth::user()->name ?? 'Sin nombre' }}<br>
            Rol: {{ Auth::user()->role ?? 'Sin rol' }}<br>
            @if(Auth::user()->role === 'employee')
                <div>
                    @if(Auth::user()->employee)
                        <p>ID Empleado: {{ Auth::user()->employee->id ?? 'No asignado' }}</p>
                        <p>Nombre de la Empresa: {{ Auth::user()->employee->company->name ?? 'No asignada' }}</p>
                    @else
                        <span class="text-danger">No se encontró el perfil del empleado.</span>
                    @endif
                </div>
            @endif
        </div>
    @endif
@endsection
