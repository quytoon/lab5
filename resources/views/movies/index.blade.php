@extends('app')

@section('content')
<div class="container">
    <h1>Danh sách phim</h1>
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <!-- Search Form -->
    <form action="{{ route('movies.search') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm phim..." value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </div>
        </div>
    </form>
    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Thêm mới phim</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Poster</th>
                <th>Tiêu đề</th>
                <th>Intro</th>
                <th>Ngày phát hành</th>
                <th>Thể loại</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)

            <tr>
                
                <td>
                    @if ($movie->poster)
                        <img src="{{ asset('storage/'.$movie->poster) }}" alt="{{ $movie->title }}" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->intro }}</td>
                <td>{{ $movie->release_date }}</td>
                <td>{{ $movie->genre->name }}</td>
                <td>
                    <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
                    <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $movies->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
