<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CultureView;
use Illuminate\Support\Facades\Validator;

class CultureViewController extends Controller
{
    public function show(string $id,Request $reque) {
        $cultureViewQuery = CultureView::whereHas('culture', function ($query) use ($id) {
            $query->where('id', $id);
        });

        $cultureView = $cultureViewQuery->count();

        return response()->json([
            'success' => true,
            'message' => "culture $id has View",
            'data' => $cultureView
        ], 200);
    }

    public function add(Request $request) {
        $validate = Validator::make($request->all(), [
            'culture_id' => 'integer | exists:cultures,id'
        ]);

        if($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()
            ], 500);
        }

        try {
            $cultureView = new CultureView();
            $cultureView->user_id = $request->user()->id;
            $cultureView->culture_id = $request->culture_id;
            $cultureView->save();

            return response()->json([
                'success' => true,
                'message' => 'Culture View data has been added',
                'data' => $cultureView,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
