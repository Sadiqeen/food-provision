{{-- ==================================== Name field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $name_en = '';
        if (old('name_en')) {
            $name_en = old('name_en');
        } elseif (isset($category)) {
            $name_en = $category->name_en;
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
        } elseif (isset($category)) {
            $name_th = $category->name_th;
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
