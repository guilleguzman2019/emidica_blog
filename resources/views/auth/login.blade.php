<x-guest-layout>

    <div class="row justify-content-center">
        <div class="col-11 col-md-5">
            <div class="border-dashed shadow bg-dark-2 br-10 p-4 mb-4 text-white">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">{{ __('Email') }}<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-dark-4 text-white {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">{{ __('Password') }}<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-dark-4 text-white {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" value="{{ old('password') }}" required>
                        @error('password')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="custom-control custom-checkbox fs-12">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <label class="custom-control-label" for="remember_me">{{ __('Remember Me') }}</label>
                        </div>
                        <button type="submit" class="btn btn-primary px-3 fs-14 text-uppercase">{{ __('Log in') }}</button>
                    </div>
                </form>
            </div>
            
            <p class="text-center fs-13 text-uppercase text-muted">
                <a class="text-muted me-3 text-decoration-underline" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                •
                <a class="text-muted ms-3 text-decoration-underline" href="{{ route('register') }}">{{ __('Register') }}</a>
            </p>
        </div>
    </div>

</x-guest-layout>