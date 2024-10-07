@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Propinas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tips as $tip)
                <tr>
                    <td>{{ $tip->created_at->format('Y-m-d') }}</td>
                    <td>${{ number_format($tip->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection