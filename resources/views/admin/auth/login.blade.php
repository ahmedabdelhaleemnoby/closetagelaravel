@extends('admin.layout.auth')

@section('content')
<article class="sign-up">
    <h1 class="sign-up__title">Welcome back!</h1>
    <p class="sign-up__subtitle">Sign in to your account to continue</p>
    <form class="sign-up-form form" method="POST" action="{{ url('/admin/login') }}">
        {{ csrf_field() }}
        <label class="form-label-wrapper">
            <p class="form-label">Email</p>
            <input class="form-input" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">

            @if ($errors->has('email'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </label>
        <label class="form-label-wrapper">
            <p class="form-label">Password</p>
            <input class="form-input" type="password" name="password" placeholder="Enter your password">
            @if ($errors->has('password'))
            <span class="help-block text-danger ">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </label>
        <a class="link-info forget-link" href="{{ url('/admin/password/reset') }}">Forgot your password?</a>
        <label class="form-checkbox-wrapper">
            <input class="form-checkbox" type="checkbox">
            <span class="form-checkbox-label">Remember me next time</span>
        </label>
        <button class="form-btn primary-default-btn transparent-btn" type="submit">Sign in</button>
    </form>
</article>
@endsection
