@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Monthly Report for {{ Carbon\Carbon::create($year, $month, 1)->format('F Y') }}</h1>
    
    @if($report)
        <p>Total Tips: ${{ number_format($report->total_tips, 2) }}</p>
        <p>Average Daily Tips: ${{ number_format($report->average_tips, 2) }}</p>
        <p>Days with Tips: {{ $report->days_with_tips }}</p>
    @else
        <p>No data available for this month.</p>
    @endif
    
    <!-- Add more report details as needed -->
</div>
@endsection