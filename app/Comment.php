<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'post_id', 'user_id', 'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
