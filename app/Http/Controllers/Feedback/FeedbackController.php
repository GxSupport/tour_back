<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\ActiveRequest;
use App\Http\Requests\Feedback\StoreRequest;
use App\Http\Resources\Feedback\FeedbackResource;
use App\Models\Feedback;

/**
 * @group Feedback
 */
class FeedbackController extends Controller
{

    /**
     *  feedback list
     */
    public function index()
    {
        $feed = Feedback::all();
        return new FeedbackResource($feed);
    }

    /**
     *  feedback save
     */
    public function store(StoreRequest $request)
    {
        $feed = Feedback::create($request->validated());
        return new FeedbackResource($feed);
    }

    /**
     *  feedback ni id orqali olish
     *  @urlParam id integer required. feedback id
     */
    public function show($id)
    {
        $feed = Feedback::findOrFail($id);
        return new FeedbackResource($feed);
    }

    /**
     *  feedback delete
     *  @urlParam id integer required. feedback id
     */
    public function destroy($id)
    {
        $feed = Feedback::findOrFail($id);
        $feed->delete();
        return success();
    }

    /**
     *  feedback active-disactive
     *  @urlParam id integer required. feedback id
     */
    public function active($id,ActiveRequest $request)
    {
        $feed = Feedback::findOrFail($id);
        $feed->update(['is_active'=>$request->is_active]);
        return new FeedbackResource($feed);
    }
}
