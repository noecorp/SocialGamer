<?php

use App\Friend;

/**
 * @param $friend_id
 * @return mixed
 */
function friendship($friend_id)
{
    $friend_query = Friend::where([
        'user_id'   => Auth::id(),
        'friend_id' => $friend_id,
    ])->orWhere([
        'user_id'   => $friend_id,
        'friend_id' => Auth::id(),
    ])->first();

    $friendship = new stdClass();

    $friendship->exists = false;
    $friendship->accepted = false;

    if (!is_null($friend_query)) {
        $friendship->exists = true;
        $friendship->accepted = $friend_query->accepted;
    }

    return $friendship;
}

function has_friend_invitation($friend_id)
{
    return Friend::where([
        'user_id'   => $friend_id,
        'friend_id' => Auth::id(),
        'accepted'  => 0,
    ])->exists();
}