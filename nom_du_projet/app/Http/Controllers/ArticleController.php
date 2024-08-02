<?php

namespace App\Http\Controllers;

use App\Models\Articles_model;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Articles_model::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        return Articles_model::create($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Articles_model::find($id);
        if (!$article) {
            return response()->json(['message' => 'article non trouvée'], 404);

        }
        return $article;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Articles_model::find($id);
        if (!$article) {
            return response()->json(['message' => 'article non trouvée'], 404);
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $article->update($request->all());
        return $article;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Articles_model::find($id);
        if (!$article) {
            return response()->json(['message' => 'article non trouvée'], 404);
        }
        $article->delete();
        return response()->json(['message' => 'article supprimé avec succée']);
    }
}
