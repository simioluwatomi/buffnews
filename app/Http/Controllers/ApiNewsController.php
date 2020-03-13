<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Http\Resources\NewsCollection;

class ApiNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return NewsCollection
     */
    public function index()
    {
        $news = News::latest()->with('publisher', 'category')->paginate(12);

        return new NewsCollection($news);
    }

    public function show(News $news)
    {
        $news->load('publisher', 'category');

        return new NewsResource($news);
    }
}
