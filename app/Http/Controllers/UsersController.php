<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('user_permission', ['except' => ['show']]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        setlocale(LC_TIME, 'pl_PL.UTF-8');
        Carbon::setLocale('pl');

        $user = User::findOrFail($id);
        $info = $user->profile;

        if (isAdmin()) {
            $posts = Post::with('comments.user')
                ->where('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->withTrashed()
                ->paginate(10);
        } else {
            $posts = Post::with('comments.user')
                ->where('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }




        return view('users.show', compact('user', 'posts', 'info'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $info = $user->profile;
        
        return view('users.edit', compact('user', 'info'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'location' => 'min:5',
            'platform' => 'min:2',
            'about'    => 'max:255',
        ], [
            'required' => 'Pole :attribute jest wymagane',
            'email'    => 'Wprowadź poprawny adres email',
            'min'      => 'Pole :attribute musi mieć minimum :min znaki',
            'max'      => 'Pole :attribute może mieć maksimum :max znaki',
            'unique'   => 'Ten adres email jest już zajęty',
        ]);
        
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $avatar = $request->file('avatar');
        
        if ($avatar) {

            $avatar_path = 'public/users/' . $id . '/avatars';
            $upload_path = $request->file('avatar')->store($avatar_path);

            $avatar_filename = str_replace($avatar_path . '/', '', $upload_path);
            $user->avatar = $avatar_filename;

            File::cleanDirectory(storage_path('app/' . $avatar_path));

            $img = Image::make($avatar);
            $img->fit(600)->save(storage_path('app/' . $avatar_path . '/orginal_' . $avatar_filename), 90);
            $img->fit(300)->save(storage_path('app/' . $avatar_path . '/300_' . $avatar_filename), 90);
            $img->fit(64)->save(storage_path('app/' . $avatar_path . '/64_' . $avatar_filename), 90);
        }

        $user->save();

        Auth::user()->profile()->update([
            'location' => $request->location,
            'platform' => $request->platform,
            'about'    => $request->about,
        ]);

        Session::flash('success', 'Profile updated.');

        return redirect()->back();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
