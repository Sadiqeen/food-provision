@extends('layouts.app')

@section('title')
{{ __('Add Supplier') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-truck fa-lg mr-2" aria-hidden="true"></i> {{ __('Add Supplier') }}</span>
        <a type="button" href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">{{ __('Manage Supplier') }}</a>
    </h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.supplier.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tel">{{ __('Tel') }}</label>
                            <input type="text" name="tel" id="tel" value="{{ old('tel') }}" class="form-control @error('tel') is-invalid @enderror" placeholder="">
                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('E-mail') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <a type="button" href="{{ route('admin.supplier.index') }}" class="btn btn-Danger">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
