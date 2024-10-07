@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Áreas</h1>
    <a href="{{ route('company.areas.create') }}" class="btn btn-primary mb-3">Crear Nueva Área</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($areas as $area)
            <tr>
                <td>{{ $area->name }}</td>
                <td>
                    <a href="{{ route('company.areas.edit', $area->id) }}" class="btn btn-sm btn-info">Editar</a>
                    <form action="{{ route('company.areas.destroy', $area->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </td>
                <td>{{ $area->tip_percentage }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection