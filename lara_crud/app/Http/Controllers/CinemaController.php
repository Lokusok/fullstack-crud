<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function index()
    {
        return Cinema::query()->orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request)
    {
        $cinema = new Cinema();

        $data = json_decode($request->getContent(), true);

        $cinema->title = $data['title'];
        $cinema->description = $data['description'];
        $cinema->image_url = $data['imageUrl'];

        $cinema->save();

        return response()->json($cinema, 201);
    }

    public function show(Request $request, string $id)
    {
        $cinema = Cinema::find($id);

        if (! $cinema) {
            if ($request->acceptsJson()) {
                return response([
                    'message' => 'cinema was not found'
                ], 404);
            } else {
                abort(404, 'Cinema was not found');
            }
        }

        return $cinema;
    }

    public function update(Request $request, string $id)
    {
        $cinema = Cinema::findOrFail($id);

        $data = json_decode($request->getContent(), true);

        $cinema->title = $data['title'];
        $cinema->description = $data['description'];
        $cinema->image_url = $data['imageUrl'];

        $cinema->save();

        return response()->json($cinema, 201);
    }

    public function destroy(string $id)
    {
        $cinema = Cinema::findOrFail($id);

        $cinema->delete();

        return response(status: 204);
    }

    public function search(Request $request)
    {
        $query =  $request->query('q');
        $cinema = Cinema::query()->where('title', 'like', "%{$query}%")->get();

        return $cinema;
    }
}
