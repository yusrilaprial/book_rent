@extends('layouts.mainlayout')

@section('title', 'Edit Category')

@section('content')
    <h1>Edit Category</h1>
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
        <form action="/category-edit/{{ $category->slug }}" method="post">
            @csrf
            @method('put')
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
            </div>
            <div class="mt-3">
                <a href="/categories" class="btn btn-secondary me-3">Back</a>
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection