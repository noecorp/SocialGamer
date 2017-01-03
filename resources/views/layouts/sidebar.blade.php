<div class="col-md-3 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            {{ $user->name }}

        </div>

        <div class="panel-body">

            @if ($user->id === Auth::id())
                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-default btn-sm"
                   style="position:absolute;border-radius:0px;border:none;">Edytuj profil</a>
            @endif

            <img src="{{ url('user-avatar/' . $user->id . '/300') }}" alt="" class="img-responsive">

            <br>

            <p class="text-center">
                <a href="{{ url('/users/' . $user->id . '/friends') }}">Znajomi: </a><span class="label label-info">{{ $user->friends()->count() }}</span>
            </p>

            @if(Auth::check() && $user->id !== Auth::id())
                @if( ! friendship($user->id)->exists && ! friendship($user->id)->accepted)
                    <form class="text-center" method="POST" action="{{ url('/friends/' . $user->id) }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info">Zaproś do znajomych</button>
                    </form>
                @elseif(has_friend_invitation($user->id))
                        <form class="text-center" method="POST" action="{{ url('/friends/' . $user->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <button type="submit" class="btn btn-success">Dodaj do znajomych</button>
                        </form>
                @elseif(friendship($user->id)->exists && ! friendship($user->id)->accepted)
                    <p class="text-center">
                        <button type="submit" class="btn btn-info disabled">Zaproszenie wysłane</button>
                    </p>
                @elseif(friendship($user->id)->exists && friendship($user->id)->accepted)
                    <form class="text-center" method="POST" action="{{ url('/friends/' . $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger" onClick="return confirm('Czy napewno usunąć znajomego ?')">Usuń ze znajomych</button>
                    </form>
                @endif
            @endif

        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Informacje
        </div>

        <div class="panel-body">

            <p>Adres email: {{ $user->email }}</p>
            <p>Płeć:
                @if ($user->gender == 'm')
               Mężczyzna
                @else
               Kobieta
                @endif
            </p>

        </div>
    </div>
</div>