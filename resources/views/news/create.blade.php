@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Create News Article</h1>

    <form action="{{ route('news.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-1">Title</label>
            <input type="text" name="title" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-1">Body</label>
            <textarea name="body" rows="6" class="w-full px-4 py-2 border rounded-md dark:bg-gray-800 dark:text-white" required></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Publish</button>
    </form>
</div>
@endsection
