<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except('index');
        $this->middleware('permission:create tag')->only('store');
        $this->middleware('permission:delete tag')->only('destroy');
        $this->middleware('permission:edit tag')->only('update');
    }
    /**
     * Show all tags
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'List of tags',
            'data' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Create new tag.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'code' => 400
            ], 400);
        }

        try {
            $tag = new Tag();
            $tag->name = $request->name;
            $tag->save();

            return response()->json([
                'status' => true,
                'message' => 'Tag data has been created',
                'data' => $tag,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update tag data.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'code' => 400
            ], 400);
        }

        try {
            $tag = Tag::find($id);

            if(!$tag) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tag not found',
                    'code' => 404
                ], 404);
            }

            $tag->name = $request->name;
            $tag->save();

            return response()->json([
                'status' => true,
                'message' => 'Tag data has been updated',
                'data' => $tag,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    /**
     * Remove tag.
     */
    public function destroy(string $id)
    {
        try {
            $tag = Tag::find($id);

            if(!$tag) {
                return response()->json([
                    'status' => false,
                    'message' => 'Tag not found',
                    'code' => 404
                ], 404);
            }

            $tag->delete();

            return response()->json([
                'status' => true,
                'message' => 'Tag data has been deleted',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 500
            ], 500);
        }
    }
}
