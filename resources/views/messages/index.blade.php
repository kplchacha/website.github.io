@extends('layouts.app')

@section('title', Auth::user()->name . " Messages")

@section('main')
<div class="container">
    <livewire:messages-threads />
</div>
@endsection