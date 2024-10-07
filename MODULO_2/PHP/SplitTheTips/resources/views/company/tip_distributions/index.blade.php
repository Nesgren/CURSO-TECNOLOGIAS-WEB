@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Distribución de Propinas</h1>
    @foreach($tipPools as $tipPool)
        <h2>Fecha: {{ $tipPool->date }} - Total: ${{ number_format($tipPool->total_amount, 2) }}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Empleado</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipPool->tipDistributions as $distribution)
                    <tr>
                        <td>{{ $distribution->area->name }}</td>
                        <td>{{ $distribution->employee->name }}</td>
                        <td>${{ number_format($distribution->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection