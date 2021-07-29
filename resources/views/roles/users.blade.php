@extends('layouts.dashboard')

@section('title', "All {$role->title}")

@section('section')
    <livewire:users :role="$role"/>
@endsection