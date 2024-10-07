@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invitaciones Enviadas</h1>
    <a href="{{ route('company.invite.form') }}" class="btn btn-primary mb-3">Enviar Nueva Invitación</a>
    <table class="table">
        <thead>
            <tr>
                <th>Email</th>
                <th>Área</th>
                <th>Estado</th>
                <th>Fecha de Envío</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invitations as $invitation)
            <tr>
                <td>{{ $invitation->email }}</td>
                <td>{{ $invitation->area->name }}</td>
                <td>{{ $invitation->status }}</td>
                <td>{{ $invitation->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection