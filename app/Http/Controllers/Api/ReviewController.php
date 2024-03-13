<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\APIStoreReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index(APIStoreReviewRequest $request)
    {
        $data = $request->all();
        $reviews = Review::where('doctor_id', $data)->get();

        return response()->json([
            'success' => true,
            'results' => $reviews,
        ]);
    }

    public function store(APIStoreReviewRequest $request)
    {
        $review = Review::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Review send successfully!",
            'results' => $review
        ], 200);
    }
}
