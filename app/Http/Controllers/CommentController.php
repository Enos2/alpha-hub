<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
            'commentable_type' => 'required|string', // 'news' or 'product'
            'commentable_id' => 'required|integer',
        ]);

        $modelClass = null;

        if ($request->commentable_type === 'news') {
            $modelClass = News::class;
        } elseif ($request->commentable_type === 'product') {
            $modelClass = Product::class;
        } else {
            return response()->json(['error' => 'Invalid commentable type'], 400);
        }

        $model = $modelClass::findOrFail($request->commentable_id);

        $comment = $model->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Comment posted successfully',
            'comment' => $comment
        ]);
    }
}
