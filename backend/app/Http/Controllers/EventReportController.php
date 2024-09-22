<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\EventReport;

class EventReportController extends Controller
{
    public function index() {
        $cultureCommentReports = EventReport::with('user:id,name')->get();

        if(count($cultureCommentReports) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'no one have reported any of event'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'event report found',
            'data' => $cultureCommentReports
        ], 200);
    }

    public function show(string $id) {
        $cultureReport = EventReport::whereHas('event', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();

        if(!$cultureReport) {
            return response()->json([
                'success' => false,
                'message' => "event $id has no report",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "event $id has report",
            'data' => $cultureReport
        ], 200);
    }

    public function store (Request $request) {
        $validate = Validator::make($request->all(), [
            'event_id' => 'required | integer | exists:events,id',
            'report' => 'required'
        ]);

        if($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()
            ], 500);
        }

        try {
            $eventReport = new EventReport();
            $eventReport->user_id = $request->user()->id;
            $eventReport->event_id = $request->event_id;
            $eventReport->report = $request->report;
            $eventReport->save();

            return response()->json([
                'success' => true,
                'message' => 'new event report has been added',
                'data' => EventReport::with('user:id,name')->get()
            ], 200);
        } catch(\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id, Request $request) {
        $comment = EventReport::find($id);

        if(!$comment) {
            return response()->json([
                'success' => false,
                'message' => "event $id not found"
            ], 404);
        }

        if($comment->user_id === $request->user()->id) {
            $comment->delete();
            
            return response()->json([
                'success' => true,
                'message' => "event report $id successfuly deleted",
                'data' => EventReport::with('user:id,name')->get()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'you dont have access to delete this event report'
        ], 403);
    }
}
