@extends('layouts.mainlayout')

@section('title', 'User Detail')

@section('content')
    <h1>User Detail</h1>
    <div class="mt-4 d-flex justify-content-end">
        @if ($user->status == 'inactive')
            <a href="/user-approve/{{ $user->slug }}" class="btn btn-primary">Approve User</a>
        @endif
    </div>
    <div class="mt-4 col-sm-12 col-md-6 col-lg-6">
        @if (session('status'))
        <div class="alert alert-{{ session('status') }} text-center" role="alert">
            {{ session('message') }}
        </div>
        @endif
        <div>
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" readonly>
        </div>
        <div class="mt-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" readonly>
        </div>
        <div class="mt-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" style="resize: none" readonly>{{ $user->address }}</textarea>
        </div>
        <div class="mt-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $user->status }}" readonly>
        </div>
        <div class="mt-3">
            @if ($user->status == 'inactive')
                <a href="/register-user" class="btn btn-secondary me-3">Back</a>
            @else
                <a href="/users" class="btn btn-secondary me-3">Back</a>
            @endif
        </div>
    </div>
@endsection