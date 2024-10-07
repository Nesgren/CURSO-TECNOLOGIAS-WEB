@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->company)
        <h1>Empleados de {{ Auth::user()->company->name }}</h1>
        <a href="{{ route('company.invite.form') }}" class="btn btn-primary mb-3">Invitar Empleado</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Área</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->user->name }}</td>
                    <td>{{ $employee->user->email }}</td>
                    <td>{{ $employee->area->name ?? 'No asignada' }}</td>
                    <td>
                        <a href="{{ route('company.employees.edit', $employee) }}" class="btn btn-sm btn-info">Editar</a>
                        <form action="{{ route('company.employees.destroy', $employee) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">
            No tienes una empresa asociada. Por favor, contacta al administrador.
        </div>
    @endif
</div>
@endsection