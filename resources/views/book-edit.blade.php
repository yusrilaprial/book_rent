@extends('layouts.mainlayout')

@section('title', 'Edit Book')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <h1>Edit Book</h1>
    <div class="mt-4 col-sm-12 col-md-6 col-lg-6">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/book-edit/{{ $book->slug }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mt-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" name="book_code" id="book_code" class="form-control" placeholder="Book Code"
                    value="{{ $book->book_code }}" required>
            </div>
            <div class="mt-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Book Title"
                    value="{{ $book->title }}" required>
            </div>
            <div class="mt-3">
                <label for="image" class="form-label">Cover</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="mt-3">
                <label for="currenCategory" class="form-label">Current Cover</label>
                <div>
                    @if ($book->cover != '')
                        <img src="{{ asset('storage/cover/' . $book->cover) }}" alt="{{ $book->title }}" width="150px">
                    @else
                        <img src="{{ asset('image/cover.jpg') }}" alt="cover" width="150px">
                    @endif
                </div>
            </div>
            <div class="mt-3">
                <label for="category" class="form-label">Category</label>
                <select name="categories[]" id="category" class="form-select select-multiple" multiple>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label for="currenCategory" class="form-label">Current Category</label>
                <ul>
                    @foreach ($book->categories as $item)
                        <li>{{ $item->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3">
                <a href="/books" class="btn btn-secondary me-3">Back</a>
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>
@endsection
