@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-shopping-bag fa-lg mr-2" aria-hidden="true"></i> {{ __('Add Order') }}</span>
            <a type="button" href="{{ route( auth()->user()->position . '.order.cart') }}"  class="btn btn-success">{{ __('Confirm order') }}</a>
        </h3>
        <div class="card">
            <div class="card-body">
                {{-- Top select option --}}
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="category">{{ __('Category') }}</label>
                            @php
                                $querySort = '';
                                if ( request()->query('sort') )
                                {
                                     $querySort = '&sort=' . request()->query('sort');
                                }
                                if ( request()->query('search') )
                                {
                                     $querySearch = '&search=' . request()->query('search');
                                }
                            @endphp
                            <select class="form-control border selectpicker" data-size="10" name="category" id="category"
                                    onchange="location = '{{ route( auth()->user()->position . '.order.create') }}?category=' + this.options[this.selectedIndex].value + '{{ $querySort ?? '' }}{{ $querySearch ?? '' }}'">
                                <option value="All">{{ __('All') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}" {{ request()->get('category') == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="category">{{ __('Sort by') }}</label>
                            @php
                            $queryCategory = '';
                            if ( request()->query('category') )
                            {
                                 $queryCategory = 'category=' . request()->query('category'). '&';
                            }
                            @endphp
                            <select class="form-control border selectpicker" data-size="10" name="sort" id="sort"
                                    onchange="location = '{{ route( auth()->user()->position . '.order.create') }}?{{ $queryCategory ?? '' }}sort=' + this.options[this.selectedIndex].value + '{{ $querySearch ?? '' }}'">
                                <option value="A-Z"  {{ request()->get('sort') == 'A-Z' ? 'selected' : '' }}>A-Z</option>
                                <option value="Z-A"  {{ request()->get('sort') == 'Z-A' ? 'selected' : '' }}>Z-A</option>
                                <option value="Price Min to Max"  {{ request()->get('sort') == 'Price Min to Max' ? 'selected' : '' }}>Price Min to Max</option>
                                <option value="Price Max to Min"  {{ request()->get('sort') == 'Price Max to Min' ? 'selected' : '' }}>Price Max to Min</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <form method="get" action="{{ route( auth()->user()->position . '.order.create', request()->query()) }}">
                            <label for="search">{{ __('Search') }}</label>
                            <div class="input-group mb-3">
                                @if (request()->query('category'))
                                    <input type="hidden" name="category" value="{{ request()->query('category') }}">
                                @endif
                                @if (request()->query('sort'))
                                    <input type="hidden" name="sort" value="{{ request()->query('sort') }}">
                                @endif
                                <input type="text" class="form-control" value="{{ request()->query('search') ?? '' }}" name="search" placeholder="Product name" aria-describedby="search">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit" id="search"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Products list --}}
                <div class="row">
                    @if (!$products->isNotEmpty())
                        <div class="col-12 d-flex justify-content-center mt-5">
                            <h3>{{ __('No product found') }}</h3>
                        </div>
                    @endif
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-4 mt-3">
                            <img src="{{ $product->image ? asset($product->image) : asset('imgs/placeholder.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card">
                                <div class="card-body text-center">
                                    <span class="text-success">{{ $product->category->name }}</span>
                                    <h5 class="card-title">{{ $product->name }}
                                        @if ($product->desc)
                                            <span>{{ $product->desc }}</span>
                                        @endif
                                        @if ($product->vat)
                                            &nbsp;&nbsp;<i  style="font-size: 0.6rem;" class="fa fa-percent bg-secondary text-white p-1 rounded-lg"></i>
                                        @endif
                                    </h5>
                                    @if ($product->vat)
                                        <h6 class="text-danger">{{ number_format($product->price + (($product->price * 7) / 100)) }} ฿</h6>
                                    @else
                                        <h6 class="text-danger">{{ number_format($product->price) }} ฿</h6>
                                    @endif
                                    {{-- If product in cart --}}
                                    @if ( isset( Session::get('order')[$product->category_id]['products'][$product->id] ) )
                                    <form method="post" action="{{ route( auth()->user()->position . '.order.update.item', $product->id) }}">
                                        @csrf
                                        <div class="row mt-3">
                                            <div class="col-12 mb-3">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="quantity" min="0" value="{{ Session::get('order')[$product->category_id]['products'][$product->id]['quantity'] }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">{{ $product->unit->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary btn-block py-2" id="product-{{ $product->id }}">{{ __('Update quantity') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    @else
                                    <form method="post" action="{{ route( auth()->user()->position . '.order.add.item', $product->id) }}">
                                        @csrf
                                        <div class="row mt-3">
                                            <div class="col-12 mb-3">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="quantity" min="0" value="0" onkeyup="enableAddToCart(this, {{ $product->id }})" onkeydown="$(this).trigger('onkeyup')" onchange="$(this).trigger('onkeyup')">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">{{ $product->unit->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success btn-block py-2 disabled" disabled="" id="product-{{ $product->id }}">{{ __('Add to cart') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($products->hasPages())
                        <div class="col-12 d-flex justify-content-center mt-5">
                            <div class="d-none d-md-block">
                                {{ $products->onEachSide(3)->appends(request()->query())->links() }}
                            </div>
                            <div class="d-md-none">
                                {{ $products->appends(request()->query())->links('layouts.paginate') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route( auth()->user()->position . '.order.cart') }}" class="cart bg-danger rounded-circle text-white text-decoration-none">
        <span id="total" class="cart-price" >{{ number_format(Session::get('total', '0')) }}</span>
        <i class="fa fa-shopping-bag fa-2x"></i>
    </a>
@endsection

@push('style')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
@endpush

@push('script')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>
    <script>
        const enableAddToCart = function (el, id) {
            if ($(el).val() > 0) {
                $('#product-' + id).removeClass('disabled').attr('disabled', false)
            } else {
                $('#product-' + id).addClass('disabled').attr('disabled', true)
            }
        }
    </script>
@endpush
