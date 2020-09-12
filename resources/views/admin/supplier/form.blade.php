{{-- ==================================== Name field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $name = '';
        if (old('name')) {
            $name = old('name');
        } elseif (isset($supplier)) {
            $name = $supplier->name;
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

{{-- ==================================== Phone number field ========================================== --}}
<div class="form-group">
    @php
        $tel = '';
        if (old('tel')) {
            $tel = old('tel');
        } elseif (isset($supplier)) {
            $tel = $supplier->tel;
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
        } elseif (isset($supplier)) {
            $email = $supplier->email;
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
        } elseif (isset($supplier)) {
            $address = $supplier->address;
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

