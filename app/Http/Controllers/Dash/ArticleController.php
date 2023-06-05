<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest('id')->paginate(6);
        if (count($articles) > 0) {
            return ArticleResource::collection($articles);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such articles'
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'banner' => 'required',
            'desc' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filepath = 'storage/images/articles/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['image'] = $filename;
        }
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filepath = 'storage/images/articles/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['banner'] = $filename;
        }
        $article = Article::create($data);
        return response()->json([
            'success' => true,
            'message' => 'article has been added successfully',
        ], 200);
    }

    public function show($id)
    {
        $article = Article::find($id);
        if ($article) {
            return response()->json([
                'success' => true,
                'article' => new ArticleResource($article),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such article',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if ($article) {
            $request->validate([
                'title' => 'required',
                'desc' => 'required',
            ]);
            $data = $request->all();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filepath = 'storage/images/articles/' . date('Y') . '/' . date('m') . '/';
                $filename = $filepath . time() . '-' . $file->getClientOriginalName();
                $file->move($filepath, $filename);
                $data['image'] = $filename;
            }
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $filepath = 'storage/images/articles/' . date('Y') . '/' . date('m') . '/';
                $filename = $filepath . time() . '-' . $file->getClientOriginalName();
                $file->move($filepath, $filename);
                $data['banner'] = $filename;
            }
            $article->update($data);
            return response()->json([
                'success' => true,
                'message' => 'article has been updated successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such article',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
            return response()->json([
                'success' => true,
                'message' => 'article has been deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such article',
            ], 404);
        }
    }
}
