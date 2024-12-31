<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function index()
    {
        return Cinema::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $query =  $request->query('q');
        $cinema = Cinema::query()->where('title', 'like', "%{$query}%")->get();

        return $cinema;
    }
}
