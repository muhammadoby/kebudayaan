<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Http\Request;
use App\Models\CultureComment;
use Illuminate\Support\Facades\Validator;

class CultureCommentController extends Controller
{
    public function index() {
        $cultureComments = CultureComment::with('user:id,name')->get();

        if(count($cultureComments) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'this culture doesnt have any comment yet'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'this culture does have comment',
            'data' => $cultureComments
        ], 200);
    }

    public function show(string $id) {
        $cultureComment = CultureComment::whereHas('culture', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        if(count($cultureComment) === 0) {
            return response()->json([
                'success' => false,
                'message' => "culture $id has no comment",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "culture $id has comment",
            'data' => $cultureComment
        ], 200);
    }

    public function store (Request $request) {
        $validate = Validator::make($request->all(), [
            'culture_id' => 'nullable | integer | exists:cultures,id',
            'parent_id' => 'nullable | integer | exists:culture_comments,id',
            'comment' => 'required'
        ]);

        if($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()
            ], 500);
        }

        try {
            $cultureComment = new CultureComment();
            $cultureComment->culture_id = $request->culture_id ?? null;
            $cultureComment->user_id = $request->user()->id;
            $cultureComment->parent_id = $request->parent_id ?? null;
            $cultureComment->comment = $request->comment;
            $cultureComment->save();

            return response()->json([
                'success' => true,
                'message' => 'new comment has been added',
                'data' => CultureComment::with('user:id,name')->get()
            ], 200);
        } catch(\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id, Request $request) {
        $comment = CultureComment::find($id);

        if(!$comment) {
            return response()->json([
                'success' => false,
                'message' => "culture comment $id not found"
            ], 404);
        }

        if($comment->user_id === $request->user()->id) {
            $comment->delete();
            
            return response()->json([
                'success' => true,
                'message' => "culture comment $id successfuly deleted",
                'data' => CultureComment::with('user:id,name')->get()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'you dont have access to delete this comment'
        ], 403);
    }
}
