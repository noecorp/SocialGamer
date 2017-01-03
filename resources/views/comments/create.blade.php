
        <form action="{{ url('/comments') }}" method="POST">
            {{ csrf_field() }}

                <div class="pull-left">
                    <img src="{{ url('user-avatar/' . Auth::id() . '/30') }}" alt="" class="img-responsive">
                </div>

                <div class="col-sm-11">

                    <div class="form-group{{ $errors->has('comment_body') ? ' has-error' : '' }}">
                        <input style="height: 30px;" class="form-control" name="comment_body"value="{{ old('comment_body') }}" placeholder="Napisz komentarz">
                        <button type="send" class="add-comment btn btn-info btn-sm pull-right">Dodaj</button>
                        @if ($errors->has('comment_body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment_body') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>


        </form>
