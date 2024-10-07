@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invitar Usuario</h2>
    <form action="{{ route('company.send-invite') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email del usuario:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="area_id">Área:</label>
            <select class="form-control" id="area_id" name="area_id" required>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Invitación</button>
    </form>
</div>
@endsection