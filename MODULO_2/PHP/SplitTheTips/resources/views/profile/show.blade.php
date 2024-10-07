@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi Perfil</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Información Personal</h5>
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Rol:</strong> {{ ucfirst($user->role) }}</p>
            
            @php
                $employee = null;
                if ($user->role === 'employee') {
                    $employee = $user->employee; // Obtener el empleado relacionado
                }
            @endphp

            @if($employee && $employee->company)
                <p><strong>Compañía:</strong> {{ $employee->company->name }}</p>
            @endif
            
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar Perfil</a>
        </div>
    </div>
</div>
@endsection
