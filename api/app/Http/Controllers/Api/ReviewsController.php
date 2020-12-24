<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Reviews::all();
        return response()->json(['ratings' => $reviews], 200);
    }

    public function show($id)
    {
        $review = Reviews::find($id);
        return response()->json(['rating' => $review], 200);
    }

    public function store(Request $request)
    {
        try {
            $movieCount =  DB::table('movies AS m')
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

            return response()->json(['New rating' => $reviews], 201);
        } catch (Exception $e) {
            return response()->json(['Error' => $e], 501);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $reviews = Reviews::find($id);
            $reviews->rating = $request->rating;
            $reviews->movie_id = $request->movie_id;
            $reviews->save();

            return response()->json(['Edit rating' => $reviews], 200);
        } catch (Exception $e) {
            return response()->json(['Error' => $e], 501);
        }
    }

    public function destroy($id)
    {
        try {
            $reviews = Reviews::find($id);
            $reviews->delete();

            return response()->json(['Delete rating' => $reviews], 200);
        } catch (Exception $e) {
            return response()->json(['Error' => $e], 501);
        }
    }
}
