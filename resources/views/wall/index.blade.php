@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('posts.create')

                @foreach($posts as $post)
                    @include('posts.show')
                @endforeach
            </div>
        </div>
    </div>
@endsection
