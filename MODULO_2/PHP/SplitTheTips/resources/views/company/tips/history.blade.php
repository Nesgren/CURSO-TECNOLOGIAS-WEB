@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial de Propinas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Empleado</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tips as $tip)
                <tr>
                    <td>{{ $tip->date }}</td>
                    <td>{{ $tip->employee->name }}</td>
                    <td>${{ number_format($tip->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $tips->links() }}
</div>
@endsection