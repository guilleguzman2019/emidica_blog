<div class="bg-dark-2 border-dashed rounded-4 mb-4 position-relative">
    <h2 class="fs-18 p-4 border-bottom border-light border-opacity-10">{{ __('Two Factor Authentication') }}</h2>

    <div class="p-4 border-bottom-dashed">
        <p class="fs-14 text-white-50">{{ __('Add additional security to your account using two factor authentication.') }}</p>

        <h3 class="fs-21">
            @if ( $this->enabled )
                {{ __('You have enabled two factor authentication.') }}
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <p class="mt-3 text-white-50">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <p class="mt-3 text-white-50">
                    {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                </p>

                <div class="mt-3">
                    {!! $this -> user -> twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <p class="mt-3 text-white-50">
                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                </p>

                <div class="rounded-3 bg-dark-3 p-3">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>

    <div class="px-4 py-3 d-flex justify-content-end">
        @if (! $this->enabled)
            <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                <button type="button" class="bg-cian px-4 py-2 fs-14 text-white border-0 rounded-3" wire:loading.attr="disabled">{{ __('Enable') }}</button>
            </x-jet-confirms-password>
        @else
            @if ($showingRecoveryCodes)
                <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                    <x-jet-secondary-button class="me-3">
                        <div wire:loading wire:target="regenerateRecoveryCodes" class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        {{ __('Regenerate Recovery Codes') }}
                    </x-jet-secondary-button>
                </x-jet-confirms-password>
            @else
                <x-jet-confirms-password wire:then="showRecoveryCodes">
                    <x-jet-secondary-button class="me-3">
                        <div wire:loading wire:target="showRecoveryCodes" class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        {{ __('Show Recovery Codes') }}
                    </x-jet-secondary-button>
                </x-jet-confirms-password>
            @endif

            <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                <x-jet-danger-button wire:loading.attr="disabled">
                    <div wire:loading wire:target="disableTwoFactorAuthentication" class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                    {{ __('Disable') }}
                </x-jet-danger-button>
            </x-jet-confirms-password>
        @endif
    </div>
</div>