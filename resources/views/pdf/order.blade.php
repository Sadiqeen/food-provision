<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <td>Order no.</td>
        <td>Order from</td>
        <td>Vessel name</td>
        <td>Total</td>
        <td>Status</td>
        <td>Done on</td>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->customer->name }}</td>
            <td>{{ $order->vessel_name }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->status->status_en }}</td>
            <td>{{ $order->updated_at->format('m/d/Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
