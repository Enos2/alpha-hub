@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Edit News Article</h1>

    <form action="{{ route('news.update', $news) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $news->title) }}" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-1">Body</label>
            <textarea name="body" rows="6" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white" required>{{ old('body', $news->body) }}</textarea>
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Update</button>
    </form>
</div>
@endsection
