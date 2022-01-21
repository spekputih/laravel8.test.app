@extends('layouts.app')
@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="">Name</label>
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" required value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                </span>    
            @endif
        </div>
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
            <label for="name" class="">Password</label>
            <input type="password" name="password" id="" class="form-control {{ $errors->has('password') ? 'is-invalid': '' }}" required>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                </span>    
            @endif
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="">Retype Password</label>
            <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid': '' }}" required>
            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>    
            @endif
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
@endsection