<!doctype html>
<html lang="en">
<head>
    <title></title>
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
    </style>
</head>
<body>

    <table class="custom-table" style="">
        <thead>
        <tr style="border: none !important;">
            <th scope="col" colspan="6" style="border: none !important;">
                <div style="display:inline-block;vertical-align:top;">
                    <img src="{{ public_path($host->image) }}" width="100px" align="top">
                </div>
                <div style="display:inline-block;">
                    <div class="h6">{{ $host->company }}</div>
                    <div style="font-size: 10pt;font-weight: lighter;">{{ $host->address }}</div>
                    <div style="font-size: 10pt;font-weight: lighter;">Tel : {{ $host->tel }}&nbsp;&nbsp;Email : {{ $host->email }}</div>
                </div>
            </th>
        </tr>
        <tr>
            <th scope="col" colspan="6" class="text-center">QUOTATION</th>
        </tr>
        <tr>
            <th scope="row" rowspan="3" class="text-center">To</th>
            <td rowspan="3">
                <span class="font-weight-bold">{{ $order->customer->name }}</span><br><br>
                {{ $order->customer->address }}
            </td>
            <td colspan="2">DATE</td>
            <td colspan="2" class="text-center">17/07/2020</td>
        </tr>
        <tr>
            <td colspan="2">QT No</td>
            <td colspan="2" class="text-center">{{ $order->quotation_number }}</td>
        </tr>
        <tr>
            <td colspan="2">VESSEL</td>
            <td colspan="2" class="text-center">{{ $order->vessel_name }}</td>
        </tr>
        <tr>
            <td scope="row" class="text-center">Attn</td>
            <td colspan="5">{{ $order->customer->user[0]->name }}</td>
        </tr>

        <tr>
            <td class="text-center font-weight-bold">NO</td>
            <td class="text-center font-weight-bold">ITEM DESCRIPTION</td>
            <td class="text-center font-weight-bold">PACKING</td>
            <td class="text-center font-weight-bold">QUANTITY</td>
            <td class="text-center font-weight-bold">Price/Unit</td>
            <td class="text-center font-weight-bold">TOTAL AMOUNT</td>
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
                        echo '<tr class="bg-secondary text-white"><td></td><td scope="row" colspan="5">' . $product->category->name . '</td></tr>';
                    } else {
                        $index += 1;
                        if ($category != $product->category->id) {
                            echo '<tr class="bg-secondary text-white"><td></td><td scope="row" colspan="5">' . $product->category->name . '</td></tr>';
                            $category = $product->category->id;
                        }
                    }
                @endphp
                <tr>
                    <td class="text-center">{{ $index }}</td>
                    <th scope="row">{{ $product->name_en }}</th>
                    <td class="text-center">{{ $product->desc }}</td>
                    <td class="text-center">{{ $product->price }}</td>
                    <td class="text-center">{{ $product->pivot->quantity }}</td>
                    <td class="text-center">{{ number_format($product->price * $product->pivot->quantity) }}</td>
                </tr>
                @if ($loop->last)
                    <tr>
                        <td></td>
                        <th scope="row" colspan="4" class="text-center h5 font-weight-bold">{{ __('Total (THB)') }}</th>
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
            <td colspan="5" style="border: none !important;">Delivery  Date  :  5-6 Day after receipt PO.</td>
        </tr>
        <tr style="border: none !important;">
            <td scope="row" class="text-center" style="border: none !important;"></td>
            <td colspan="5" style="border: none !important;">We hope our offer would meet your requirement and looking forward to receive yours confirm order soon.</td>
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
        <tbody>
            <tr>
                <td style="width: 70%"></td>
                <td class="text-center font-weight-bold" style="font-size: 8pt;"></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-center font-weight-bold" style="font-size: 8pt;">FN&D SERVICES AND AGENCY CO. LTD</td>
            </tr>
            <tr>
                <td></td>
                <td><img src="{{ public_path($host->image) }}" width="200px" ></td>
            </tr>
            <tr>
                <td style="width: 70%"></td>
                <td class="text-center font-weight-bold" style="font-size: 10pt;">AUTHORISED SIGNATURE</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
