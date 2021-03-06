@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Lista znajomych <span class="label label-info">{{ $friends->count() }}</span>
                    </div>
                    <div class="panel-body">
                        @if ($friends->count() === 0)
                            <h4 class="text-center">Brak znajomych.</h4>
                        @else
                            <div class="row">
                                @foreach ($friends as $friend)
                                    <a href="{{ url('/users/' . $friend->id) }}">
                                        <div class="col-md-3">
                                            <img src="{{ avatar($friend->id, '300') }}" alt="" class="img-responsive">
                                            <p class="small text-center">{{ $friend->name }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-center">
                                {{--{{ $friends->links() }}--}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
