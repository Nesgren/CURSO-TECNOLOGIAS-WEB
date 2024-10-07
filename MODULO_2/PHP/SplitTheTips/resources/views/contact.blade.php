@extends('layouts.app')

@section('content')
    <h1>Contáctanos</h1>
    <form method="POST" action="{{ route('contact') }}">
        @csrf
        <input type="text" name="name" placeholder="Tu nombre">
        <input type="email" name="email" placeholder="Tu email">
        <textarea name="message" placeholder="Tu mensaje"></textarea>
        <button type="submit">Enviar</button>
    </form>
@endsection