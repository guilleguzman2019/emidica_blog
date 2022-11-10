<x-guest-layout>

    <div class="row justify-content-center">
        <div class="col-11 col-md-9">
            <div class="border-dashed shadow bg-dark-2 br-10 p-4 mb-4 text-white">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row gx-sm-5">
                        <div class="col-sm-6">
                            <h2 class="fs-18">Cuenta</h2>

                            <div class="mb-3">
                                <label class="fs-13 mb-1 opacity-75">{{ __('Name') }}<span class="text-danger fs-16">*</span></label>
                                <input class="form-control bg-dark-4 text-white {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="fs-12 text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="fs-13 mb-1 opacity-75">Nro. de documento<span class="text-danger fs-16">*</span></label>
                                        <input class="form-control bg-dark-4 text-white {{ $errors->has('doc_number') ? 'is-invalid' : '' }}" type="number" name="doc_number" value="{{ old('doc_number') }}" required>
                                        @error('doc_number')
                                            <span class="fs-12 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="fs-13 mb-1 opacity-75">Fecha de nacimiento<span class="text-danger fs-16">*</span></label>
                                        <input class="form-control bg-dark-4 text-white {{ $errors->has('birthdate') ? 'is-invalid' : '' }}" type="date" name="birthdate" value="{{ old('birthdate') }}" required>
                                        @error('birthdate')
                                            <span class="fs-12 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fs-13 mb-1 opacity-75">{{ __('Email') }}<span class="text-danger fs-16">*</span></label>
                                <input class="form-control bg-dark-4 text-white {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required>
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
                                <input class="form-control bg-dark-4 text-white" type="password" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <h2 class="fs-18">Negocio</h2>

                            <div class="mb-3">
                                <label class="fs-13 mb-1 opacity-75">{{ __('Shop Name') }}<span class="text-danger fs-16">*</span></label>
                                <input class="form-control bg-dark-4 text-white {{ $errors->has('shop_name') ? 'is-invalid' : '' }}" type="text" name="shop_name" value="{{ old('shop_name') }}" required autofocus>
                                @error('shop_name')
                                    <span class="fs-12 text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="fs-13 mb-1 opacity-75">{{ __('Phone') }}<span class="text-danger fs-16">*</span></label>
                                <input class="form-control bg-dark-4 text-white {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" value="{{ old('phone') }}" required autofocus>
                                @error('phone')
                                    <span class="fs-12 text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="fs-13 mb-1 opacity-75">{{ __('Province') }}<span class="text-danger fs-16">*</span></label>
                                        <select id="province" class="form-select bg-dark-4 text-white @error('province') is-invalid @enderror" name="province" required>
                                            <option value="Buenos Aires" @if ( old('province') == 'Buenos Aires' ) selected @endif>Buenos Aires</option>
                                            <option value="CABA" @if ( old('province') == 'CABA' ) selected @endif>CABA</option>
                                            <option value="Catamarca" @if ( old('province') == 'Catamarca' ) selected @endif>Catamarca</option>
                                            <option value="Chaco" @if ( old('province') == 'Chaco' ) selected @endif>Chaco</option>
                                            <option value="Chubut" @if ( old('province') == 'Chubut' ) selected @endif>Chubut</option>
                                            <option value="Córdoba" @if ( old('province') == 'Córdoba' ) selected @endif>Córdoba</option>
                                            <option value="Corrientes" @if ( old('province') == 'Corrientes' ) selected @endif>Corrientes</option>
                                            <option value="Entre Ríos" @if ( old('province') == 'Entre Ríos' ) selected @endif>Entre Ríos</option>
                                            <option value="Formosa" @if ( old('province') == 'Formosa' ) selected @endif>Formosa</option>
                                            <option value="Jujuy" @if ( old('province') == 'Jujuy' ) selected @endif>Jujuy</option>
                                            <option value="La Pampa" @if ( old('province') == 'La Pampa' ) selected @endif>La Pampa</option>
                                            <option value="La Rioja" @if ( old('province') == 'La Rioja' ) selected @endif>La Rioja</option>
                                            <option value="Mendoza" @if ( old('province') == 'Mendoza' ) selected @endif>Mendoza</option>
                                            <option value="Misiones" @if ( old('province') == 'Misiones' ) selected @endif>Misiones</option>
                                            <option value="Neuquén" @if ( old('province') == 'Neuquén' ) selected @endif>Neuquén</option>
                                            <option value="Río Negro" @if ( old('province') == 'Río Negro' ) selected @endif>Río Negro</option>
                                            <option value="Salta" @if ( old('province') == 'Salta' ) selected @endif>Salta</option>
                                            <option value="San Juan" @if ( old('province') == 'San Juan' ) selected @endif>San Juan</option>
                                            <option value="San Luis" @if ( old('province') == 'San Luis' ) selected @endif>San Luis</option>
                                            <option value="Santa Cruz" @if ( old('province') == 'Santa Cruz' ) selected @endif>Santa Cruz</option>
                                            <option value="Santa Fe" @if ( old('province') == 'Santa Fe' ) selected @endif>Santa Fe</option>
                                            <option value="Santiago del Estero" @if ( old('province') == 'Santiago del Estero' ) selected @endif>Santiago del Estero</option>
                                            <option value="Tierra del Fuego" @if ( old('province') == 'Tierra del Fuego' ) selected @endif>Tierra del Fuego</option>
                                            <option value="Tucumán" @if ( old('province') == 'Tucumán' ) selected @endif>Tucumán</option>
                                        </select>
                                        @error('province')
                                            <span class="fs-12 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="fs-13 mb-1 opacity-75">{{ __('City') }}<span class="text-danger fs-16">*</span></label>
                                        <input class="form-control bg-dark-4 text-white {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" value="{{ old('city') }}" required autofocus>
                                        @error('city')
                                            <span class="fs-12 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="mb-3">
                                        <label class="fs-13 mb-1 opacity-75">{{ __('Address') }}<span class="text-danger fs-16">*</span></label>
                                        <input class="form-control bg-dark-4 text-white {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" value="{{ old('address') }}" required autofocus>
                                        @error('address')
                                            <span class="fs-12 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="fs-13 mb-1 opacity-75">Cod. Postal<span class="text-danger fs-16">*</span></label>
                                        <input class="form-control bg-dark-4 text-white {{ $errors->has('zip') ? 'is-invalid' : '' }}" type="text" name="zip" value="{{ old('zip') }}" required autofocus>
                                        @error('zip')
                                            <span class="fs-12 text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mb-3 mt-4">
                                    <div class="custom-control custom-checkbox fs-12 text-muted">
                                        <x-jet-checkbox id="terms" name="terms" />
                                        <label class="custom-control-label" for="terms">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                        </label>
                                    </div>

                                    @error('terms')
                                        <span class="fs-12 text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-end align-items-baseline">
                        <button type="submit" class="btn btn-primary px-3 fs-14 text-uppercase">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
            
            <p class="text-center fs-13 text-uppercase text-muted">
                <a class="text-muted text-decoration-underline" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
            </p>
        </div>
    </div>
</x-guest-layout>