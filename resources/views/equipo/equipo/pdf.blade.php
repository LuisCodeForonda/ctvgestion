<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <style>
        .items{
            width: 100%;
        }
    </style>
</head>

<body>
    <table class="w-full">
        <h1>Reporte de registros</h1>
    </table>

    <p>usuario: {{Auth::user()->name}}</p>
    <div class="margin-top">
        <table style="width: 100%; background: rgb(12, 234, 34)">
            <tr>
                <th style="width: 25%;">Qty</th>
                <th style="width: 25%;">Description</th>
                <th style="width: 25%;">Price</th>
                <th style="width: 25%;">Price</th>
            </tr>
            <tr class="items">
                @foreach ($data as $item)
                    <td>
                        {{ $item['descripcion'] }}
                    </td>
                    <td>
                        {{ $item['observaciones'] }}
                    </td>
                    <td>
                        {{ $item['cantidad'] }}
                    </td>
                    <td>
                        {{ $item['serie'] }}
                    </td>
                @endforeach
            </tr>
        </table>
    </div>

    <div class="total">
        Total: {{ count($data) }}
    </div>

    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; Laravel Daily</div>
    </div>
</body>

</html>
