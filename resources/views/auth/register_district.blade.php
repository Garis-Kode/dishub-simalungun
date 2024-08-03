@extends('layouts.auth')
@section('content')
<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
  <div class="d-flex flex-center flex-column flex-lg-row-fluid">
    <div class="w-lg-500px p-10">
      <form class="form w-100" action="{{ route('register.district') }}" method="POST" id="loginForm">
        @csrf
        <div class="mb-11">
          <h1 class="text-gray-900 fw-bolder mb-3 fs-1">Daftar</h1>
          <div class="text-gray-500 fw-semibold fs-6">Daftar sebagai admin kecamatan</div>
        </div>
        <div class="fv-row mb-8">
          <select class="form-select @error('district') is-invalid @enderror" name="district" data-control="select2" data-placeholder="Pilih Kecamatan">
            <option></option>
            @foreach ($district as $item)
            <option value="{{ $item->id }}" @if (old('district') == $item->id) selected @endif>{{ $item->name }}</option>
            @endforeach
          </select>
          @error('district')
          <div class="text-sm text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="fv-row mb-8">
          <input type="text" placeholder="Nama" name="name" autocomplete="off" class="form-control bg-transparent @error('name') is-invalid @enderror" value="{{ old('name') }}" />
          @error('name')
          <div class="text-sm text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="fv-row mb-8">
          <input type="text" placeholder="Username" name="username" autocomplete="off" class="form-control bg-transparent @error('username') is-invalid @enderror" value="{{ old('username') }}" />
          @error('username')
          <div class="text-sm text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="fv-row mb-8">
          <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}" />
          @error('email')
          <div class="text-sm text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="fv-row mb-8">
          <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent"  />
          @error('password')
          <div class="text-sm text-danger">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="d-grid mb-10">
          <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
            <span class="indicator-label">Daftar</span>
            <span class="indicator-progress" style="display: none;">Loading... 
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
          </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Sudah punya akun? 
        <a href="{{ route('login') }}" class="link-primary" >Masuk</a></div>
      </form>
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
