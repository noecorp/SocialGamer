@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Edycja profilu użytkownika</div>
                    
                    <div class="panel-body">
                        <form action="{{ url('/users/' . $user->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="">Imię i nazwisko</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" value="{{ $user->email }}" name="email">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                                
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="">Płeć</label>
                                        <select id="gender" type="text" class="form-control" name="gender">
                                            <option value="m" @if ($user->gender == 'm') selected @endif>Mężczyzna</option>
                                            <option value="f" @if ($user->gender == 'f') selected @endif>Kobieta</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
    
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-10 col-sm-offset-1">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="">Hasło</label>--}}
                                        {{--<input type="password" class="form-control" value="{{ $user->password }}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
    
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Zapisz</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
