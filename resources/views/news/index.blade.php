@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Latest News</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @auth
    <div class="mb-4">
        <a href="{{ route('news.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add News
        </a>
    </div>
    @endauth

    @forelse($news as $article)
        <div class="border border-gray-300 rounded p-4 mb-4">
            <h2 class="text-xl font-semibold">
                <a href="{{ route('news.show', $article) }}" class="text-blue-600 hover:underline">
                    {{ $article->title }}
                </a>
            </h2>
            <p class="text-gray-700 mt-2">{{ Str::limit($article->content, 150, '...') }}</p>
            <small class="text-gray-500">Published {{ $article->created_at->diffForHumans() }}</small>
        </div>
    @empty
        <p>No news articles found.</p>
    @endforelse

    <div class="mt-6">
        {{ $news->links() }}
    </div>
</div>
@endsection
