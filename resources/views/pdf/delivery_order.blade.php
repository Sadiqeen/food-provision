<!doctype html>
<html lang="en">
<head>
    <title>{{ $order->do_number }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
            <th scope="col" colspan="8" class="text-center">Delivery Order</th>
        </tr>
        <tr>
            <th scope="row" rowspan="4" class="text-center" style="width: 30px">To</th>
            <th rowspan="4" colspan="3">
                <span class="font-weight-bold">{{ $order->customer->name }}</span><br><br>
                {{ $order->customer->address }}
            </th>
            <th colspan="2">DATE</th>
            <th colspan="2" class="text-center">{{ $order->created_at->format('d/m/Y') }}</th>
        </tr>
        <tr>
            <th colspan="2">DO No</th>
            <th colspan="2" class="text-center text-uppercase">{{ $order->do_number }}</th>
        </tr>
        <tr>
            <th colspan="2">VESSEL</th>
            <th colspan="2" class="text-center text-uppercase">{{ $order->vessel_name }}</th>
        </tr>
        <tr>
            <th colspan="2">PO No.</th>
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
            <th class="text-center font-weight-bold">ITEM DESCRIPTION</th>
            <th class="text-center font-weight-bold">QUANTITY</th>
            <th class="text-center font-weight-bold">UNIT</th>
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
                        echo '<tr class="bg-secondary text-white"><td></td><td scope="row" colspan="3">' . $product->category->name . '</td></tr>';
                    } else {
                        $index += 1;
                        if ($category != $product->category->id) {
                            echo '<tr class="bg-secondary text-white"><td></td><td scope="row" colspan="3">' . $product->category->name . '</td></tr>';
                            $category = $product->category->id;
                        }
                    }
                @endphp
                <tr>
                    <td class="text-center">{{ $index }}</td>
                    <th>{{ $product->name_en }}</th>
                    <th class="text-center">{{ $product->pivot->quantity }}</th>
                    <th class="text-center">{{ $product->unit->name }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table style="width:100%;margin-top: 5em;">
        <thead>
            <tr>
                <th></th>
                <th class="text-center font-weight-bold" style="font-size: 8pt;"></th>
                <th></th>
            </tr>
            <tr>
                <th>
                    <table style="width: 100%;">
                        <tr style="font-size: 8pt;" class="text-center">
                            <td>{{ $order->customer->name }}</td>
                        </tr>
                        <tr>
                            <td><img src="{{ public_path('uploads/F4MFsuyaX4nyU.png') }}" width="200px" height="120px" ></td>
                        </tr>
                        <tr style="font-size: 10pt;" class="text-center">
                            <td style="border-top: 1px solid black">RECEIVER BY</td>
                        </tr>
                    </table>
                </th>
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
                <th style="width: 30%"></th>
                <th class="text-center font-weight-bold" style="font-size: 10pt;" style="width: 40%"></th>
                <th style="width: 30%"></th>
            </tr>
        </thead>
    </table>
</div>
</body>
</html>
