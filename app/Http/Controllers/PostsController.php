<?php

    namespace App\Http\Controllers;

    use App\Post;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class PostsController extends Controller
    {
        public function __construct()
        {
            $this->middleware('post_permission', ['except' => ['show', 'store']]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $this->validate($request, [
                'post_body' => 'required|min:5',
            ], [
                'required' => 'Musisz wpisać post.',
                'min'      => 'To pole musi mieć minimum :min znaków.',
            ]);

            Post::create([
                'user_id' => Auth::id(),
                'body'    => $request->post_body,
            ]);

            return back();
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            Carbon::setLocale('pl');

            if (isAdmin()) {
                $post = Post::findOrFail($id)->withTrashed();
            } else {
                $post = Post::findOrFail($id);
            }

            return view('posts.single', compact('post'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $post = Post::findOrFail($id);

            return view('posts.edit', compact('post'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $this->validate($request, [
                'post_body' => 'required|min:5',
            ], [
                'required' => 'Musisz wpisać post.',
                'min'      => 'To pole musi mieć minimum :min znaków.',
            ]);

            Post::findOrFail($id)->update([
                'body' => $request->post_body,
            ]);

            return back();
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $post = Post::findOrFail($id);
            $post->delete();
            $post->comments()->delete();

            return back();
        }
    }
