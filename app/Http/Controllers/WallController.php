<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WallController extends Controller
{
    /**
     * WallController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $friends = Auth::user()->friends();

        $friends_ids = [];
        $friends_ids[] = Auth::id();

        foreach ($friends as $friend) {
            $friends_ids[] = $friend->id;
        }

        $posts = Post::whereIn('user_id', $friends_ids)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('wall.index', compact('posts'));
    }
}
