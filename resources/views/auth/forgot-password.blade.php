<x-guest-layout>

    <div class="row justify-content-center">
        <div class="col-11 col-md-5">
            <div class="border-dashed shadow bg-dark-2 br-10 p-4 mb-4 text-white">

            <p class="fs-14 mb-3">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            @if (session('status'))
                <div class="alert alert-success fs-14" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="/forgot-password">
                @csrf

                <div class="mb-3">
                    <label class="fs-13 mb-1 opacity-75">{{ __('Email') }}<span class="text-danger fs-16">*</span></label>
                    <input class="form-control bg-dark-4 text-white {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="fs-12 text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary px-3 fs-14 text-uppercase">{{ __('Email Password Reset Link') }}</button>
                </div>
            </form>
        </div>

        <p class="text-center fs-13 text-uppercase"><a class="text-muted me-3 text-decoration-underline" href="{{ route('login') }}">{{ __('Login') }}</a></p>
    </div>

</x-guest-layout>