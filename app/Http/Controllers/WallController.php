<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
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
        setlocale(LC_TIME, 'pl_PL.UTF-8');

        Carbon::setLocale('pl');

        $friends = Auth::user()->friends();

        $friends_ids = [];
        $friends_ids[] = Auth::id();

        foreach ($friends as $friend) {
            $friends_ids[] = $friend->id;
        }

        if (isAdmin()) {
            $posts = Post::with('comments.user')
                ->with('likes')
                ->with('comments.likes')
                ->whereIn('user_id', $friends_ids)
                ->orderBy('created_at', 'desc')
                ->withTrashed()
                ->paginate(10);
        } else {
            $posts = Post::with('comments.user')
                ->with('likes')
                ->with('comments.likes')
                ->whereIn('user_id', $friends_ids)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }



        return view('wall.index', compact('posts'));
    }
}
