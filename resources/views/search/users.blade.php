@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Wynik wyszukiwania
                    </div>
                    <div class="panel-body">
                        @if ($results_search->count() === 0)
                            <h4 class="text-center">Brak wyników wyszukiwania.</h4>
                        @else
                            <div class="row">
                                @foreach ($results_search as $user)
                                    <a href="{{ url('/users/' . $user->id) }}">
                                        <div class="col-md-3">
                                            <img src="{{ avatar($user->id, '300') }}" alt="" class="img-responsive">
                                            <p class="small text-center">{{ $user->name }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-center">
                                {{ $results_search->appends(['s' => $search_phrase])->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
