@if(Auth::check())

    @if(isLiked('comment_id', $comment->id))
        <form method="POST" action="{{ url('/likes/') }}" class="">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <button class="btn btn-primary btn-xs pull-left" type="submit"><i class="fa fa-thumbs-up"></i> {{ $comment->likes()->count() }}</button>
        </form>
    @else
        <form method="POST" action="{{ url('/likes') }}" class="">
            {{ csrf_field() }}
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <button class="btn btn-default btn-xs pull-left" type="submit"><i class="fa fa-thumbs-up"></i> {{ $comment->likes()->count() }}</button>
        </form>
    @endif

@else

    <button class="btn btn-default btn-xs pull-left" type="submit"><i class="fa fa-thumbs-up"></i> {{ $comment->likes()->count() }}</button>

@endif