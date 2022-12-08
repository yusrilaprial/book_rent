@extends('layouts.mainlayout')

@section('title', 'Profile')

@section('content')
<h1>User Detail</h1>
<div class="mt-4 d-flex justify-content-end">
    @if ($user->status == 'inactive')
        <a href="/user-approve/{{ $user->slug }}" class="btn btn-primary">Approve User</a>
    @endif
</div>
<div class="row">
<div class="mt-4 col-sm-12 col-md-4 col-lg-4">
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
</div>
<div class="mt-4 col-sm-12 col-md-8 col-lg-8">
    <x-rent-log--table :rentlogs='$rentlogs'/>
</div>
</div>
@endsection