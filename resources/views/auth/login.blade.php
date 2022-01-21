@extends('layouts.app')
@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email" class="">email</label>
            <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}" required value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>    
            @endif
        </div>
        <div class="form-group">
            <label for="password" class="">Password</label>
            <input type="password" name="password" id="" class="form-control {{ $errors->has('password') ? 'is-invalid': '' }}" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                </span>    
            @endif
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="remember" class="form-check-input" value="{{ old('remember') ? 'checked' : '' }}">
                <label for="remember" class="form-check-label">
                    Remember me
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
@endsection
