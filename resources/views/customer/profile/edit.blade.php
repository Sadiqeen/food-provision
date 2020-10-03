@extends('layouts.app')

@section('title')
    {{ __('Edit Profile') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-user fa-lg mr-2" aria-hidden="true"></i> {{ __('Edit Profile') }}</span>
            <a type="button" href="{{ route('dashboard') }}"
               class="btn btn-secondary">{{ __('Dashboard') }}</a>
        </h3>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customer.profile.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-6">

                            {{-- ==================================== Name field (Eng) ========================================== --}}
                            <div class="form-group">
                                @php
                                    $name = '';
                                    if (old('name')) {
                                        $name = old('name');
                                    } elseif (isset($profile->customer)) {
                                        $name = $profile->customer->name;
                                    }
                                @endphp
                                <label for="name">{{ __('Company Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" value="{{ $name ?? '' }}"
                                       class="form-control @error('name') is-invalid @enderror" placeholder="">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- ==================================== Coordinate field (Eng) ========================================== --}}
                            <div class="form-group">
                                @php
                                    $coordinator = '';
                                    if (old('coordinator')) {
                                        $coordinator = old('coordinator');
                                    } elseif (isset($profile)) {
                                        $coordinator = $profile->name;
                                    }
                                @endphp
                                <label for="coordinator">{{ __('Coordinator') }} <span class="text-danger">*</span></label>
                                <input type="text" name="coordinator" id="coordinator" value="{{ $coordinator ?? '' }}"
                                       class="form-control @error('coordinator') is-invalid @enderror" placeholder="">
                                @error('coordinator')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- ==================================== Phone field ========================================== --}}
                            <div class="form-group">
                                @php
                                    $tel = '';
                                    if (old('tel')) {
                                        $tel = old('tel');
                                    } elseif (isset($profile->customer)) {
                                        $tel = $profile->customer->tel;
                                    }
                                @endphp
                                <label for="tel">{{ __('Tel') }} <span class="text-danger">*</span></label>
                                <input type="text" name="tel" id="tel" value="{{ $tel ?? '' }}"
                                       class="form-control @error('tel') is-invalid @enderror" placeholder="">
                                @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- ==================================== Email field ========================================== --}}
                            <div class="form-group">
                                @php
                                    $email = '';
                                    if (old('email')) {
                                        $email = old('email');
                                    } elseif (isset($profile)) {
                                        $email = $profile->email;
                                    }
                                @endphp
                                <label for="email">{{ __('E-mail') }} <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ $email ?? '' }}"
                                       class="form-control @error('email') is-invalid @enderror" placeholder="">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- ==================================== Address field (Eng) ========================================== --}}
                            <div class="form-group">
                                @php
                                    $address = '';
                                    if (old('address')) {
                                        $address = old('address');
                                    } elseif (isset($profile->customer)) {
                                        $address = $profile->customer->address;
                                    }
                                @endphp
                                <label for="address">{{ __('Address') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30"
                                          rows="3">{{ $address ?? '' }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <hr>
                            {{-- ==================================== Password field ========================================== --}}
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <small class="form-text text-muted">{{ __("Leave blank if you don't want to change it") }}</small>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- ==================================== Confirmation Password field ========================================== --}}
                            <div class="form-group">
                                <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <a type="button" href="{{ route('customer.employee.index') }}" class="btn btn-Danger">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
