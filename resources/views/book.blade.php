@extends('layouts.mainlayout')

@section('title', 'Book')

@section('content')
    <h1>Books List</h1>

    <div class="mt-4 d-flex justify-content-end">
        <a href="/book-deleted" class="btn btn-secondary me-5">Restore Data</a>
        <a href="/book-add" class="btn btn-primary">Add Data</a>
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
                    <th>Code</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->book_code }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @foreach ($item->categories as $data)
                                {{ $data->name }}, 
                            @endforeach
                        </td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="/book-edit/{{ $item->slug }}" class="btn btn-warning">Edit</a>
                            <a href="/book-delete/{{ $item->slug }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
