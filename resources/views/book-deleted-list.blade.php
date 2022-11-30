@extends('layouts.mainlayout')

@section('title', 'Restore Book')

@section('content')
    <h1>Deleted Book List</h1>
    <div class="mt-4 d-flex justify-content-end">
        <a href="/books" class="btn btn-secondary">Back</a>
    </div>
    <div class="my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedBook as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->book_code }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        <a href="book-restore/{{ $item->slug }}" class="btn btn-primary">Restore</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection