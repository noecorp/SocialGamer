
        <form action="{{ url('/comments') }}" method="POST">
            {{ csrf_field() }}

                <div class="pull-left">
                    <img src="{{ url('user-avatar/' . Auth::id() . '/36') }}" alt="" class="img-responsive">
                </div>

                <div class="col-xs-10 col-sm-11">

                    <div style="margin-bottom:0px" class="form-group{{ $errors->has('comment_body') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input class="form-control" type="text" name="s" placeholder="Napisz komentarz">
                            <span class="input-group-btn">
                                <button type="send" class="btn btn-default">
                                    <i class="fa fa-send" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>

                        @if ($errors->has('comment_body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment_body') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>


        </form>
