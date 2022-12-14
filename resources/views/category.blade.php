@extends('layouts.mainlayout')

@section('title', 'Category')

@section('content')
    <h1>Category List</h1>

    <div class="mt-4 d-flex justify-content-end">
        <a href="/category-deleted" class="btn btn-secondary me-5">Restore Data</a>
        <a href="/category-add" class="btn btn-primary">Add Data</a>
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
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="category-edit/{{ $item->slug }}" class="btn btn-warning">Edit</a>
                        <a href="category-delete/{{ $item->slug }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection