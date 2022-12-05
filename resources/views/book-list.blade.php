@extends('layouts.mainlayout')

@section('title', 'Book-list')

@section('content')
<div>
    <div class="row">
        @foreach ($books as $item)
        <div class="col-lg-3 col-md-4 col-sm-12 mb-4">
            <div class="card h-100">
                <div class="d-flex justify-content-center h-100">
                    @if ($item->cover != '')
                        <img src="{{ asset('storage/cover/'.$item->cover) }}" class="card-img-top" draggable="false" style="width: 8rem;">
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
