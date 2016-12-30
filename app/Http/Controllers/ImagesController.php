<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    
    public function user_avatar($id, $size)
    {
        $user = User::findOrFail($id);
        
        if (strpos($user->avatar, 'http') !== false) {
            $img = Image::make($user->avatar)->fit($size)->response('jpg', 80);
        } elseif (is_null($user->avatar) && $user->gender == 'm') {
            $img = Image::make(asset('images/default-avatar/man.png'))->fit($size)->response('png', 80);
        } elseif (is_null($user->avatar) && $user->gender == 'f') {
            $img = Image::make(asset('images/default-avatar/famale.png'))->fit($size)->response('png', 80);
        } else {
            $avatar_path = asset('storage/users/' . $id . '/avatars/' . $user->avatar);
            $img = Image::make($avatar_path)->fit($size)->response('jpg', 80);
        }
        
        return $img;
        
    }
}
