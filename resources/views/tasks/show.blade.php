@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <h2>{{ $task->name }}</h2>
        </div>
        <steps route="{{ route("tasks.steps.index",$task->id) }}"></steps>
    </div>
@endsection
@section('customJS')
{{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}
@endsection
