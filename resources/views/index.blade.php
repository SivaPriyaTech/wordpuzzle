@extends('layouts.app')

@section('content')

<section class="container">
    <div class="text-center mt-3 d-flex justify-content-between align-items-center">
        <h1 class="text-primary text-center" style="flex: 1">Word Puzzle App</h1>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6">
            @if(!session()->has('student_id'))
                @include('register')
            @else
                @include('game')
            @endif
        </div>

        <div class="col-md-6">
            @include('leadershipboard')
        </div>
    </div>
</section>

@endsection