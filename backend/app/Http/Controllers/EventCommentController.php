<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventComment;
use Illuminate\Support\Facades\Validator;

class EventCommentController extends Controller
{
    public function index() {
        $eventComments = EventComment::with('user:id,name')->get();

        if(count($eventComments) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'this event doesnt have any comment yet'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'this event does have comment',
            'data' => $eventComments
        ], 200);
    }

    public function show(string $id) {
        $eventComment = EventComment::whereHas('culture', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        if(count($eventComment) === 0) {
            return response()->json([
                'success' => false,
                'message' => "culture $id has no comment",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "culture $id has comment",
            'data' => $eventComment
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
            $eventComment = new EventComment();
            $eventComment->culture_id = $request->culture_id ?? null;
            $eventComment->user_id = $request->user()->id;
            $eventComment->parent_id = $request->parent_id ?? null;
            $eventComment->comment = $request->comment;
            $eventComment->save();

            return response()->json([
                'success' => true,
                'message' => 'new event comment has been added',
                'data' => EventComment::with('user:id,name')->get()
            ], 200);
        } catch(\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id, Request $request) {
        $eventComment = EventComment::with('user')->find($id);

        if(!$eventComment) {
            return response()->json([
                'success' => false,
                'message' => "event comment $id not found"
            ], 404);
        }

        if($eventComment->user_id === $request->user()->id) {
            $eventComment->delete();
            
            return response()->json([
                'success' => true,
                'message' => "event comment report $id successfuly deleted",
                'data' => EventComment::with('user:id,name')->get()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'you dont have access to delete this comment'
        ], 403);
    }
}
