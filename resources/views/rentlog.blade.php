@extends('layouts.mainlayout')

@section('title', 'Rent Log')

@section('content')
<h1>Rent Log</h1>

<div class="mt-4">
    <x-rent-log--table :rentlogs='$rentlogs'/>
</div>
@endsection