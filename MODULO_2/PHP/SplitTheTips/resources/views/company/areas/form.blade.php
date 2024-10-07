@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($area) ? 'Edit Area' : 'Create Area' }}</h1>
    <form action="{{ isset($area) ? route('company.areas.update', $area->id) : route('company.areas.store') }}" method="POST">
        @csrf
        @if(isset($area))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Area Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $area->name ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="tip_percentage">Tip Percentage</label>
            <input type="number" class="form-control" id="tip_percentage" name="tip_percentage" value="{{ old('tip_percentage', $area->tip_percentage ?? 0) }}" min="0" max="100" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($area) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection