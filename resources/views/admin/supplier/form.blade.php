{{-- ==================================== Name field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $name_en = '';
        if (old('name_en')) {
            $name_en = old('name_en');
        } elseif (isset($supplier)) {
            $name_en = $supplier->name_en;
        }
    @endphp
    <label for="name_en">{{ __('Name') . ' ' . __('in English language') }} <span class="text-danger">*</span></label>
    <input type="text" name="name_en" id="name_en" value="{{ $name_en ?? '' }}"
        class="form-control @error('name_en') is-invalid @enderror" placeholder="">
    @error('name_en')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Name field (Thai) ========================================== --}}
<div class="form-group">
    @php
        $name_th = '';
        if (old('name_th')) {
            $name_th = old('name_th');
        } elseif (isset($supplier)) {
            $name_th = $supplier->name_th;
        }
    @endphp
    <label for="name_th">{{ __('Name') . ' ' . __('in Thai language') }}</label>
    <input type="text" name="name_th" id="name_th" value="{{ $name_th ?? '' }}"
        class="form-control @error('name_th') is-invalid @enderror" placeholder="">
    @error('name_th')
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
        $address_en = '';
        if (old('address_en')) {
            $address_en = old('address_en');
        } elseif (isset($supplier)) {
            $address_en = $supplier->address_en;
        }
    @endphp
    <label for="address_en">{{ __('Address') . ' ' . __('in English language')  }} <span class="text-danger">*</span></label>
    <textarea class="form-control @error('address_en') is-invalid @enderror" name="address_en" id="address_en" cols="30"
        rows="3">{{ $address_en ?? '' }}</textarea>
    @error('address_en')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Address field (Thai) ========================================== --}}
<div class="form-group">
    @php
        $address_th = '';
        if (old('address_th')) {
            $address_th = old('address_th');
        } elseif (isset($supplier)) {
            $address_th = $supplier->address_th;
        }
    @endphp
    <label for="address_th">{{ __('Address') . ' ' . __('in Thai language')  }}</label>
    <textarea class="form-control @error('address_th') is-invalid @enderror" name="address_th" id="address_th" cols="30"
        rows="3">{{ $address_th ?? '' }}</textarea>
    @error('address_th')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
