@extends('layouts.auth')
@section('content')

<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
  <div class="d-flex flex-center flex-column flex-lg-row-fluid">
    <div class="w-lg-500px p-10">
      <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="index.html" action="#">
        <div class="mb-11">
          <h1 class="text-gray-900 fw-bolder mb-3 fs-1">Masuk</h1>
          <div class="text-gray-500 fw-semibold fs-6">Silahkan masukan identitas anda</div>
        </div>
        <div class="fv-row mb-8">
          <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
        </div>
        <div class="fv-row mb-3">
          <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
        </div>
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
          <div></div>
          <a href="authentication/layouts/corporate/reset-password.html" class="link-primary">Lupa Password ?</a>
        </div>
        <div class="d-grid mb-10">
          <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
            <span class="indicator-label">Masuk</span>
            <span class="indicator-progress">Please wait... 
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
          </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Belum punya akun? 
        <a href="authentication/layouts/corporate/sign-up.html" class="link-primary">Daftar</a></div>
      </form>
    </div>
  </div>
</div>

@endsection