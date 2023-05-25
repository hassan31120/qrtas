<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannersResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::paginate(6);
        if (count($banners) > 0) {
            return BannersResource::collection($banners);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such banners'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required']
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/images/banners/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image'] = $filename;
        }

        Banner::create($data);

        return response()->json([
            'success' => true,
            'message' => 'banner has been added successfully'
        ], 200);
    }

    public function show($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            return response()->json([
                'success' => true,
                'banner' => new BannersResource($banner)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such banner'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $data = $request->except(['old-image']);
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filepath = 'storage/images/banners/' . date('Y') . '/' . date('m') . '/';
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
            $banner->update($data);
            return response()->json([
                'success' => true,
                'message' => 'banner has been updated successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such banner'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $banner->delete();
            return response()->json([
                'success' => true,
                'message' => 'banner has been deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such banner'
            ], 404);
        }
    }
}
