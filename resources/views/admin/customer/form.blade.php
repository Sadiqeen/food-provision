{{-- ==================================== Name field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $name = '';
        if (old('name')) {
            $name = old('name');
        } elseif (isset($customer)) {
            $name = $customer->name;
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

{{-- ==================================== Coordinate field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $coordinator = '';
        if (old('coordinator')) {
            $coordinator = old('coordinator');
        } elseif (isset($customer)) {
            $coordinator = $customer->coordinator;
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
        $address = '';
        if (old('address')) {
            $address = old('address');
        } elseif (isset($customer)) {
            $address = $customer->address;
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
