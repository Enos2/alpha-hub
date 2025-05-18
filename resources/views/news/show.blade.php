@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $news->title }}</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $news->created_at->format('F j, Y \a\t g:i A') }}</p>
        <div class="mt-6 text-gray-800 dark:text-gray-200">
            {{ $news->body }}
        </div>

        <div class="mt-6">
            <a href="{{ route('news.edit', $news) }}" class="text-blue-600 hover:underline">Edit</a>
        </div>
    </div>
</div>
@endsection
