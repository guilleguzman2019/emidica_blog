<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-11 col-md-5">
            <div class="border-dashed shadow bg-dark-2 br-10 p-4 mb-4 text-white">

                <div class="mb-3 small text-white-50">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success fs-13 lh-base" role="alert">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <x-jet-button type="submit">
                                {{ __('Resend Verification Email') }}
                            </x-jet-button>
                        </div>
                    </form>

                    <form id="logout" method="POST" action="/logout">
                        @csrf

                        <a type="submit" onclick="$('#logout').submit()" class="text-muted text-decoration-underline fs-13 text-uppercase">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>