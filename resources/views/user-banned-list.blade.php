@extends('layouts.mainlayout')

@section('title', 'User Banned List')

@section('content')
    <h1>User Banned List</h1>

    <div class="mt-4 d-flex justify-content-end">
        <a href="/users" class="btn btn-secondary">Back</a>
    </div>

    <div class="my-4">
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
                @foreach ($bannedUsers as $item)
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
                        <a href="/user-unbanned/{{ $item->slug }}" class="btn btn-primary">Unbanned</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection