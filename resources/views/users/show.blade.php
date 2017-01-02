@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.sidebar')
    
            <div class="col-md-7">
                @if ($user->id === Auth::id())
                    @include('posts.create')
                @endif


                @foreach($posts as $post)
                    @include('posts.show')
                @endforeach

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="text-center">Użytkownik dołączył do Social Gamer {{ $user->created_at->diffForHumans() }}</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
