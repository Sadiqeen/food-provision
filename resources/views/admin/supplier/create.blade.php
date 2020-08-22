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
            <form action="">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="tel">{{ __('Tel') }}</label>
                            <input type="text" name="tel" id="tel" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('E-mail') }}</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <a type="button" href="{{ route('admin.supplier.index') }}" class="btn btn-Danger">{{ __('Cancel') }}</a>
                            <button type="button" class="btn btn-success float-right">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
