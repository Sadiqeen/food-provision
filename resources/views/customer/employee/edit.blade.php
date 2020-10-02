@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-user fa-lg mr-2" aria-hidden="true"></i> {{ __('Add Employee') }}</span>
            <a type="button" href="{{ route('customer.employee.index') }}"
               class="btn btn-secondary">{{ __('Manage Employee') }}</a>
        </h3>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customer.employee.update', $employee->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            @include('customer.employee.form')
                            <div class="form-group">
                                <a type="button" href="{{ route('customer.employee.index') }}" class="btn btn-Danger">{{ __('Cancel') }}</a>
                                <button type="submit" class="btn btn-success float-right">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
