@extends('layouts.auth')

@section('content')
<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
  <div class="d-flex flex-center flex-column flex-lg-row-fluid">
    <div class="w-lg-500px p-10">
      <form class="form w-100" action="{{ route('login') }}" method="POST" id="loginForm">
        @csrf
        <div class="mb-11">
          <h1 class="text-gray-900 fw-bolder mb-3 fs-1">Masuk</h1>
          <div class="text-gray-500 fw-semibold fs-6">Silahkan masukan identitas anda</div>
        </div>

        @if (session()->has('success'))
        <div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row align-items-center p-5 mb-10">
          <i class="ki-duotone ki-notification-bing fs-2hx text-success me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
          <div class="d-flex flex-column pe-0 pe-sm-10">
              <span>{{ session('success') }}</span>
          </div>
          <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
              <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
          </button>
        </div>
        @elseif (session()->has('warning'))
        <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row align-items-center p-5 mb-10">
          <i class="ki-duotone ki-notification-bing fs-2hx text-warning me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
          <div class="d-flex flex-column pe-0 pe-sm-10">
              <span>{{ session('warning') }}</span>
          </div>
          <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
              <i class="ki-duotone ki-cross fs-1 text-warning"><span class="path1"></span><span class="path2"></span></i>
          </button>
        </div>
        @elseif (session()->has('error'))
        <div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row align-items-center p-5 mb-10">
          <i class="ki-duotone ki-notification-bing fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
          <div class="d-flex flex-column pe-0 pe-sm-10">
              <span class="fw-semibold">{{ session('error') }}</span>
          </div>
          <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
              <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>
          </button>
        </div>
        @endif

        <div class="fv-row mb-8">
          <input type="text" placeholder="Username or Email" name="username_or_email" autocomplete="off" class="form-control bg-transparent @error('username_or_email') is-invalid @enderror" value="{{ old('username_or_email') }}" />
          @error('username_or_email')
          <div class="text-sm text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="fv-row mb-3">
          <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent"  />
          @error('password')
          <div class="text-sm text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
          <div></div>
          <a href="{{ route('forgot') }}" class="link-primary">Lupa Password ?</a>
        </div>
        <div class="d-grid mb-10">
          <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
            <span class="indicator-label">Masuk</span>
            <span class="indicator-progress" style="display: none;">Loading... 
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
          </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Belum punya akun? 
        <a href="#" class="link-primary" data-bs-toggle="modal" data-bs-target="#register">Daftar</a></div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="register">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title">Daftar Sebagai</h3>
              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                  <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
              </div>
          </div>

          <div class="modal-body">
            <a href="{{ route('register.district') }}" class="btn btn-primary w-100 btn-block">Kecamatan</a>
            <a href="{{ route('register.village') }}" class="btn btn-light-primary w-100 btn-block mt-3">Kelurahan</a>
          </div>
      </div>
  </div>
</div>

@endsection

@section('script')
<script>
  document.getElementById('loginForm').addEventListener('submit', function() {
    var submitButton = document.getElementById('kt_sign_in_submit');
    submitButton.querySelector('.indicator-label').style.display = 'none';
    submitButton.querySelector('.indicator-progress').style.display = 'inline-block';
    submitButton.setAttribute('disabled', 'disabled');
  });
</script>
@endsection
