<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => Activity::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if ($input['title']) {
            $activity = Activity::create($input);
            return response()->json([
                'status' => 'Success',
                'message' => 'Success',
                'data' => $activity
            ]);
        }
        return response()->json([
            'status' => 'Bad Request',
            'message' => 'title cannot be null',
            'data' => []
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Success',
                'data' => $activity
            ]);
        } 
        return response()->json([
            'status' => 'Not Found',
            'message' => "Activity with ID $id Not Found",
            'data' => []
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            if ($request->title) {
                $activity->update($request->all());
                return response()->json([
                    'status' => 'Success',
                    'message' => 'Success',
                    'data' => $activity
                ]);
            }
            return response()->json([
                'status' => 'Bad Request',
                'message' => 'title cannot be null',
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 'Not Found',
            'message' => "Activity with ID $id Not Found",
            'data' => []
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            $activity->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Success',
                'data' => $activity
            ]);
        } 
        return response()->json([
            'status' => 'Not Found',
            'message' => "Activity with ID $id Not Found",
            'data' => []
        ]);
    }
}
