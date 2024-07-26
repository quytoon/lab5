<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre')->paginate(10);
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $movie = new Movie($request->except('poster'));

        if ($request->hasFile('poster')) {
            $movie->poster = $request->file('poster')->store('posters', 'public');
        }

        $movie->save();

        return redirect()->route('movies.index')->with('message', 'Thêm dữ liệu thành công');
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->fill($request->except('poster'));

        if ($request->hasFile('poster')) {
            // Delete old poster if exists
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            $movie->poster = $request->file('poster')->store('posters', 'public');
        }

        $movie->save();

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('movies.index')->with('message', 'Xóa dữ liệu thành công');
    }

    public function show($id)
    {
        $movie = Movie::with('genre')->findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $movies = Movie::where('title', 'LIKE', "%{$search}%")
            ->with('genre')
            ->paginate(10); // Use pagination for search results too
        return view('movies.index', compact('movies'));
    }
}
