@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-3">
                @include('posts.show')
            </div>
        </div>
    </div>
@endsection
