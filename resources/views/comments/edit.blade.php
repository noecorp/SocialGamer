@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{ url('/comments/' . $comment->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group{{ $errors->has('comment_body') ? ' has-error' : '' }}">
                                <textarea class="form-control" name="comment_body" id="comment_body" cols="60" rows="5">{{ $comment->body }}</textarea>
                                <button type="send" class="btn btn-primary btn-sm pull-right" style="margin-top: 10px;">Zapisz komentarz</button>
                                @if ($errors->has('comment_body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment_body') }}</strong>
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
