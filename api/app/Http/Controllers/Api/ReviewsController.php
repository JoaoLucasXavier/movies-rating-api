<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function getAll(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Reviews::all(), Response::HTTP_OK);
    }

    public function getById($id): \Illuminate\Http\JsonResponse
    {
        return response()->json(Reviews::find($id), Response::HTTP_OK);
    }

    public function creat(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $movieCount = DB::table('movies AS m')
                ->where('m.id', $request->movie_id)
                ->count();

            $reviews = Reviews::where('movie_id', $request->movie_id)->first();

            if ($movieCount > 0 && !is_null($reviews)) {
                $reviews->delete();
            }

            $reviews = new Reviews();
            $reviews->rating = $request->rating;
            $reviews->movie_id = $request->movie_id;
            $reviews->save();

            return response()->json($reviews, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['Error:' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit(Request $request, $id): Response
    {
        Reviews::findOrFail($id)->update($request->all());
        return Response()->noContent();
    }

    public function delete($id)
    {
        Reviews::findOrFail($id)->delete();
        return Response()->noContent();
    }
}
