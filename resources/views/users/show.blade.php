@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        {{ $user->name }}
                    </div>
                    
                    <div class="panel-body">

                        <img src="{{ url('user-avatar/' . $user->id . '/300') }}" alt="" class="img-responsive">
                        <br>
                        @if ($user->id === Auth::id())
                                <p class="text-center">
                                    <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-primary btn-lg">Edytuj profil</a>
                                </p>
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


    
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left media-middle">
                                <a href="#">
                                    <img src="{{ url('user-avatar/1/64') }}" alt="" class="">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="{{ url('/users/1') }}"><p class="media-heading">Rafał Kucharski</p></a>
                                <p>Dzisiaj o 20:43</p>
                            </div>
                            <div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aut consequatur corporis dolor est eum in ipsam iusto labore magni maiores perferendis.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
