@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Calcular Propinas</h1>

    <form action="{{ route('company.calculate-tips-post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="total_tips" class="form-label">Total de Propinas a Repartir</label>
            <input type="number" step="0.01" class="form-control" id="total_tips" name="total_tips" required>
        </div>

        <button type="submit" class="btn btn-primary">Calcular y Guardar Propinas</button>
    </form>
</div>
@endsection
