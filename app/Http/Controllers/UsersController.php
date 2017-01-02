<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission', ['except' => ['show']]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        Carbon::setLocale('pl');
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
        
        if ($request->file('avatar')) {
            $avatar_path = 'public/users/' . $id . '/avatars';
            $upload_path = $request->file('avatar')->store($avatar_path);
            $avatar_filename = str_replace($avatar_path . '/', '', $upload_path);
            $user->avatar = $avatar_filename;
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
