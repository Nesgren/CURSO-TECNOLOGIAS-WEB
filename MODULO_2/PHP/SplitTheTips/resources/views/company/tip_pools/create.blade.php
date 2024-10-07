@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Registrar nuevo fondo de propinas</h1>
        <form action="{{ route('company.tip_pools.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">Fecha</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="total_amount">Monto Total</label>
                <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

@endSection