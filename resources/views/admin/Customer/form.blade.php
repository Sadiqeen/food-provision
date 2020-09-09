@php
    $error_thai_field = $errors->has('name_th')
                           || $errors->has('coordinator_th')
                           || $errors->has('address_th')
                           || (isset($customer) && $customer->name_th)
                           || (isset($customer) && $customer->coordinator_th)
                           || (isset($customer) && $customer->address_th);
@endphp

{{-- ==================================== Name field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $name_en = '';
        if (old('name_en')) {
            $name_en = old('name_en');
        } elseif (isset($customer)) {
            $name_en = $customer->name_en;
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
<div class="form-group thai-field" @if(!$error_thai_field) style="display: none" @endif>
    @php
        $name_th = '';
        if (old('name_th')) {
            $name_th = old('name_th');
        } elseif (isset($customer)) {
            $name_th = $customer->name_th;
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

{{-- ==================================== Coordinate field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $coordinator_en = '';
        if (old('coordinator_en')) {
            $coordinator_en = old('coordinator_en');
        } elseif (isset($customer)) {
            $coordinator_en = $customer->coordinator_en;
        }
    @endphp
    <label for="coordinator_en">{{ __('Coordinator') . ' ' . __('in English language') }} <span class="text-danger">*</span></label>
    <input type="text" name="coordinator_en" id="coordinator_en" value="{{ $coordinator_en ?? '' }}"
           class="form-control @error('coordinator_en') is-invalid @enderror" placeholder="">
    @error('coordinator_en')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Coordinate field (Thai) ========================================== --}}
<div class="form-group thai-field" @if(!$error_thai_field) style="display: none" @endif>
    @php
        $coordinator_th = '';
        if (old('coordinator_th')) {
            $coordinator_th = old('coordinator_th');
        } elseif (isset($customer)) {
            $coordinator_th = $customer->coordinator_th;
        }
    @endphp
    <label for="coordinator_th">{{ __('Coordinator') . ' ' . __('in Thai language') }}</label>
    <input type="text" name="coordinator_th" id="coordinator_th" value="{{ $coordinator_th ?? '' }}"
           class="form-control @error('coordinator_th') is-invalid @enderror" placeholder="">
    @error('coordinator_th')
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
        } elseif (isset($customer)) {
            $tel = $customer->tel;
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
        } elseif (isset($customer)) {
            $email = $customer->email;
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
        } elseif (isset($customer)) {
            $address_en = $customer->address_en;
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
<div class="form-group thai-field" @if(!$error_thai_field) style="display: none" @endif>
    @php
        $address_th = '';
        if (old('address_th')) {
            $address_th = old('address_th');
        } elseif (isset($customer)) {
            $address_th = $customer->address_th;
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

{{-- ==================================== Note field ========================================== --}}
<div class="form-group">
    @php
        $note = '';
        if (old('note')) {
            $note = old('note');
        } elseif (isset($customer)) {
            $note = $customer->note;
        }
    @endphp
    <label for="note">{{ __('Note') }}</label>
    <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note" cols="30"
              rows="5">{{ $note ?? '' }}</textarea>
    @error('note')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@push('script')
    <script>
        const toggleThaiField = function (){
            $('.thai-field').toggle("slide");
        }
    </script>
@endpush
