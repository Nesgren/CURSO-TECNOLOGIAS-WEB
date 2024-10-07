@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Fondos de Propinas</h1>
    <a href="{{ route('company.tip_pools.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Fondo</a>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Monto Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipPools as $tipPool)
            <tr>
                <td>{{ $tipPool->date }}</td>
                <td>{{ $tipPool->total_amount }}</td>
                <td>{{ $tipPool->status }}</td>
                <td>
                    @if($tipPool->status !== 'distributed')
                    <form action="{{ route('company.tip_pools.distribute', $tipPool) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Distribuir</button>
                    </form>
                    @else
                    Distribuido
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection