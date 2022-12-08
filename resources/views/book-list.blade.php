@extends('layouts.mainlayout')

@section('title', 'Book-list')

@section('content')
<form action="" method="get">
    <div class="row mb-3">
        <div class="col-12 col-sm-6 mb-3">
            <select name="category" id="catogory" class="form-select">
                <option value="">Select Category</option>
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6">
            <div class="input-group mb-3">
                <input type="text" name="title" class="form-control" placeholder="Search Book's Title" aria-describedby="basic-addon2">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </div>
</form>
<div>
    <div class="row">
        @foreach ($books as $item)
        <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
            <div class="card h-100">
                <div class="d-flex justify-content-center h-100 mt-1">
                    @if ($item->cover != '')
                        <img src="{{ asset('storage/cover/'.$item->cover) }}" class="card-img-top" draggable="false" style="width: 8rem;" loading="lazy">
                    @else
                        <img src="{{ asset('image/cover.jpg') }}" class="card-img-top" draggable="false"  style="width: 8rem;">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->book_code }}</h5>
                    <p class="card-text">{{ $item->title }}</p>
                    <p class="card-text text-end fw-bold {{ $item->status == 'in stock' ? 'text-success' : 'text-danger' }}">{{ $item->status }}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
