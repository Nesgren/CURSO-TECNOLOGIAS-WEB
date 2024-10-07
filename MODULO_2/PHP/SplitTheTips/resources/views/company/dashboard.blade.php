@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard de la Compañía</h1>

    <!-- Acciones rápidas -->
    <div class="mb-4">
        <h3>Acciones Rápidas</h3>
        <a href="{{ route('company.register-daily-tips') }}" class="btn btn-primary">Registrar propinas del día</a>
        <a href="{{ route('company.monthly-report') }}" class="btn btn-primary">Ver reporte mensual</a>
        <a href="{{ route('company.work_shifts.create') }}" class="btn btn-primary">Registrar Nuevo Turno</a>
        <a href="{{ route('company.tip_pools.create') }}" class="btn btn-primary">Crear Fondo de Propinas</a>
    </div>

    <!-- Resumen general -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Empleados</h5>
                    <p class="card-text">Total: {{ $employeeCount }}</p>
                    <a href="{{ route('company.employees.index') }}" class="btn btn-primary">Ver Empleados</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Áreas</h5>
                    <p class="card-text">Total: {{ $areaCount }}</p>
                    <a href="{{ route('company.areas.index') }}" class="btn btn-primary">Ver Áreas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Propinas Recientes</h5>
                    <p class="card-text">Último mes: ${{ number_format($recentTipsTotal, 2) }}</p>
                    <a href="{{ route('company.tip_pools.create') }}" class="btn btn-primary">Calcular Propinas</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Notificaciones -->
    @if(isset($notifications) && $notifications->count() > 0)
    <div class="alert alert-info mb-4">
        <h5>Notificaciones</h5>
        <ul>
            @foreach($notifications as $notification)
            <li>{{ $notification->message }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Turnos de Trabajo -->
    <div class="mb-4">
        <h3>Turnos de Trabajo</h3>
        <form class="mb-3" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <input type="date" class="form-control" name="date_filter">
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="employee_filter">
                        <option value="">Todos los empleados</option>
                        @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Horas Trabajadas</th>
                        <th>Propinas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workShifts as $shift)
                    <tr>
                        <td>{{ $shift->employee->name : 'Empleados no asignados' }}</td>
                        <td>{{ $shift->date }}</td>
                        <td>{{ $shift->start_time }}</td>
                        <td>{{ $shift->end_time }}</td>
                        <td>{{ $shift->hours_worked }}</td>
                        <td>${{ number_format($employeeTipTotals[$shift->employee_id] ?? 0, 2) }}</td> <!-- Propinas distribuidas para cada empleado -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $workShifts->links() }} <!-- Paginación -->
    </div>

    <!-- Enlaces de gestión -->
    <div class="row mb-4">
        <div class="col-md-6">
            <a href="{{ route('company.work_shifts.index') }}" class="btn btn-primary btn-block">Gestionar Turnos de Trabajo</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('company.tip_pools.index') }}" class="btn btn-primary btn-block">Gestionar Fondos de Propinas</a>
        </div>
    </div>

    <!-- Empleados Destacados y Áreas más Productivas -->
    <div class="row mt-4">
        <!-- Empleados Destacados -->
        <div class="col-md-6">
            <h3>Empleados Destacados</h3>
            <ul class="list-group">
                @foreach($topEmployees as $employee)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $employee->name }}
                    <span class="badge bg-primary rounded-pill">${{ number_format($employee->tip_distributions_sum_amount, 2) }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Áreas más Productivas -->
        <div class="col-md-6">
            <h3>Áreas más Productivas</h3>
            <ul class="list-group">
                @foreach($topAreas as $area)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $area->name }}
                    <span class="badge bg-primary rounded-pill">${{ number_format($area->tip_distributions_sum_amount, 2) }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
