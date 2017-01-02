@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="clearfix">
                                @include('posts.include.post-info')
                                @include('posts.include.menu')
                            </div>
                            <p class="">{{ $post->body }}</p>
                        </div>
                    </div>
            </div>

        </div>
    </div>
@endsection
