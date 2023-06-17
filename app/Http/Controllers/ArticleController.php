<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured_image' => $image_name
        ]);

        return 'Article berhasil disimpan';
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->title = $request->title;
        $article->content = $request->content;

        if ($article->featured_image && file_exists(storage_path('app/public/' . $article->featured_image))) {
            Storage::delete('public/' . $article->featured_image);
        }

        $image_name = $request->file('image')->store('images', 'public');
        $article->featured_image = $image_name;

        $article->save();

        return 'Artikel berhasil diubah';
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
    public function cetak_pdf()
    {
        $articles = Article::all();
        $pdf = PDF::loadView('articles.articles_pdf', ['articles' => $articles]);
        return $pdf->stream();
    }


}
