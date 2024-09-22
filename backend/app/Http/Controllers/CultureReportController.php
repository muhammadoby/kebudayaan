<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CultureReport;
use App\Models\Culture;

class CultureReportController extends Controller
{
    public function index() {
        $cultureReports = CultureReport::with('user:id,name')->get();

        if(count($cultureReports) === 0) {
            return response()->json([
                'success' => false,
                'message' => 'no one have reported any of culture'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'culture report found',
            'data' => $cultureReports
        ], 200);
    }

    public function show(string $id) {
        $cultureReport = CultureReport::whereHas('culture', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();

        if(!$cultureReport) {
            return response()->json([
                'success' => false,
                'message' => "culture $id has no report",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "culture $id has report",
            'data' => $cultureReport
        ], 200);
    }

    public function store (Request $request) {
        $validate = Validator::make($request->all(), [
            'culture_id' => 'required | integer | exists:cultures,id',
            'report' => 'required'
        ]);

        if($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()
            ], 500);
        }

        try {
            $cultureReport = new CultureReport();
            $cultureReport->user_id = $request->user()->id;
            $cultureReport->culuture_id = $request->culuture_id;
            $cultureReport->report = $request->report;
            $cultureReport->save();

            return response()->json([
                'success' => true,
                'message' => 'new culture report has been added',
                'data' => CultureReport::with('user:id,name')->get()
            ], 200);
        } catch(\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id, Request $request) {
        $report = CultureReport::find($id);

        if(!$report) {
            return response()->json([
                'success' => false,
                'message' => "culture report $id not found"
            ], 404);
        }

        if($report->user_id === $request->user()->id) {
            $report->delete();
            
            return response()->json([
                'success' => true,
                'message' => "culture report $id successfuly deleted",
                'data' => CultureReport::with('user:id,name')->get()
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'you dont have access to delete this culture comment report'
        ], 403);
    }
}
