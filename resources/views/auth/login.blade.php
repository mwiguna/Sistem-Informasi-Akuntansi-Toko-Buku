@extends('layouts.template')
@section('content')

    <main class="col-12 main">
        <div class="col-12 main-log">
            <form class="col-4 form-log" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                @if ($errors->has('email'))
                    <div class="col-12 error"> {{ $errors->first('email') }} </div>
                @endif

                <input id="email" type="email" class="col-12 intext" name="email" value="{{ old('email') }}" placeholder="E-mail" required>           
                <input id="password" type="password" class="col-12 intext" name="password" placeholder="Password" required>

                <div class="col-6 checkbox"><input type="checkbox" name="remember"> Remember Me </div>
                <input type="submit" class="col-4 insubmit" value="Login">
            </form>
        </div>
    </main>
                            
@endsection
