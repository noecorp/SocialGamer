
        <form class="clearfix" action="{{ url('/comments') }}" method="POST">
            {{ csrf_field() }}
                <div class="pull-left">
                    <img src="{{ url('user-avatar/' . Auth::id() . '/36') }}" alt="" class="img-responsive">
                </div>
                <div class="col-xs-10 col-sm-11">
                    <div style="margin-bottom:0px" class="form-group{{ $errors->has('post_' . $post->id .'_comment_body') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input class="form-control" type="text" name="post_{{ $post->id }}_comment_body" placeholder="Napisz komentarz" value="{{ old('post_' . $post->id .'_comment_body') }}">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <span class="input-group-btn">
                                <button type="send" class="btn btn-default">
                                    <i class="fa fa-mail-forward" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                        @if ($errors->has('post_' . $post->id .'_comment_body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('post_' . $post->id .'_comment_body') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
        </form>