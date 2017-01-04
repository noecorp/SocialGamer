@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="clearfix">
                            @include('posts.include.post-info')
                        </div>
                        <form action="{{ url('/posts/' . $post->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group{{ $errors->has('post_body') ? ' has-error' : '' }}">
                                <textarea class="form-control" name="post_body" id="post_body" cols="60" rows="5">{{ $post->body }}</textarea>
                                <button type="send" class="btn btn-primary btn-sm pull-right" style="margin-top: 10px;">Zapisz post</button>
                                @if ($errors->has('post_body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('post_body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
