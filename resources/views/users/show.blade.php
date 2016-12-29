@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('layouts.sidebar')
    
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
