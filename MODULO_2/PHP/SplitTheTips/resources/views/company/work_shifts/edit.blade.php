@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Work Shift</h1>
    <form action="{{ route('company.work_shifts.update', $workShift) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee_id">Employee</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $workShift->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $workShift->date->format('Y-m-d') }}" required>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $workShift->start_time }}" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $workShift->end_time }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Work Shift</button>
    </form>
</div>
@endsection