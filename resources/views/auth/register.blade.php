@extends('layouts.template')
@section('content')

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}

        <input id="name" type="text" class="" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                {{ $errors->first('name') }}
            @endif
                           
        <input id="email" type="email" class="" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                {{ $errors->first('email') }}
            @endif
                            
        <input id="password" type="password" class="" name="password" required>

            @if ($errors->has('password'))
                {{ $errors->first('password') }}
            @endif  
                          
        <input id="password-confirm" type="password" class="" name="password_confirmation" required>
                                
        <input type="submit" value="Register">
    </form>
               
@endsection
