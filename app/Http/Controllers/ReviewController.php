<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::with('user:id,firstname,lastname')
            ->orderBy('created_at','desc')
            ->paginate(2);
        return view('review.index',compact('reviews'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ReviewRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $validated = $request->validated();
        Review::create($validated);

        return redirect()->route('review.index');
    }

}
