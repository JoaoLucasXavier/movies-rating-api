<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Movies::all(), Response::HTTP_OK);
    }

    public function getById($id): \Illuminate\Http\JsonResponse
    {
        $movie = DB::table('movies AS m')
            ->select(DB::raw('m.name, m.year, m.sinopse, m.duration, m.directors, m.writers, m.stars, m.image, r.rating'))
            ->join('reviews AS r', 'r.movie_id', '=', 'm.id')
            ->where('m.id', $id)
            ->get();
        return response()->json($movie, Response::HTTP_OK);
    }

    public function creat(Request $request): \Illuminate\Http\JsonResponse
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

            return response()->json($movies, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['Error' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(Request $request, $id): \Illuminate\Http\JsonResponse
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

            return response()->json(Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['Error' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id): Response
    {
        Movies::findOrFail($id)->delete();
        return Response()->noContent();
    }
}
