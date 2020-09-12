{{-- ==================================== Name field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $name = '';
        if (old('name')) {
            $name = old('name');
        } elseif (isset($brand)) {
            $name = $brand->name;
        }
    @endphp
    <label for="name">{{ __('Name') . ' ' . __('in English language') }} <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name" value="{{ $name ?? '' }}"
        class="form-control @error('name') is-invalid @enderror" placeholder="">
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

