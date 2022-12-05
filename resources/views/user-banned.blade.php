@extends('layouts.mainlayout')

@section('title', 'User Ban')

@section('content')
    <h2>Are you sure to Ban User {{ $user->username }}</h2>
    <div class="mt-5">
        <a href="/user-destroy/{{ $user->slug }}" class="btn btn-danger me-3">Sure</a>
        <a href="/users" class="btn btn-secondary">Cancel</a>
    </div>
@endsection