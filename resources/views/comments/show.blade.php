
<div class="clearfix comment" style="margin-top: 15px;">
    <img src="{{ avatar($comment->user->id, '64') }}" width="36" alt="" class="img-responsive pull-left">
    <div class="col-xs-10 col-sm-11 comment-body">
        <div class="post-info pull-left" style="margin-top: -7px;">
            <p class="small" style="margin-bottom: 0px;"><strong><a href="{{ url('/users/' . $comment->user->id) }}">{{ $comment->user->name }}</a></strong> {{ $comment->body }}</p>
            <p class="small" style="margin-bottom: 0px;margin-top: -5px;"><span style="margin-right: 5px" class="fa fa-clock-o"></span>{{ $comment->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <div class="pull-right">
        <div class="dropdown comment-menu">
            @if ($comment->user->id === Auth::id())
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="fa fa-lg fa-angle-down"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/comments/' . $comment->id . '/edit') }}">Edytuj</a></li>
                    <li>
                        <form method="POST" action="{{ url('/comments/' . $comment->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn-link" onClick="return confirm('Czy napewno usunąć komentarz?')">Usuń</button>
                        </form>
                    </li>
                </ul>
            @endif
        </div>
    </div>

</div>
