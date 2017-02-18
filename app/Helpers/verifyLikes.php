<?php

use App\Like;

/**
 * @param $id
 * @param $size
 * @return mixed
 */
function isLiked($id, $id2)
{
    return Auth::check() && Auth::user()->likes->contains($id, $id2);
}