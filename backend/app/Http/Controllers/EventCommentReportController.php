<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventCommentReport;
use Illuminate\Support\Facades\Validator;

class EventCommentReportController extends Controller
{
    public function index() {
        $eventCommentReports = EventCommentReport::with('user:id,name')->get();

        if(count($eventCommentReports) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'no one have reported any of event comment'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'event comment report found',
            'data' => $eventCommentReports
        ], 200);
    }

    public function store (Request $request) {
        $validate = Validator::make($request->all(), [
            'event_comment_id' => 'required | integer | exists:event_comments,id',
            'report' => 'required'
        ]);

        if($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()
            ], 500);
        }

        try {
            $eventCommentReport = new EventCommentReport();
            $eventCommentReport->user_id = $request->user()->id;
            $eventCommentReport->culuturevent_comment_id = $request->culuturevent_comment_id;
            $eventCommentReport->report = $request->report;
            $eventCommentReport->save();

            return response()->json([
                'success' => true,
                'message' => 'new event comment report has been added',
                'data' => EventCommentReport::with('user:id,name')->get()
            ], 200);
        } catch(\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id, Request $request) {
        $comment = EventCommentReport::find($id);

        if(!$comment) {
            return response()->json([
                'success' => false,
                'message' => "event comment $id not found"
            ], 404);
        }

        if($comment->user_id === $request->user()->id) {
            $comment->delete();
            
            return response()->json([
                'success' => true,
                'message' => "event comment report $id successfuly deleted",
                'data' => EventCommentReport::with('user:id,name')->get()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'you dont have access to delete this event comment report'
        ], 403);
    }
}
