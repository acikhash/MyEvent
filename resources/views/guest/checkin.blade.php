@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <h1>Confirmation Page</h1>
        <p>Welcome, {{ $guest->name }}!</p>
        <p>Your attendance has been confirmed.</p>
    </div>
@endsection
