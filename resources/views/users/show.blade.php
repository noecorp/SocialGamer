@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Twój profil
                        @if ($user->id === Auth::id())
                            <a href="{{ url('/users/' . $user->id . '/edit') }}" class="pull-right">Edycja</a>
                        @endif
                    </div>
                    
                    <div class="panel-body">
                        
                        @if(!empty($user->avatar))
                            <img src="{{ url('user-avatar/' . $user->id . '/300') }}" alt="" class="img-responsive">
                        @else
                            <img src="{{ asset('storage/default-avatar.jpg') }}" alt="" class="img-responsive">
                        @endif
                        
                        <h2><a href="{{ url('/users/' . $user->id) }}">{{ $user->name }}</a></h2>
                        <p>{{ $user->email }}</p>
                        <p>
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
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad commodi cupiditate, eius ex exercitationem fugiat harum ipsam iusto laboriosam maxime neque nostrum quae qui reiciendis repudiandae similique unde voluptate?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
