@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Turno</h1>
    <form action="{{ route('company.work_shifts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="employee_id">Empleado</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Fecha de Inicio</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_time">Hora de inicio</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time">Hora de fin</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="frequency">Frecuencia</label>
            <select name="frequency" id="frequency" class="form-control">
                <option value="">No repetir</option>
                <option value="weekly">Repetir semanalmente</option>
                <option value="monthly">Repetir mensualmente</option>
                <option value="always">Siempre igual</option> <!-- Nueva opción -->
            </select>
        </div>
        <div class="form-group">
            <label for="repeat_count">Número de repeticiones (solo si no es "Siempre igual")</label>
            <input type="number" name="repeat_count" id="repeat_count" class="form-control" min="1" max="12" value="1">
        </div>
        <button type="submit" class="btn btn-primary">Crear Turno</button>
    </form>
</div>

<script>
// JavaScript para mostrar/ocultar el campo de repeticiones
document.getElementById('frequency').addEventListener('change', function() {
    const repeatCountField = document.getElementById('repeat_count');
    if (this.value === 'always') {
        repeatCountField.style.display = 'none';
    } else {
        repeatCountField.style.display = 'block';
    }
});
</script>

@endsection