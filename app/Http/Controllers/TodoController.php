<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('activity_group_id')) {
            $todo = Todo::where('activity_group_id', $request->activity_group_id)->get();
        } else {
            $todo = Todo::all();
        }
        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => $todo
        ], 200);

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
        $validator = Validator::make($input, [
            'activity_group_id' => 'required',
            'title' => 'required',
        ], [
            'required' => ':attribute cannot be null',
        ], [
            'activity_group_id' => 'activity_group_id',
            'title' => 'title',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Bad Request',
                'message' => $validator->errors()->first(),
                'data' => []
            ], 400);
        }

        $input['is_active'] = true;
        $input['priority'] = 'very-high';
        $todo = Todo::create($input);
        return response()->json([
            'status' => 'Success',
            'message' => 'Success',
            'data' => $todo
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Success',
                'data' => $todo
            ], 200);
        } 
        return response()->json([
            'status' => 'Not Found',
            'message' => "Todo with ID $id Not Found",
            'data' => []
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $input = $request->all();
            // $input['is_active'] = 'true' ? $input['is_active'] = true : $input['is_active'] = false;
            $todo->update($input);
            return response()->json([
                'status' => 'Success',
                'message' => 'Success',
                'data' => $todo
            ], 200);
        }
        return response()->json([
            'status' => 'Not Found',
            'message' => "Todo with ID $id Not Found",
            'data' => []
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Success',
                'data' => $todo
            ], 200);
        }
        return response()->json([
            'status' => 'Not Found',
            'message' => "Todo with ID $id Not Found",
            'data' => []
        ], 404);
    }
}
