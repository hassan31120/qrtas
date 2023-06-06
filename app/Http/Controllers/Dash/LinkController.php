<?php

namespace App\Http\Controllers\Dash;

use App\Models\Link;
use App\Models\Article;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LinkResource;
use App\Http\Resources\ArticleResource;

class LinkController extends Controller
{
    public function index()
    {
        $link = Link::findOrFail(1);
        return new LinkResource($link);
    }

    public function edit(Request $request)
    {
        $link = Link::findOrFail(1);
        // $request->validate([]);
        $data = $request->all();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filepath = 'storage/images/logo/' . date('Y') . '/' . date('m') . '/';
            $filename = $filepath . time() . '-' . $file->getClientOriginalName();
            $file->move($filepath, $filename);
            $data['logo'] = $filename;
        }
        $link->update($data);
        return 'success';
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'     => 'required|email',
            'number'    => 'required|numeric',
            'message'   => 'required',
        ]);
        $data = $request->all();
        Contact::create($data);
        return response()->json([
            'success' => true,
            'message' => 'contact has been sent successfully'
        ], 200);
    }

    public function articles()
    {
        $articles = Article::all();
        if (count($articles) > 0) {
            return response()->json([
                'success' => true,
                'articles' => ArticleResource::collection($articles)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such articles'
            ], 200);
        }
    }

    public function article($id)
    {
        $article = Article::find($id);
        if ($article) {
            return response()->json([
                'success' => true,
                'article' => new ArticleResource($article)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such article'
            ], 404);
        }
    }
}
