<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marca</title>
    <style>
        .container{
            max-width: 1200px;
            margin: 0 auto;
            font-size: 1.1em;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .titulo{
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
        }
        th, td {
            border: 1px solid;
        }
        table{
            width: 100%;
            border: 1px solid;
            border-collapse: collapse;
        }
        .head > th{
            padding: 5px 0;
        }
        .body > th{
            font-weight: initial;
            padding: 5px 0;
        }
        .prosa {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        
    </style>
</head>
<body>
    <x-table-pdf :titulo="'Reporte Marcas'" :user="$user" :fecha="$fecha">
        <thead class="">
            <tr class="head">
                <th scope="" class="">
                    Item
                </th>
                <th scope="" class="">
                    Nombre
                </th>
                <th scope="" class="">
                    Fecha de registro
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="body">
                    <th scope="" class="">
                        {{ $item->id }}
                    </th>
                    <th scope="" class="">
                        {{ $item->nombre }}
                    </th>
                    <th scope="" class="">
                        {{ date('d-M-Y', strtotime($item->created_at)) }}
                    </th>
                </tr>
            @endforeach
        </tbody>
        
        {{-- incrustar contenido fuera del slot esto se evalua para renderizar o no esta parte --}}
        <x-slot name="footer">
            <p>Total registros: {{ $data->count() }}</p>
        </x-slot>

    </x-table-pdf>
</body>
</html>
    

