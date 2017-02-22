@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Powiadomienia
                        <div class="pull-right">
                            <a class="btn btn-xs btn-primary {{ Auth::user()->unreadNotifications->count() > 0 ? '' : 'disabled' }}" href="{{ url('/notifications/read') }}">Oznacz wszystkie jako przeczytane</a>
                            <a class="btn btn-xs btn-primary {{ Auth::user()->Notifications->count() > 0 ? '' : 'disabled' }}" href="{{ url('/notifications/del') }}">Wyczyść powiadomienia</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Auth::user()->notifications->count() === 0)
                            <h4 class="text-center">Brak powiadomień.</h4>
                        @else


                            <ul class="list-group">
                                @foreach (Auth::user()->notifications as $notifications)
                                    @if(!$notifications->read_at)
                                        <form method="POST" action="{{ url('/notifications/'.$notifications->id) }}">
                                            <button type="submit" class="btn btn-xs btn-notify" style="width: 100%">
                                                <li class="list-group-item-info list-group-item">
                                                    {{ $notifications->data['message'] }}
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                </li>
                                                @if($notifications->data['from_user_id'])
                                                    <a style="position:absolute;margin-top:-28px;z-index:999;right:0;margin-right:45px;" class="btn btn-primary btn-xs pull-right" href="{{ url('/users/'.$notifications->data['from_user_id']) }}">Sprawdź</a>
                                                @endif
                                            </button>

                                        </form>
                                    @else
                                        <button class="btn btn-xs btn-notify" style="width: 100%">
                                            <li class="list-group-item list-group-item">
                                                {{ $notifications->data['message'] }}
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                            </li>
                                            @if($notifications->data['from_user_id'])
                                                <a style="position:absolute;margin-top:-28px;z-index:999;right:0;margin-right:45px;" class="btn btn-primary btn-xs pull-right" href="{{ url('/users/'.$notifications->data['from_user_id']) }}">Sprawdź</a>
                                            @endif
                                        </button>
                                    @endif
                                @endforeach
                            </ul>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
