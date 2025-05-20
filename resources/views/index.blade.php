@extends('layouts.app')

@section('content')

<section class="container">
    <div class="text-center mt-3">
        <h1 class="text-primary">Word Puzzle App</h1>
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