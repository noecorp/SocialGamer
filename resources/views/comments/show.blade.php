
<div class="clearfix comment {{ $comment->trashed() ? 'trashed' : "" }}" style="margin-top: 15px;">
    <div class="pull-left">
        <img src="{{ avatar($comment->user->id, '64') }}" width="36" alt="" class="img-responsive" style="margin-bottom: 5px;">
        @include('comments.include.likes')
    </div>

    <div class="col-xs-10 col-sm-11 comment-body">
        <div class="post-info pull-left" style="margin-top: -7px;">
            <p class="small" style="margin-bottom: 0px;"><strong><a href="{{ url('/users/' . $comment->user->id) }}">{{ $comment->user->name }}</a></strong> {{ $comment->body }}</p>
            @if( ($comment->created_at->diffInDays(Carbon\Carbon::now()->setLocale('pl')) < 1))
                <p class="small" style="margin-bottom: 0px;margin-top: -5px;"><span style="margin-right: 5px" class="fa fa-clock-o"></span>{{ $comment->created_at->diffForHumans() }}</p>
            @else
                @if($comment->created_at->format('Y') == Carbon\Carbon::now()->format('Y'))
                    <p class="small" style="margin-bottom: 0px;margin-top: -5px;"><span style="margin-right: 5px" class="fa fa-clock-o"></span>{{ $comment->created_at->formatLocalized('%d %B') }} o {{ $comment->created_at->format('H:m') }}</p>
                @else
                    <p class="small" style="margin-bottom: 0px;margin-top: -5px;"><span style="margin-right: 5px" class="fa fa-clock-o"></span>{{ $comment->created_at->formatLocalized('%d %B %Y') }} o {{ $comment->created_at->format('H:m') }}</p>
                @endif
            @endif

        </div>
    </div>

    <div class="pull-right">
        <div class="dropdown comment-menu">
            @if (belongsToUser($comment->user->id) || isAdmin())
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
