<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-11 col-md-5">
            <div class="border-dashed shadow bg-dark-2 br-10 p-4 mb-4 text-white">

                <form method="POST" action="/reset-password">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">{{ __('Email') }}<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-dark-4 text-white {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email', $request -> email) }}" required>
                        @error('email')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">{{ __('Password') }}<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-dark-4 text-white {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" required>
                        @error('password')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="fs-13 mb-1 opacity-75">{{ __('Confirm Password') }}<span class="text-danger fs-16">*</span></label>
                        <input class="form-control bg-dark-4 text-white {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" name="password_confirmation" required>
                        @error('password_confirmation')
                            <span class="fs-12 text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-3 fs-14 text-uppercase">{{ __('Reset Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>