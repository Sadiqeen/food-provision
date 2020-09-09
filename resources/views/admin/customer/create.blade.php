@extends('layouts.app')

@section('title')
{{ __('Add Customer') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-user fa-lg mr-2" aria-hidden="true"></i> {{ __('Add Customer') }}</span>
        <a type="button" href="javascript:void(0)" onclick="toggleThaiField()"
           class="btn btn-outline-success mr-2">{{ __('Thai Field') }}</a>
        <a type="button" href="{{ route('admin.customer.index') }}"
            class="btn btn-secondary">{{ __('Manage Customer') }}</a>
    </h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.customer.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @include('admin.customer.form')
                        <div class="form-group">
                            <a type="button" href="{{ route('admin.customer.index') }}" class="btn btn-Danger">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

