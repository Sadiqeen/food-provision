<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $supplier->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th colspan="5"></th>
            </tr>
            <tr>
                <th colspan="5">{{ $supplier->name }}</th>
            </tr>
            <tr>
                <th colspan="5">{{ $supplier->tel }}</th>
            </tr>
            <tr>
                <th colspan="5">{{ $supplier->email }}</th>
            </tr>
            <tr>
                <th colspan="5">{{ $supplier->address }}</th>
            </tr>
            <tr>
                <th colspan="5"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>สินค้า</td>
                <td>สินค้า</td>
                <td>แพ็ค</td>
                <td>จำนวน</td>
                <td>หน่วย</td>
            </tr>
            @foreach($supplier->product as $product)
            <tr>
                <td>{{ $product->name_en }}</td>
                <td>{{ $product->name_th }}</td>
                <td>{{ $product->desc }}</td>
                <td>{{ $product->order[0]->pivot->quantity  }}</td>
                <td>{{ $product->unit->name  }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
