<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CultureCommentReport;
use Illuminate\Support\Facades\Validator;

class CultureCommentReportController extends Controller
{
    public function index() {
        $cultureCommentReports = CultureCommentReport::with('user:id,name')->get();

        if(count($cultureCommentReports) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'no one have reported any of culture comment'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'culture comment report found',
            'data' => $cultureCommentReports
        ], 200);
    }

    public function store (Request $request) {
        $validate = Validator::make($request->all(), [
            'culture_comment_id' => 'required | integer | exists:culture_comments,id',
            'report' => 'required'
        ]);

        if($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()
            ], 500);
        }

        try {
            $cultureCommentReport = new CultureCommentReport();
            $cultureCommentReport->user_id = $request->user()->id;
            $cultureCommentReport->culuture_comment_id = $request->culuture_comment_id;
            $cultureCommentReport->report = $request->report;
            $cultureCommentReport->save();

            return response()->json([
                'success' => true,
                'message' => 'new culture comment report has been added',
                'data' => CultureCommentReport::with('user:id,name')->get()
            ], 200);
        } catch(\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id, Request $request) {
        $commentReport = CultureCommentReport::find($id);

        if(!$commentReport) {
            return response()->json([
                'success' => false,
                'message' => "culture comment $id not found"
            ], 404);
        }

        if($commentReport->user_id === $request->user()->id) {
            $commentReport->delete();
            
            return response()->json([
                'success' => true,
                'message' => "culture comment report $id successfuly deleted",
                'data' => CultureCommentReport::with('user:id,name')->get()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'you dont have access to delete this culture comment report'
        ], 403);
    }
}
