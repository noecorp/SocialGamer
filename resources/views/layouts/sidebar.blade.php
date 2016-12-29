<div class="col-md-3 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            {{ $user->name }}

        </div>

        <div class="panel-body">
            @if ($user->id === Auth::id())
                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-default btn-sm" style="position:absolute;border-radius:0px;border:none;">Edytuj profil</a>
            @endif
            <img src="{{ url('user-avatar/' . $user->id . '/300') }}" alt="" class="img-responsive">
            <br>
            @if(Auth::check() && $user->id !== Auth::id())
                <form class="text-center" method="POST" action="{{ url('/friends/' . $user->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info">Dodaj do znajomych</button>
                </form>
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