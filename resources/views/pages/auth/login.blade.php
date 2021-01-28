{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-3 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid"
                 style="background-image: url({{asset("media/bg/bg-2.jpg")}});">
                <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{asset("media/logo-polos.png")}}" class="max-h-100px" alt=""/>
                        </a>
                    </div>
                    <!--end::Login Header-->

                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3>Login untuk masuk ke dalam aplikasi</h3>
                            <p class="opacity-60 font-weight-bold">Masukkan detail anda untuk masuk ke dalam akun
                                anda:</p>
                        </div>

                        @if (session('error'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form class="form" id="kt_login_signin_form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5"
                                    type="text" placeholder="Username" name="username" autocomplete="off" value="{{ old('username') }}"/>
                                @error('username')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input
                                    class="form-control h-auto text-white placeholder-white opacity-70 bg-dark-o-70 rounded-pill border-0 py-4 px-8 mb-5"
                                    type="password" placeholder="Password" name="password"/>
                                @error('password')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                                        <input type="checkbox" name="remember"/>
                                        <span></span>Ingat saya</label>
                                </div>
                            </div>

                            <div class="form-group text-center mt-10">
                                <button id="kt_login_signin_submit" type="submit"
                                        class="btn btn-pill btn-outline-white font-weight-bold opacity-90 px-15 py-3">
                                    Masuk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->

@endsection

{{-- Scripts Section --}}
@section('scripts')
{{--    <script src="{{asset("js/pages/custom/login/login-general.js")}}"></script>--}}
@endsection

