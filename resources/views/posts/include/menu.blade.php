<div class="pull-right">
    <div class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href=""><span class="fa fa-lg fa-caret-down"></span></a>
        @if ($post->user->id === Auth::id())
            <ul class="dropdown-menu">
                <li><a href="{{ url('/posts/' . $post->id . '/edit') }}">Edytuj</a></li>
                {{--<li><a href="{{ url('/posts/' . $post->id . '/edit') }}">Usuń</a></li>--}}
                <li>
                    <form method="POST" action="{{ url('/posts/' . $post->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn-link" onClick="return confirm('Czy napewno usunąć post?')">Usuń</button>
                    </form>
                </li>
            </ul>
        @endif
    </div>
</div>