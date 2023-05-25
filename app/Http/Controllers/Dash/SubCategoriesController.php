<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoriesResource;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    public function index()
    {
        $subs = SubCategory::where('is_special', 0)->paginate(10);
        if (count($subs) > 0) {
            return SubCategoriesResource::collection($subs);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such subs'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'title_en' => 'required'
        ]);
        $data = $request->all();
        SubCategory::create($data);
        return response()->json([
            'success' => true,
            'message' => 'subcat has been added successfully'
        ], 200);
    }

    public function show($id)
    {
        $sub = SubCategory::find($id);
        if ($sub) {
            return response()->json([
                'success' => true,
                'sub' => new SubCategoriesResource($sub)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such subcat'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $sub = SubCategory::find($id);
        if ($sub) {
            $request->validate([
                'title' => 'required'
            ]);
            $data = $request->all();
            $sub->update($data);
            return response()->json([
                'success' => true,
                'message' => 'subcat has been updated successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such subcat'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $sub = SubCategory::find($id);
        if ($sub) {
            $sub->delete();
            return response()->json([
                'success' => true,
                'message' => 'subcat has been deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such subcat'
            ], 404);
        }
    }
}
