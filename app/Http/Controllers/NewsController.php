<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Display list of news on homepage
    public function index()
    {
        $news = News::latest()->paginate(5);
        return view('news.index', compact('news'));
    }

    // Show form to create a new news article
    public function create()
    {
        return view('news.create');
    }

    // Store new article in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'video_url' => $request->video_url,
            'user_id' => auth()->id(), // track which user added the news
        ]);

        return redirect()->route('home')->with('success', 'News article created successfully.');
    }

    // Show a single article
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    // Show form to edit existing news
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    // Update existing article
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $news->image = $request->file('image')->store('news_images', 'public');
        }

        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $news->image,
            'video_url' => $request->video_url,
        ]);

        return redirect()->route('home')->with('success', 'News article updated successfully.');
    }

    // Delete an article
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('home')->with('success', 'News article deleted.');
    }
}
