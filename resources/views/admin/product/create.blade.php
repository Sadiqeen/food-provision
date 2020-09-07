@extends('layouts.app')

@section('title')
{{ __('Add Product') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-archive fa-lg mr-2"></i> {{ __('Add Product') }}</span>
        <a type="button" href="{{ route('admin.product.index') }}"
            class="btn btn-secondary">{{ __('Manage Product') }}</a>
    </h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @include('admin.product.form')
                        <div class="form-group">
                            <a type="button" href="{{ route('admin.product.index') }}" class="btn btn-Danger">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
