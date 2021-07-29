@extends('layouts.app')

@section('title', Auth::user()->name . " - " . $user->name . " Messages")

@section('main')
<div class="container">
    <livewire:messages :user="$user" />
</div>
@endsection