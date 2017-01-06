@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-3">
                @include('posts.create')

                @foreach($posts as $post)
                    @include('posts.show')
                @endforeach

                <div class="text-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
