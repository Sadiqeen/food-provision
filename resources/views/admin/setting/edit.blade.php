@extends('layouts.app')

@section('title')
    {{ __('Setting') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-cog fa-lg mr-2"></i> {{ __('Setting') }}</span>
            <a type="button" href="{{ route('dashboard') }}"
               class="btn btn-secondary">{{ __('Dashboard') }}</a>
        </h3>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.setting.update.setting') }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h3>{{ __('Company setting') }}</h3>
                            <hr>
                            <div class="form-group mt-2 text-center">
                                <img class="img-fluid rounded border" width="150px" height="150px"
                                     style="max-height: 300px"
                                     src="{{ isset($setting->image) ? asset($setting->image) : asset('imgs/placeholder.jpg') }}"
                                     id='img-upload'/>
                            </div>
                            <div class="form-group">
                                <label class="w-100">
                                    {{ __('Upload Image') }}
                                    <a id="del-img-btn" href="javascript:void(0)" onclick="removeImage()"
                                       class="d-none float-right text-danger">
                                        {{ __('Delete') }}
                                    </a>
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                           name="image" id="imgInp">
                                    <label class="custom-file-label" for="customFile">{{ __('Choose file') }}</label>
                                </div>
                                @error('image')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                @php
                                    $company = '';
                                    if (old('company')) {
                                        $company = old('company');
                                    } elseif (isset($setting)) {
                                        $company = $setting->company;
                                    }
                                @endphp
                                <label for="company">{{ __('Company') }} <span class="text-danger">*</span></label>
                                <input type="text" name="company" id="company" value="{{ $company ?? '' }}"
                                       class="form-control @error('company') is-invalid @enderror" placeholder="">
                                @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                @php
                                    $com_email = '';
                                    if (old('com_email')) {
                                        $com_email = old('com_email');
                                    } elseif (isset($setting)) {
                                        $com_email = $setting->email;
                                    }
                                @endphp
                                <label for="com_email">{{ __('E-mail') }} <span class="text-danger">*</span></label>
                                <input type="email" name="com_email" id="com_email" value="{{ $com_email ?? '' }}"
                                       class="form-control @error('com_email') is-invalid @enderror" placeholder="">
                                @error('com_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                @php
                                    $com_tel = '';
                                    if (old('com_tel')) {
                                        $com_tel = old('com_tel');
                                    } elseif (isset($setting)) {
                                        $com_tel = $setting->tel;
                                    }
                                @endphp
                                <label for="com_tel">{{ __('Tel') }} <span class="text-danger">*</span></label>
                                <input type="text" name="com_tel" id="com_tel" value="{{ $com_tel ?? '' }}"
                                       class="form-control @error('com_tel') is-invalid @enderror" placeholder="">
                                @error('com_tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                @php
                                    $com_address = '';
                                    if (old('com_address')) {
                                        $com_address = old('com_address');
                                    } elseif (isset($setting)) {
                                        $com_address = $setting->address;
                                    }
                                @endphp
                                <label for="com_address">{{ __('Address') }} <span class="text-danger">*</span></label>
                                <textarea rows="5" cols="3" name="com_address" id="com_address"
                                          class="form-control @error('com_address') is-invalid @enderror">{{ $com_address ?? '' }}
                                </textarea>
                                @error('com_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success" type="submit">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <form action="{{ route('admin.setting.update.profile') }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h3>{{ __('Administrator account') }}</h3>
                            <hr>
                            <div class="form-group">
                                @php
                                    $name = '';
                                    if (old('name')) {
                                        $name = old('name');
                                    } elseif (isset($user)) {
                                        $name = $user->name;
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
                            <div class="form-group">
                                @php
                                    $email = '';
                                    if (old('email')) {
                                        $email = old('email');
                                    } elseif (isset($user)) {
                                        $email = $user->email;
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

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                <small
                                    class="form-text text-muted">{{ __("Leave blank if you don't want to change it") }}</small>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Password confirmation') }}</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                       id="password_confirmation">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success" type="submit">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
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

                $('#del-img-btn').removeClass('d-none')
                $('#img-upload').removeClass('d-none')
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
                let reader = new FileReader()

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            $('#imgInp').val(null).next('.custom-file-label').text('{{ __('Choose file') }}')
            $('#del-img-btn').addClass('d-none')
            $('#img-upload').attr('src', '{{ isset($setting->image) ? asset($setting->image) : asset('imgs/placeholder.jpg') }}')
        }

    </script>
@endpush
