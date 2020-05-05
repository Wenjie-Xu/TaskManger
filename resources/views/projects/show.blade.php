@extends('layouts.app')

@section('content')
    <div class="continer">
        @include('tasks._createTask')
        @include('tasks._list')
    </div>
@endsection