<!-- resources/views/movies/show.blade.php -->
@extends('app')

@section('content')
<div class="container">
    <h1>{{ $movie->title }}</h1>

    @if($movie->poster)
    <img src="{{ asset('storage/'.$movie->poster) }}" alt="poster" width="200">
    @endif

    <ul class="list-group mt-3">
        <li class="list-group-item"><strong>Thể loại:</strong> {{ $movie->genre->name }}</li>
        <li class="list-group-item"><strong>Introduction:</strong> {{ $movie->intro }}</li>
        <li class="list-group-item"><strong>Ngày phát hành:</strong> {{ $movie->release_date }}</li>
    </ul>

    <a href="{{ route('movies.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách </a>
</div>
@endsection
