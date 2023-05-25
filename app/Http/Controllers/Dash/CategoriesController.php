<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_special', 0)->paginate(6);
        if (count($categories) > 0) {
            return CategoriesResource::collection($categories);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such categories'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'title_en' => 'required',
            'image' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/images/categories/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image'] = $filename;
        }
        Category::create($data);
        return response()->json([
            'success' => true,
            'message' => 'cat has been added successfully'
        ], 200);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'success' => true,
                'cat' => new CategoriesResource($category)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such cat'
            ], 404);
        }
    }

    public function showCat($id)
    {
        Carbon::setLocale('ar');
        $sub = SubCategory::find($id);
        if ($sub) {
            $category = Category::where('id', $sub->cat_id)->first();
            return view('admin.categories.showCat', compact('sub', 'category'));
        } else {
            return view('admin.categories.showCat', compact('sub'));
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $request->validate([
                'title' => 'required',
                'title_en' => 'required'
            ]);

            $data = $request->except(['old-image']);

            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filepath = 'storage/images/categories/' . date('Y') . '/' . date('m') . '/';
                $filename = $filepath . time() . '-' . $file->getClientOriginalName();
                $file->move($filepath, $filename);
                if (request('old-image')) {
                    $oldpath = request('old-image');
                    if (File::exists($oldpath)) {
                        unlink($oldpath);
                    }
                }
                $data['image'] = $filename;
            }

            $category->update($data);
            return response()->json([
                'success' => true,
                'message' => 'cat has been updated successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such cat'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'cat has been deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such cat'
            ], 404);
        }
    }
}
