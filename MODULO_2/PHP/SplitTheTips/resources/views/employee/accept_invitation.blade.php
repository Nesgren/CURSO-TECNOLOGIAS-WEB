@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Aceptar Invitación</h1>
    <p>Has sido invitado a unirte a {{ $invitation->company->name }} como empleado en el área de {{ $invitation->area->name }}.</p>
    <form action="{{ route('invitation.accept', $invitation->token) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tu Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="password">Elige una Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirma tu Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Aceptar Invitación</button>
    </form>
</div>
@endsection