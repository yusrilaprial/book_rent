@extends('layouts.mainlayout')

@section('title', 'User')

@section('content')
    <h1>User List</h1>

    <div class="mt-4 d-flex justify-content-end">
        <a href="/user-banned" class="btn btn-secondary me-5">Banned User</a>
        <a href="/register-user" class="btn btn-primary">Registered User</a>
    </div>

    <div class="my-4">
        @if (session('status'))
        <div class="alert alert-{{ session('status') }} text-center" role="alert">
            {{ session('message') }}
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->username }}</td>
                    <td>
                        @if ($item->phone)
                            {{ $item->phone }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="/user-detail/{{ $item->slug }}" class="btn btn-info">Detail</a>
                        <a href="/user-ban/{{ $item->slug }}" class="btn btn-danger">Ban User</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection