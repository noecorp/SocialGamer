<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        Carbon::setLocale('pl');

        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        return view('users.show', compact('user', 'posts'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        
        return view('users.edit', compact('user'));
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
            $img->fit(500)->save(storage_path('app/' . $avatar_path . '/orginal_' . $avatar_filename), 90);
            $img->fit(300)->save(storage_path('app/' . $avatar_path . '/300_' . $avatar_filename), 90);
            $img->fit(64)->save(storage_path('app/' . $avatar_path . '/64_' . $avatar_filename), 90);
        }
        
        $user->save();
        
        return back();
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
