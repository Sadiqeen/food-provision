@extends('layouts.app')

@section('title')
{{ __('Unit') }}
@endsection

@section('content')
<div class="container">
    <h3 class="my-3 text-uppercase font-weight-bold d-flex">
        <span class="mr-auto"><i class="fa fa-sort-alpha-asc"></i> {{ __('Edit Unit') }}</span>
        <a href="{{ route('admin.unit.index') }}" class="btn btn-secondary float-right">{{ __('Manage Unit') }}</a>
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="{{ route('admin.unit.update', $unit->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        @include('admin.unit.form')

                        <div class="form-group">
                            <a href="{{ route('admin.unit.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
