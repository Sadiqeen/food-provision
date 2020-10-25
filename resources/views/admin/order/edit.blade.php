@extends('layouts.app')

@section('title')
    {{ __('Edit Quotation') }}
@endsection

@section('content')
    <div class="container">
        <h3 class="my-3 text-uppercase font-weight-bold d-flex">
            <span class="mr-auto"><i class="fa fa-shopping-bag fa-lg mr-2" aria-hidden="true"></i> {{ __('Edit Quotation') }}</span>
            <a type="button" href="{{ route('admin.order.index') }}"
               class="btn btn-secondary">{{ __('Manage Order') }}</a>
        </h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mt-4">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ __('Product') }}</th>
                            <th scope="col" class="text-center">{{ __('Packing') }}</th>
                            <th scope="col" class="text-center">{{ __('Price') }}/{{__('Unit') }}</th>
                            <th scope="col" class="text-center">{{ __('Quantity') }}</th>
                            <th scope="col" class="text-center">{{ __('Subtotal') }}</th>
                            <th scope="col" class="text-center">{{ __('VAT 7 %') }}</th>
                            <th scope="col" class="text-center">{{ __('Total amount') }}</th>
                            <th scope="col" class="text-center">{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->product as $product)
                            @php
                                if ($loop->first) {
                                    $category = $product->category->id;
                                    echo '<tr class="bg-secondary text-white"><th scope="row" colspan="8">' . $product->category->name . '</th></tr>';
                                } else {
                                    if ($category != $product->category->id) {
                                        echo '<tr class="bg-secondary text-white"><th scope="row" colspan="8">' . $product->category->name . '</th></tr>';
                                        $category = $product->category->id;
                                    }
                                }

                                $vat = 0;
                            @endphp
                            <tr>
                                <th scope="row" id="p-{{ $product->id }}-name">{{ $product->name }}</th>
                                <td class="text-center" id="p-{{ $product->id }}-desc">{{ $product->desc }}</td>
                                <td class="text-center">
                                    <span id="p-{{ $product->id }}-price"
                                          data-main="{{ $product->price }}">
                                        {{ (int) $product->calculate->price == $product->calculate->price
                                            ? number_format($product->calculate->price)
                                            : number_format($product->calculate->price, 2)}}
                                    </span>
                                </td>
                                <td class="text-center" id="p-{{ $product->id }}-quantity">
                                    {{ (int) $product->calculate->quantity == $product->calculate->quantity
                                            ? number_format($product->calculate->quantity)
                                            : number_format($product->calculate->quantity, 2)}}
                                </td>
                                <td class="text-center" id="p-{{ $product->id }}-subtotal">
                                    {{ (int) $product->calculate->sub_total == $product->calculate->sub_total
                                            ? number_format($product->calculate->sub_total)
                                            : number_format($product->calculate->sub_total, 2)}}
                                </td>
                                <td class="text-center" id="p-{{ $product->id }}-vat">
                                    {{ (int) $product->calculate->vat == $product->calculate->vat
                                            ? number_format($product->calculate->vat)
                                            : number_format($product->calculate->vat, 2)}}
                                </td>
                                <td class="text-center" id="p-{{ $product->id }}-total">
                                    {{ number_format($product->calculate->total_amount, 2)}}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                                       onclick="showEditData({{ $product->id }}, '{{ route('admin.quote.price.update', [$order->id, $product->id]) }}')">{{ __('Edit') }}</a>
                                </td>
                            </tr>
                            @if ($loop->last)
                                <tr>
                                    <td scope="row" colspan="6"
                                        class="text-center text-danger">{{ __('Discount') }} (THB)
                                    </td>
                                    <td class="text-center text-danger" id="discount">{{ $order->discount ?? 0 }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                                           onclick="showDiscount()"
                                        >{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" colspan="6"
                                        class="text-center h5 font-weight-bold">{{ __('Total') }} (THB)
                                    </td>
                                    <td class="h5 font-weight-bold text-center"
                                        id="total">{{ number_format($order->total_price, 2) }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  edit modal  --}}
    <div class="modal fade" tabindex="-1" id="edit-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Edit') }} <span id="edit-title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col">
                            {{ __('Product') }} <span class="float-right">:</span>
                        </div>
                        <div class="col">
                            <span id="edit-product"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            {{ __('Pack') }} <span class="float-right">:</span>
                        </div>
                        <div class="col">
                            <span id="edit-pack"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            {{ __('Price') }}/{{__('Unit') }} <span class="float-right">:</span>
                        </div>
                        <div class="col">
                            <input class="form-control form-control-sm" id="edit-price" type="number">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            {{ __('Quantity') }} <span class="float-right">:</span>
                        </div>
                        <div class="col">
                            <span id="edit-quantity"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            {{ __('Subtotal') }} <span class="float-right">:</span>
                        </div>
                        <div class="col">
                            <span id="edit-subtotal"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            {{ __('Vat') }} 7% <span class="float-right">:</span>
                        </div>
                        <div class="col">
                            <span id="edit-vat"></span>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            {{ __('Total amount') }} <span class="float-right">:</span>
                        </div>
                        <div class="col">
                            <span id="edit-total"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" href="javascript:void(0)" id="edit-submit"
                       class="btn btn-success m-auto">{{ __('Save') }}</a>
                </div>
            </div>
        </div>
    </div>

    {{--  discount modal  --}}
    <div class="modal fade" tabindex="-1" id="discount-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Discount') }} <span id="edit-title"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="discount-total" class="col-sm-4 col-form-label">{{ __('Total') }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control text-center" id="discount-total" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="discount" class="col-sm-4 col-form-label">{{ __('Discount') }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control text-center" id="discount-value" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="after-discount-total"
                               class="col-sm-4 col-form-label">{{ __('After discount') }}</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control text-center" id="after-discount-total" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" href="javascript:void(0)"
                       class="btn btn-success m-auto" onclick="updateDiscount()">{{ __('Save') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $("#discount-value").change(function () {
            let discount = $(this).val()
            let total = $('#discount-total').val()
            let after_discount = total - discount

            if (discount < 0 || !discount) {
                $(this).val(0)
            } else if (discount > (total/2)) {
                $(this).val(total/2)
            } else {
                $('#after-discount-total').val( after_discount )
            }
        })

        $("#edit-price").change(function () {
            let price = parseFloat($(this).val())
            let max = parseFloat($(this).attr('max'))
            let quantity = parseFloat($('#edit-quantity').text())
            let vat = 0
            let subtotal = 0

            if (price < (max / 2)) {
                $(this).val(max / 2)
            }
            if (price > (max)) {
                $(this).val(max)
            }

            price = parseFloat($(this).val()).toFixed(2)
            subtotal = price * quantity
            vat = (subtotal * 7) / 100
            $('#edit-subtotal').text(subtotal.toLocaleString())
            if ($('#edit-vat').text() != 0) {
                let total = parseFloat(subtotal + vat)
                if (vat % 1 == 0) {
                    $('#edit-vat').text(vat.toLocaleString())
                } else {
                    $('#edit-vat').text(vat.toFixed(2).toLocaleString())
                }
                $('#edit-total').text(parseFloat(total.toFixed(2)).toLocaleString())
            } else {
                $('#edit-total').text(parseFloat(subtotal.toFixed(2)).toLocaleString())
            }
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        const showDiscount = function () {
            let total = parseFloat($('#total').text().replace(/,/g, ''))
            let discount = parseFloat($('#discount').text().replace(/,/g, ''))
            $('#discount-total').val(total + discount)
            $('#discount-value').val(discount)
            $('#after-discount-total').val(total)
            $('#discount-modal').modal('show');
        }

        const updateDiscount = function () {
            let discount = $('#discount-value').val()

            $.ajax({
                url: '{{ route('admin.quote.discount.update', $order->id) }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    discount: discount
                },
                success: function (res) {
                    if (res.status === "success") {
                        $('#discount').text(discount)
                        $('#total').text(res.data.total_amount)
                        $('#discount-modal').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'Update discount success'
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something going wrong please contact developer'
                        })
                    }
                }
            });
        }

        const showEditData = function (id, url) {
            let data_id = '#p-' + id + '-'
            let price = parseFloat($(data_id + 'price').text().replace(/,/g, ''))
            let max_price = $(data_id + 'price').data('main')
            $('#edit-title').text($(data_id + 'name').text())
            $('#edit-product').text($(data_id + 'name').text())
            $('#edit-pack').text($(data_id + 'desc').text())
            $('#edit-price').val(price)
                .attr('min', max_price / 2)
                .attr('max', max_price).attr('data-id', id)
            $('#edit-quantity').text($(data_id + 'quantity').text())
            $('#edit-vat').text($(data_id + 'vat').text())
            $('#edit-subtotal').text($(data_id + 'subtotal').text())
            $('#edit-total').text($(data_id + 'total').text())
            $('#edit-submit').attr('onclick', 'updatePrice( \"' + url + '\" )')
            $('#edit-modal').modal('show')
        }

        const updatePrice = function (url) {
            let price = $('#edit-price')
            price.attr('readonly', true)
            $('#edit-submit').attr('disabled', true).addClass('disabled').text('Loading')

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    price: price.val()
                },
                success: function (res) {
                    if (res.status === "success") {
                        $('#p-' + res.data.product + '-price').text(res.data.price.toLocaleString())
                        $('#p-' + res.data.product + '-vat').text($('#edit-vat').text())
                        $('#p-' + res.data.product + '-subtotal').text($('#edit-subtotal').text())
                        $('#p-' + res.data.product + '-total').text($('#edit-total').text())
                        $('#total').text(res.data.total_amount)
                        $('#edit-price').attr('readonly', false)
                        $('#edit-submit').attr('disabled', false).removeClass('disabled').text('{{ __('Save') }}')
                        $('#edit-modal').modal('hide')
                        Toast.fire({
                            icon: 'success',
                            title: 'Update price success'
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something going wrong please contact developer'
                        })
                    }
                }
            });
        }
    </script>
@endpush
