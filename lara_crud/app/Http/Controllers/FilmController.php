<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        return Film::query()->orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request)
    {
        $film = new Film();

        $data = json_decode($request->getContent(), true);

        $film->title = $data['title'];
        $film->description = $data['description'];
        $film->image_url = $data['imageUrl'];

        $film->save();

        return response()->json($film, 201);
    }

    public function show(Request $request, string $id)
    {
        $film = Film::find($id);

        if (! $film) {
            if ($request->acceptsJson()) {
                return response([
                    'message' => 'film was not found'
                ], 404);
            } else {
                abort(404, 'film was not found');
            }
        }

        return $film;
    }

    public function update(Request $request, string $id)
    {
        $film = Film::findOrFail($id);

        $data = json_decode($request->getContent(), true);

        $film->title = $data['title'];
        $film->description = $data['description'];
        $film->image_url = $data['imageUrl'];

        $film->save();

        return response()->json($film, 201);
    }

    public function destroy(string $id)
    {
        $film = Film::findOrFail($id);

        $film->delete();

        return response(status: 204);
    }

    public function search(Request $request)
    {
        $query =  $request->query('q');
        $film = Film::query()->where('title', 'like', "%{$query}%")->get();

        return $film;
    }
}
