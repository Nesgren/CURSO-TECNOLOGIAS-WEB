@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Distribuir Propinas</h1>
    <form method="POST" action="{{ route('company.tip_pools.distribute', $tipPool->id) }}">
        @csrf
        <div class="form-group">
            <label for="total_amount">Total de Propinas</label>
            <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" value="{{ $tipPool->total_amount }}" readonly>
        </div>
        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $tipPool->date }}" readonly>
        </div>
        <h2>Distribución por Áreas</h2>
        @foreach($areas as $area)
            <div class="form-group">
                <label>{{ $area->name }} ({{ $area->tip_percentage }}%)</label>
                <input type="text" class="form-control" value="{{ $tipPool->total_amount * ($area->tip_percentage / 100) }}" readonly>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Distribuir Propinas</button>
    </form>
</div>
@endsection