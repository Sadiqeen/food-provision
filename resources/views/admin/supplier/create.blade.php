@extends('layouts.app')

@section('title')
{{ __('Add Supplier') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-truck fa-lg mr-2" aria-hidden="true"></i> {{ __('Add Supplier') }}</span>
        <a type="button" href="{{ route('admin.supplier.index') }}"
            class="btn btn-secondary">{{ __('Manage Supplier') }}</a>
    </h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.supplier.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @include('admin.supplier.form')
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
