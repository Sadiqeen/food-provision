@extends('layouts.app')

@section('title')
{{ __('Supplier') }}
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <suppier-index url="{{ route('admin.supplier.api') }}"></suppier-index>
        </div>
    </div>
</div>
@endsection
