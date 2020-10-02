{{-- ==================================== Name field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $name = '';
        if (old('name')) {
            $name = old('name');
        } elseif (isset($employee)) {
            $name = $employee->name;
        }
    @endphp
    <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name" value="{{ $name ?? '' }}"
           class="form-control @error('name') is-invalid @enderror" placeholder="">
    @error('name')
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
        } elseif (isset($employee)) {
            $email = $employee->email;
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

{{-- ==================================== Password field ========================================== --}}
<div class="form-group">

    <label for="password">{{ __('Password') }}
        @if (request()->routeIs('customer.employee.create')) <span class="text-danger">*</span> @endif
    </label>

    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
    @if (request()->routeIs('customer.employee.edit')) <small class="form-text text-muted">{{ __("Leave blank if you don't want to change it") }}</small> @endif

    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Confirmation Password field ========================================== --}}
<div class="form-group">
    <label for="password-confirm" >{{ __('Confirm Password') }}
        @if (request()->routeIs('customer.employee.create')) <span class="text-danger">*</span> @endif
    </label>

    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
</div>
