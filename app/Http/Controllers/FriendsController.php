<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Notifications\FriendRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);

        $friends = $user->friends();

        return view('friends.index', compact('user', 'friends'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param $friend_id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function add($friend_id)
    {
        if (!friendship($friend_id)->exists && !friendship($friend_id)->accepted) {
            Friend::create([
                'user_id'   => Auth::id(),
                'friend_id' => $friend_id,
            ]);

            User::findOrFail($friend_id)->notify(new FriendRequest());

        } else {
            $this->accept($friend_id);
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $friend_id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param int $id
     */
    public function accept($friend_id)
    {
        Friend::where([
            'user_id'   => $friend_id,
            'friend_id' => Auth::id(),
        ])->update([
            'accepted' => 1,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $friend_id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($friend_id)
    {
        Friend::where([
            'user_id'   => Auth::id(),
            'friend_id' => $friend_id,
        ])->orWhere([
            'user_id'   => $friend_id,
            'friend_id' => Auth::id(),
        ])->delete();

        return back();
    }
}
