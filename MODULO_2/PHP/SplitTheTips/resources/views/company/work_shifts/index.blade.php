@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Turnos de Trabajo</h1>
    <a href="{{ route('company.work_shifts.create') }}" class="btn btn-primary mb-3">Crear Nuevo Turno</a>

    @if($workShifts->isEmpty())
        <p>No hay turnos de trabajo registrados.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Empleado</th>
                    <th>Horas Trabajadas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workShifts as $workShift)
                    <tr>
                        <td>{{ $workShift->date->format('d/m/Y') }}</td>
                        <td>{{ $workShift->start_time }}</td>
                        <td>{{ $workShift->end_time }}</td>
                        <td>{{ $workShift->employee->name }}</td>
                        <td>{{ $workShift->hours_worked }}</td>
                        <td>
                            <a href="{{ route('company.work_shifts.edit', $workShift) }}" class="btn btn-sm btn-info">Editar</a>
                            <form action="{{ route('company.work_shifts.destroy', $workShift) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection