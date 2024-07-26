@extends('app')

@section('content')
<div class="container">
    <h1>Thêm mới phim</h1>
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="poster">Poster</label>
            <input type="file" class="form-control-file" id="poster" name="poster" onchange="previewImage(this)">
            <img id="image-preview" src="#" alt="Image Preview" style="display:none; max-width: 200px; margin-top: 10px;">
        </div>
        <div class="form-group">
            <label for="intro">Intro</label>
            <input type="text" class="form-control" id="intro" name="intro" required>
        </div>
        <div class="form-group">
            <label for="release_date">Ngày phát hành</label>
            <input type="date" class="form-control" id="release_date" name="release_date" required>
        </div>
        <div class="form-group">
            <label for="genre_id">Thể loại</label>
            <select class="form-control" id="genre_id" name="genre_id" required>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
