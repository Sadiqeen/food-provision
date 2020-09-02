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
                        <label for="">{{ __('Name') . ' ' . __('in English language') }}</label>
                        <input type="text" name="" id="" value="{{ $supplier->name_en }}" class="form-control"
                            placeholder="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Name') . ' ' . __('in Thai language') }}</label>
                        <input type="text" name="" id="" value="{{ $supplier->name_th }}" class="form-control"
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
                        <label for="">{{ __('Address') . ' ' . __('in English language') }}</label>
                        <textarea class="form-control" name="" id="" cols="30" rows="3" disabled>{{ $supplier->address_en }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Address') . ' ' . __('in Thai language') }}</label>
                        <textarea class="form-control" name="" id="" cols="30" rows="3" disabled>{{ $supplier->address_th }}</textarea>
                    </div>
                    <div class="form-group">
                        <a type="button" href="{{ route('admin.supplier.index') }}" class="btn btn-secondary">{{ __('Manage Supplier') }}</a>
                        <a type="submit" href="{{ route('admin.supplier.edit', $supplier->id) }}" class="btn btn-success float-right">{{ __('Edit') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
