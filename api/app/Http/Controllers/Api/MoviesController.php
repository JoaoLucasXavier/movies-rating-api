<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movies;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index()
    {
        $movies =  Movies::all();
        return response()->json(['Movies' => $movies], 200);
    }

    public function show($id)
    {
        $movie =  DB::table('movies AS m')
            ->select(DB::raw( 'm.name, m.year, m.sinopse, m.duration, m.directors, m.writers, m.stars, m.image, r.rating' ))
            ->join('reviews AS r', 'r.movie_id', '=', 'm.id')
            ->where('m.id', $id)
            ->get();
        return response()->json(['Movie' => $movie], 200);
    }

    public function store(Request $request)
    {
        try {
            $movies = new Movies();
            $movies->name = $request->name;
            $movies->year = $request->year;
            $movies->sinopse = $request->sinopse;
            $movies->duration = $request->duration;
            $movies->directors = $request->directors;
            $movies->writers = $request->writers;
            $movies->stars = $request->stars;
            $movies->image = $request->image;
            $movies->save();

            return response()->json(['New movie' => $movies], 201);
        } catch (Exception $e) {
            return response()->json(['Error' => $e], 501);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $movies = Movies::find($id);
            $movies->name = $request->name;
            $movies->year = $request->year;
            $movies->sinopse = $request->sinopse;
            $movies->duration = $request->duration;
            $movies->directors = $request->directors;
            $movies->writers = $request->writers;
            $movies->stars = $request->stars;
            $movies->image = $request->image;
            $movies->save();

            return response()->json(['Edit rating' => $movies], 200);
        } catch (Exception $e) {
            return response()->json(['Error' => $e], 501);
        }
    }

    public function destroy($id)
    {
        try {
            $movies = Movies::find($id);
            $movies->delete();

            return response()->json(['Delete rating' => $movies], 200);
        } catch (Exception $e) {
            return response()->json(['Error' => $e], 501);
        }
    }
}
