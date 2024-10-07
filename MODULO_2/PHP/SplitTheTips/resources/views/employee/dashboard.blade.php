@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard del Empleado</h1>
    
    <!-- Sección de Invitaciones Pendientes -->
    @if($pendingInvitations && $pendingInvitations->count() > 0)
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Invitaciones Pendientes</h3>
            @foreach($pendingInvitations as $invitation)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Invitación de {{ $invitation->company->name }}</h5>
                    <p class="card-text">Área: {{ $invitation->area->name }}</p>
                    <form action="{{ route('employee.accept-invitation', ['invitation' => $invitation->id]) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </form>
                    <form action="{{ route('employee.reject-invitation', ['invitation' => $invitation->id]) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Rechazar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                @if($currentArea)
                    <p>Área actual: {{ $currentArea->name }}</p>
                @else
                    <p>No hay área asignada</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Próximos Turnos</h3>
            <ul class="list-group">
                @forelse($upcomingShifts as $shift)
                    <li class="list-group-item">
                        <strong>{{ $shift->date->format('l d/m/Y') }}</strong><br>
                        Horario: {{ $shift->start_time }} a {{ $shift->end_time }}<br>
                        Duración: {{ number_format($shift->hours_worked, 2) }} horas
                        @if($shift->area)
                            <br>Área: {{ $shift->area->name }}
                        @endif
                    </li>
                @empty
                    <li class="list-group-item">No hay turnos programados próximamente.</li>
                @endforelse
            </ul>
            @if($upcomingShifts->count() >= 5)
                <a href="{{ route('employee.all_shifts') }}" class="btn btn-primary mt-3">Ver todos los turnos</a>
            @endif
        </div>
    </div>
</div>
@endsection