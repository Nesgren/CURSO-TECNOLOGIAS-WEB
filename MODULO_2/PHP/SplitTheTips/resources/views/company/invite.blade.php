@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invitar Empleado a Área</h1>
    <form action="{{ route('company.invitations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Correo Electrónico del Empleado</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="area_id">Seleccionar Área</label>
            <select name="area_id" id="area_id" class="form-control" required>
                <option value="">Seleccione un área</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Invitación</button>
    </form>
</div>
@endsection