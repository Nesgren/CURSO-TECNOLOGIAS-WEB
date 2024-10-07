@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    <div class="text-center">
        <h1>Bienvenido a SplitTheTips</h1>
        <p>La mejor manera de gestionar y distribuir propinas.</p>
    </div>
    @if(Auth::check())
    <div class="alert alert-info">
        Usuario actual: {{ Auth::user()->name }}<br>
        Rol: {{ Auth::user()->role }}<br>
    </div>
@endif
@endsection