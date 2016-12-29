@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Edycja profilu użytkownika</div>
    
                    <img src="{{ url('user-avatar/' . $user->id . '/600') }}" alt="" class="img-responsive">
                    
                    <div class="panel-body">
                        <form action="{{ url('/users/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
    
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                        <label for="">Avatar</label>
                                        <input type="file" class="form-control" palceholder="Wybierz plik" name="avatar">
                                        @if ($errors->has('avatar'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
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
                                        <p class="text-center">
                                            <button type="submit" class="btn btn-info btn-lg">Zapisz zmiany</button>
                                        </p>
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
