@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Propinas del Día</h1>
    <form action="{{ route('company.store-daily-tips') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="total_amount">Monto Total de Propinas</label>
            <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Propinas</button>
    </form>
</div>
@endsection