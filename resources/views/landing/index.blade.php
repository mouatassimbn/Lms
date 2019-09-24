@extends('layouts.app')

@section('content')

<div class="container">
    <div class="bg-warning text-center p-5">
        <div class="h1">
            <h1>LMS</h1>
        </div>
        <div>
            <p>Welcome to Laboratory managment system</p>
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
            @endif
        </div>
    </div>
</div>

@endsection