<!doctype html>
<html lang="en">
<head>
    <title>{{ $order->invoice_number }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        .custom-table {
            font-size: 10pt;
            width: 100%;
        }

        .custom-table tr td, .custom-table tr th {
            border: 1px solid #000000;
            padding: 5px 5px;
        }

        @page  {
            margin-top: 320px;
        }

        .header {
            position:fixed; top: -266px;
        }

        /*.title:after {*/
        /*    float: right;*/
        /*    font-size: 8pt;*/
        /*    font-weight: normal;*/
        /*    content: "Page " counter(page);*/
        /*}*/

    </style>
</head>
<body>

<div class="header">
    <table class="custom-table" style="">
        <thead>
        <tr style="border: none !important;">
            <th scope="col" colspan="6" style="border: none !important;">
                <div style="display:inline-block;vertical-align:top;">
                    <img src="{{ public_path($host->image) }}" width="100px" height="65px" align="top">
                </div>
                <div style="display:inline-block;">
                    <div class="h6 title">{{ $host->company }}</div>
                    <div style="font-size: 10pt;font-weight: lighter;">{{ $host->address }}</div>
                    <div style="font-size: 10pt;font-weight: lighter;">Tel : {{ $host->tel }}&nbsp;&nbsp;Email : {{ $host->email }}</div>
                </div>
            </th>
        </tr>
        <tr>
            <th scope="col" colspan="8" class="text-center text-uppercase">Invoice/Tax Invoice</th>
        </tr>
        <tr>
            <th scope="row" rowspan="4" class="text-center" style="width: 30px">To</th>
            <th rowspan="4" colspan="3">
                <span class="font-weight-bold">{{ $order->customer->name }}</span><br><br>
                {{ $order->customer->address }}
            </th>
            <th colspan="2">DATE</th>
            <th colspan="2" class="text-center text-uppercase">{{ $order->statusDate[0]->pivot->created_at->format('d/m/Y') }}</th>
        </tr>
        <tr>
            <th colspan="2">NO</th>
            <th colspan="2" class="text-center text-uppercase">{{ $order->invoice_number }}</th>
        </tr>
        <tr>
            <th colspan="2">VESSEL</th>
            <th colspan="2" class="text-center text-uppercase">{{ $order->vessel_name }}</th>
        </tr>
        <tr>
            <th colspan="2">PO NO.</th>
            <th colspan="2" class="text-center text-uppercase">{{ $order->purchase_order_number }}</th>
        </tr>
        <tr>
            <th scope="row" class="text-center">Attn</th>
            <th colspan="7">{{ $order->customer->user[0]->name }}</th>
        </tr>
        </thead>
    </table>
</div>
<div style="">
    <table class="custom-table">
        <thead>
        <tr>
            <th class="text-center font-weight-bold" style="width: 30px">NO</th>
            <th class="text-center font-weight-bold" style="width: 200px">ITEM DESCRIPTION</th>
            <th class="text-center font-weight-bold">PACKING</th>
            <th class="text-center font-weight-bold">PRICE/UNIT</th>
            <th class="text-center font-weight-bold">QUANTITY</th>
            <th class="text-center font-weight-bold">SUB TOTAL</th>
            <th class="text-center font-weight-bold">VAT 7%</th>
            <th class="text-center font-weight-bold">TOTAL AMOUNT</th>
        </tr>
        </thead>
        <tbody>
            @php
                $index = 1;
            @endphp
            @foreach($order->product as $product)
                @php
                    if ($loop->first) {
                        $category = $product->category->id;
                        echo '<tr class="bg-secondary text-white"><td></td><td scope="row" colspan="7">' . $product->category->name . '</td></tr>';
                    } else {
                        $index += 1;
                        if ($category != $product->category->id) {
                            echo '<tr class="bg-secondary text-white"><td></td><td scope="row" colspan="7">' . $product->category->name . '</td></tr>';
                            $category = $product->category->id;
                        }
                    }
                    $vat = 0;
                @endphp
                <tr>
                    <td class="text-center">{{ $index }}</td>
                    <th scope="row">{{ $product->name_en }}</th>
                    <td class="text-center">{{ $product->desc }}</td>
                    <td class="text-center">{{ number_format($product->price) }}</td>
                    <td class="text-center">{{ $product->pivot->quantity }}</td>
                    <td class="text-center">{{ number_format($product->price * $product->pivot->quantity) }}</td>
                    <td class="text-center">{{ number_format($product->vat ? $vat = (($product->price * $product->pivot->quantity) * 7) / 100 : 0) }}</td>
                    <td class="text-center">{{ number_format($product->price * $product->pivot->quantity + $vat) }}</td>
                </tr>
                @if ($loop->last)
                    <tr>
                        <td></td>
                        <th scope="row" colspan="6" class="text-center h5 font-weight-bold">{{ __('Total (THB)') }}</th>
                        <td class="text-center h5 font-weight-bold">{{ number_format($order->total_price) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <table style="width:100%;font-size: 10pt;margin-top: 2em;">
        <tbody>
        <tr style="border: none !important;">
            <td scope="row" class="text-center" style="border: none !important;"></td>
            <td colspan="5" style="border: none !important;"></td>
        </tr>
        <tr style="border: none !important;">
            <td scope="row" class="text-center" style="border: none !important;">Remarks</td>
            <td colspan="5" style="border: none !important;">Payment Terms:   14 days after of  invoice.</td>
        </tr>
        <tr style="border: none !important;">
            <td scope="row" class="text-center" style="border: none !important;"></td>
            <td colspan="5" style="border: none !important;">All transaction in THAI BHAT(THB) currency.</td>
        </tr>
        <tr style="border: none !important;">
            <td scope="row" class="text-center" style="border: none !important;"></td>
            <td colspan="5" style="border: none !important;"></td>
        </tr>
        </tbody>
    </table>
    <table style="width:100%;margin-top: 5em;">
        <thead>
            <tr>
                <th></th>
                <th class="text-center font-weight-bold" style="font-size: 8pt;"></th>
            </tr>
            <tr>
                <th></th>
                <th>
                    <table style="width: 100%">
                        <tr style="font-size: 8pt;" class="text-center">
                            <td>FN&D SERVICES AND AGENCY CO. LTD</td>
                        </tr>
                        <tr>
                            <td><img src="{{ public_path($host->authorised_signature) }}" width="200px" height="120px" ></td>
                        </tr>
                        <tr style="font-size: 10pt;" class="text-center">
                            <td>AUTHORISED SIGNATURE</td>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th style="width: 70%"></th>
                <th class="text-center font-weight-bold" style="font-size: 10pt;"></th>
            </tr>
        </thead>
    </table>
</div>
</body>
</html>
