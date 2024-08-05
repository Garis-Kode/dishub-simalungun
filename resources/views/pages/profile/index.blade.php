@extends('layouts.app')

@section('content')
<div class="card mb-5 mb-xl-10">
  <div class="card-header border-0 cursor-pointer">
    <div class="card-title m-0">
      <h3 class="fw-bold m-0">Profile Detail</h3>
    </div>
  </div>
  <div>
    <form method="POST" id="form" action="{{ route('profile.update') }}" class="form">
      @csrf
      <div class="card-body border-top p-9">
        <div class="row mb-6">
          <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama</label>
          <div class="col-lg-8 fv-row">
            <input type="text" name="name" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" placeholder="Nama" value="{{ old('name') ?? Auth::user()->name }}" />
            @error('name')
            <div class="text-sm text-danger">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="row mb-6">
          <label class="col-lg-4 col-form-label fw-semibold fs-6">
            <span class="required">Role</span>
          </label>
          <div class="col-lg-8 fv-row">
            <input class="form-control form-control-lg form-control-solid" disabled value="{{ Auth::user()->role }}" />
          </div>
        </div>
        <div class="row mb-6">
          <label class="col-lg-4 col-form-label required fw-semibold fs-6">Akses</label>
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-6 fv-row">
                <input class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" disabled value="{{ Auth::user()->district->name ?? '-' }}" />
                <small class="text-muted ps-2">Kecamatan</small>
              </div>
              <div class="col-lg-6 fv-row">
                <input class="form-control form-control-lg form-control-solid" disabled value="{{ Auth::user()->village->name ?? '-' }}" />
                <small class="text-muted ps-2">Kelurahan</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <button type="submit" id="submit" class="btn btn-primary">
          <span class="indicator-label">Simpan</span>
          <span class="indicator-progress" style="display: none;">Loading... 
          <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
      </div>
    </form>
  </div>
</div>
<div class="card mb-5 mb-xl-10">
  <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
    <div class="card-title m-0">
      <h3 class="fw-bold m-0">Sign-in Method</h3>
    </div>
  </div>
  <div id="kt_account_settings_signin_method" class="collapse show">
    <div class="card-body border-top p-9">
      <div class="d-flex flex-wrap align-items-center">
        <div id="kt_signin_email">
          <div class="fs-6 fw-bold mb-1">Alamat Email</div>
          <div class="fw-semibold text-gray-600">{{ Auth::user()->email }}</div>
        </div>
        <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
          <form action="{{ route('profile.signin') }}" id="formSignin" method="POST" class="form">
            @csrf
            <div class="row mb-6">
              <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="fv-row mb-0">
                  <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Email</label>
                  <input type="email" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" id="emailaddress" placeholder="Email Address" name="email" value="{{ old('email') ?? Auth::user()->email }}" />
                  @error('email')
                  <div class="text-sm text-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="fv-row mb-0">
                  <label for="username" class="form-label fs-6 fw-bold mb-3">Username</label>
                  <input type="text" class="form-control form-control-lg form-control-solid @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') ?? Auth::user()->username }}" />
                  @error('username')
                  <div class="text-sm text-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="d-flex">
              <button type="submit" id="submitSignin" class="btn btn-primary">
                <span class="indicator-label">Simpan</span>
                <span class="indicator-progress" style="display: none;">Loading... 
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
              </button>
              <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-500 btn-active-light-primary px-6">Cancel</button>
            </div>
          </form>
        </div>
        <div id="kt_signin_email_button" class="ms-auto">
          <button class="btn btn-light btn-active-light-primary">Ubah</button>
        </div>
      </div>
      <div class="separator separator-dashed my-6"></div>
      <div class="d-flex flex-wrap align-items-center mb-10">
        <div id="kt_signin_password">
          <div class="fs-6 fw-bold mb-1">Password</div>
          <div class="fw-semibold text-gray-600">************</div>
        </div>
        <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
          <form id="formPassword" method="POST" action="{{ route('profile.change-password') }}" class="form">
            @csrf
            <div class="row mb-6">
              <div class="col-lg-6">
                <div class="fv-row mb-0">
                  <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">Current Password</label>
                  <input type="password" class="form-control form-control-lg form-control-solid @error('oldpassword') is-invalid @enderror" name="oldPassword" id="currentpassword" />
                  @error('oldpassword')
                  <div class="text-sm text-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="fv-row mb-0">
                  <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New Password</label>
                  <input type="password" class="form-control form-control-lg form-control-solid @error('newPassword') is-invalid @enderror" name="newpassword" id="newpassword" />
                  @error('newPassword')
                  <div class="text-sm text-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="d-flex">
              <button type="submit" id="submitPassword" class="btn btn-primary">
                <span class="indicator-label">Simpan</span>
                <span class="indicator-progress" style="display: none;">Loading... 
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
              </button>             
             <button id="kt_password_cancel" type="button" class="btn btn-color-gray-500 btn-active-light-primary px-6">Cancel</button>
            </div>
          </form>
        </div>
        <div id="kt_signin_password_button" class="ms-auto">
          <button class="btn btn-light btn-active-light-primary">Ubah</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/custom/account/settings/signin-methods.js') }}"></script>
<script>
  document.getElementById('form').addEventListener('submit', function() {
    var submitButton = document.getElementById('submit');
    submitButton.querySelector('.indicator-label').style.display = 'none';
    submitButton.querySelector('.indicator-progress').style.display = 'inline-block';
    submitButton.setAttribute('disabled', 'disabled');
  });
</script>
<script>
  document.getElementById('formSignin').addEventListener('submit', function() {
    var submitButton = document.getElementById('submitSignin');
    submitButton.querySelector('.indicator-label').style.display = 'none';
    submitButton.querySelector('.indicator-progress').style.display = 'inline-block';
    submitButton.setAttribute('disabled', 'disabled');
  });
</script>
<script>
  document.getElementById('formPassword').addEventListener('submit', function() {
    var submitButton = document.getElementById('submitPassword');
    submitButton.querySelector('.indicator-label').style.display = 'none';
    submitButton.querySelector('.indicator-progress').style.display = 'inline-block';
    submitButton.setAttribute('disabled', 'disabled');
  });
</script>
@endsection