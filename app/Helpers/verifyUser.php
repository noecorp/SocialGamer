<?php

    function belongsToUser($user_id)
    {
        return Auth::check() && $user_id === Auth::id();
    }

    function isAdmin()
    {
        return Auth::check() && Auth::user()->role->type === 'admin';
    }