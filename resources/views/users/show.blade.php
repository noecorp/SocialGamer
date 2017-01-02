@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.sidebar')
    
            <div class="col-md-7">
                @include('posts.create')

                @foreach($posts as $post)
                    @include('posts.user-show')
                @endforeach
            </div>

        </div>
    </div>
@endsection
