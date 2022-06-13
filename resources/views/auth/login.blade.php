@extends('layout.master-mini')
@section('content')

<div class="content-wrapper d-flex align-items-center auth px-0">
  <div class="row w-100 mx-0">
    <div class="col-lg-4 mx-auto">
      <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo">
          <h4 class="text-primary">Sistem Penentuan Restitusi</h4>
        </div>
        <h4>Hello! let's get started</h4>
        <h6 class="fw-light">Sign in to continue.</h6>
        <form class="pt-3"  method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <input type="email" class="form-control form-control-lg  {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
            @if($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-lg  @error('password') is-invalid @enderror" id="password"  name="password" required autocomplete="current-password" placeholder="Password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a>
          </div>
          <div class="my-2 d-flex justify-content-between align-items-center"></div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection