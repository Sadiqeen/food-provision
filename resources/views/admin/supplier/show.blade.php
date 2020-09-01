@extends('layouts.app')

@section('title')
{{ __('View Supplier Data') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-truck fa-lg mr-2" aria-hidden="true"></i>
            {{ __('View Supplier Data') }}</span>
        <a type="button" href="{{ route('admin.supplier.index') }}"
            class="btn btn-secondary">{{ __('Manage Supplier') }}</a>
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">{{ __('Name') }}</label>
                        <input type="text" name="" id="" value="{{ $supplier->name }}" class="form-control"
                            placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Tel') }}</label>
                        <input type="text" name="" id="" value="{{ $supplier->tel }}" class="form-control"
                            placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('E-mail') }}</label>
                        <input type="text" name="" id="" value="{{ $supplier->email }}" class="form-control"
                            placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Address') }}</label>
                        <textarea class="form-control" name="" id="" cols="30" rows="3" disabled>{{ $supplier->address }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
