@extends('layouts.mainlayout')

@section('title', 'Restore Category')

@section('content')
    <h1>Deleted Category List</h1>
    <div class="mt-4 d-flex justify-content-end">
        <a href="/categories" class="btn btn-secondary">Back</a>
    </div>
    <div class="my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deletedCategory as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="category-restore/{{ $item->slug }}" class="btn btn-primary">Restore</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection