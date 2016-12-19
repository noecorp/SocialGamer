<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class SearchUsersController extends Controller
{
    
    public function users()
    {
        $search_phrase = Input::get('s');
        $results_search = User::where('name', 'like', '%' . $search_phrase . '%')->paginate(8);
        return view('search.users', compact('results_search'));
    }
}
