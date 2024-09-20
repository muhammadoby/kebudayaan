<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Culture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CultureGallery;
use Illuminate\Support\Facades\Validator;

class CultureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
        $this->middleware('permission:create post')->only('store');
        $this->middleware('permission:delete post')->only('update');
        $this->middleware('permission:edit post')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'List of culture',
            'data' => Culture::where('user_id', auth()->id())->get()
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images_title.*' => 'nullable|string',
            'images_description.*' => 'nullable|string',
            'tags' => 'nullable|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'code' => 400
            ], 400);
        }

        try {
            $culture = new Culture();
            $culture->name = $request->name;
            $culture->description = $request->description;
            $culture->user_id = $request->user()->id;
            $culture->save();

            if($request->hasFile('images')){
                foreach ($request->file('images') as $key => $file) {
                    $gallery = new CultureGallery();
                    $gallery->culture_id = $culture->id;
                    $gallery->title = $request->images_title[$key] ?? null;
                    $gallery->description = $request->images_description[$key] ?? null;
                    $gallery->image = $file->store('culture-gallery', 'public');
                    $gallery->save();
                }
            }

            if($request->tags){
                foreach ($request->tags as $tag) {

                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Culture data has been created',
                'data' => $culture,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 500
            ]);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
