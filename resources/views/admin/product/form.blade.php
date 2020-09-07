<div class="form-group mt-2 text-center">
    <img class="img-fluid rounded border" style="max-height: 300px" src="{{ isset($product->image) ? asset($product->image) : asset('imgs/placeholder.jpg') }}" id='img-upload'/>
</div>

<div class="form-group">
    <label class="w-100">
        {{ __('Upload Image') }}
        <a id="del-img-btn" href="javascript:void(0)" onclick="removeImage()" class="d-none float-right text-danger">
            {{ __('Delete') }}
        </a>
    </label>
    <div class="custom-file">
        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="imgInp">
        <label class="custom-file-label" for="customFile">{{ __('Choose file') }}</label>
      </div>
      @error('image')
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
</div>

{{-- ==================================== Name field (Eng) ========================================== --}}
<div class="form-group">
    @php
        $name_en = '';
        if (old('name_en')) {
            $name_en = old('name_en');
        } elseif (isset($product)) {
            $name_en = $product->name_en;
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
        } elseif (isset($product)) {
            $name_th = $product->name_th;
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

{{-- ==================================== Price field ========================================== --}}
<div class="form-group">
    @php
        $price = '';
        if (old('price')) {
            $price = old('price');
        } elseif (isset($product)) {
            $price = $product->price;
        }
    @endphp
    <label for="price">{{ __('Price') }} <span class="text-danger">*</span></label>
    <input type="number" min="0" name="price" id="price" value="{{ $price ?? '' }}"
        class="form-control @error('price') is-invalid @enderror" placeholder="">
    @error('price')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Desciption (en) field ========================================== --}}
<div class="form-group">
    @php
        $description_en = '';
        if (old('description_en')) {
            $description_en = old('description_en');
        } elseif (isset($product)) {
            $description_en = $product->desc_en;
        }
    @endphp
    <label for="description_en">{{ __('Descrip') . ' ' . __('Product') . ' ' . __('in English language') }}</label>
    <textarea class="form-control @error('description_en') is-invalid @enderror" name="description_en" id="description_en" rows="3">{{ $description_en ?? '' }}</textarea>
    @error('description_en')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Desciption (th) field ========================================== --}}
<div class="form-group">
    @php
        $description_th = '';
        if (old('description_th')) {
            $description_th = old('description_th');
        } elseif (isset($product)) {
            $description_th = $product->desc_th;
        }
    @endphp
    <label for="description_th">{{ __('Descrip') . ' ' . __('Product') . ' ' . __('in Thai language') }}</label>
    <textarea class="form-control @error('description_th') is-invalid @enderror" name="description_th" id="description_th" rows="3">{{ $description_th ?? '' }}</textarea>
    @error('description_th')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Unit field ========================================== --}}
<div class="form-row">

<div class="form-group col-md-6">
    @php
        $unit = '';
        if (old('unit')) {
            $unit = old('unit');
        } elseif (isset($product)) {
            $unit = $product->unit;
        }
    @endphp
    <label for="unit">{{ __('Unit') }} <span class="text-danger">*</span></label>
    <select class="form-control border selectpicker @error('unit') is-invalid @enderror" data-live-search="true" data-size="10" name="unit" id="unit" value="{{ $unit ?? '' }}">
        @foreach ($units as $unit)
            @php
                $fistLoopOnCreate =  $loop->first && !isset($product);
                $selectedValueOnEdit = isset($product) && $product->unit_id === $unit->id;
            @endphp
            <option value="{{ $unit->id }}" {{ $fistLoopOnCreate || $selectedValueOnEdit ? 'selected' : '' }}>{{ $unit->name }}</option>
        @endforeach
    </select>
    @error('unit')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Category field ========================================== --}}
<div class="form-group col-md-6">
    @php
        $category = '';
        if (old('category')) {
            $category = old('category');
        } elseif (isset($product)) {
            $category = $product->category;
        }
    @endphp
    <label for="category">{{ __('Category') }} <span class="text-danger">*</span></label>
    <select class="form-control border selectpicker @error('category') is-invalid @enderror" data-live-search="true" data-size="10" name="category" id="category" value="{{ $category ?? '' }}">
        @foreach ($categories as $category)
            @php
                $fistLoopOnCreate =  $loop->first && !isset($product);
                $selectedValueOnEdit = isset($product) && $product->category_id === $category->id;
            @endphp
            <option value="{{ $category->id }}" {{ $fistLoopOnCreate || $selectedValueOnEdit ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Brand field ========================================== --}}
<div class="form-group col-md-6">
    @php
        $brand = '';
        if (old('brand')) {
            $brand = old('brand');
        } elseif (isset($product)) {
            $brand = $product->brand;
        }
    @endphp
    <label for="brand">{{ __('Brand') }} <span class="text-danger">*</span></label>
    <select class="form-control border selectpicker @error('brand') is-invalid @enderror" data-live-search="true" data-size="10" name="brand" id="brand" value="{{ $brand ?? '' }}">
        @foreach ($brands as $brand)
            @php
                $fistLoopOnCreate =  $loop->first && !isset($product);
                $selectedValueOnEdit = isset($product) && $product->brand_id === $brand->id;
            @endphp
            <option value="{{ $brand->id }}" {{ $fistLoopOnCreate || $selectedValueOnEdit ? 'selected' : '' }}>{{ $brand->name }}</option>
        @endforeach
    </select>
    @error('brand')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- ==================================== Supplier field ========================================== --}}
<div class="form-group col-md-6">
    @php
        $supplier = '';
        if (old('supplier')) {
            $supplier = old('supplier');
        } elseif (isset($product)) {
            $supplier = $product->supplier;
        }
    @endphp
    <label for="supplier">{{ __('Supplier') }} <span class="text-danger">*</span></label>
    <select class="form-control border selectpicker @error('supplier') is-invalid @enderror" data-live-search="true" data-size="10" name="supplier" id="supplier" value="{{ $supplier ?? '' }}">
        @foreach ($suppliers as $supplier)
            @php
                $fistLoopOnCreate =  $loop->first && !isset($product);
                $selectedValueOnEdit = isset($product) && $product->supplier_id === $supplier->id;
            @endphp
            <option value="{{ $supplier->id }}" {{ $fistLoopOnCreate || $selectedValueOnEdit ? 'selected' : '' }}>{{ $supplier->name }}</option>
        @endforeach
    </select>
    @error('supplier')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

</div>

@push('style')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
@endpush



@push('script')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/i18n/defaults-*.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#imgInp").change(function () {
                let size = this.files[0].size
                if (size > 2000000) {
                    alert('ขนาดรูปใหญ่เกินไป')
                    return false;
                }
                let fileName = $(this).val().split('\\').pop()
                $(this).next('.custom-file-label').addClass("selected").text(imageName(fileName))

                readURL(this);

                $( '#del-img-btn' ).removeClass( 'd-none' )
                $( '#img-upload' ).removeClass( 'd-none' )
            });
        });

        function imageName(fileName) {
            if (fileName.length > 20) {
                return fileName.substr(0, 20) + '...'
            } else {
                return fileName
            }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader()

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            $( '#imgInp' ).val( null )
            $( '#imgInp' ).next('.custom-file-label').text('{{ __('Choose file') }}')
            $( '#img-upload' ).attr( 'src' , null )
            $( '#del-img-btn' ).addClass( 'd-none' )
            $( '#img-upload' ).attr('src', '{{ isset($product->image) ? asset($product->image) : asset('imgs/placeholder.jpg') }}')
        }

    </script>
@endpush
