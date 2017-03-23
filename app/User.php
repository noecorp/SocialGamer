<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class User extends Authenticatable
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',
            'gender',
            'email',
            'password',
            'role_id',
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function myFriends()
        {
            return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', 1);
        }

        public function otherFriends()
        {
            return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id')->wherePivot('accepted', 1);
        }

        public function friends()
        {
            return $this->otherFriends->merge($this->myFriends);
        }

        public function posts()
        {
            return $this->hasMany('App\Post');
        }

        public function profile()
        {
            return $this->hasOne('App\Profile');
        }

        public function role()
        {
            return $this->belongsTo('App\Role');
        }

        public function likes()
        {
            return $this->hasMany('App\Like');
        }

    }
