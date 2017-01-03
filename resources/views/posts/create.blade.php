<div class="panel panel-default">
    <div class="panel-body">
        <form action="{{ url('/posts') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('post_body') ? ' has-error' : '' }}">
                <textarea class="form-control" name="post_body" id="post_body" cols="60" rows="3" placeholder="Co słychać?">{{ old('post_body') }}</textarea>
                <hr>
                <button type="send" class="btn btn-info btn-sm pull-right" >Dodaj post</button>
                @if ($errors->has('post_body'))
                    <span class="help-block">
                        <strong>{{ $errors->first('post_body') }}</strong>
                    </span>
                @endif
            </div>
        </form>
    </div>
</div>