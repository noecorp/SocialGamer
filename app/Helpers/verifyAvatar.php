<?php

    use App\User;

    /**
     * @param $id
     * @param $size
     *
     * @return mixed
     */
    function avatar($id, $size)
    {
        $user = User::findOrFail($id);

        if (is_null($user->avatar)) {
            if ($user->gender == 'm') {
                $img = asset('images/default-avatar/' . $size . '_male.png');
            } elseif ($user->gender == 'f') {
                $img = asset('images/default-avatar/' . $size . '_female.png');
            }
        } else {
            $img = asset('storage/users/' . $id . '/avatars/' . $size . '_' . $user->avatar);
        }

        return $img;
    }