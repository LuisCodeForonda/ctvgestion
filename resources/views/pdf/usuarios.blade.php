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
    <x-table-pdf :titulo="'Reporte Usuarios'" :user="$user" :fecha="$fecha">
        <thead class="">
            <tr class="head">
                <th scope="" class="">
                    Item
                </th>
                <th scope="" class="">
                    Nombre
                </th>
                <th scope="" class="">
                    Rol
                </th>
                <th scope="" class="">
                    Cuenta
                </th>
                <th scope="" class="">
                    Registrado
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
                        {{ $item->name }}
                    </th>
                    <th scope="" class="">
                        {{ $item->getRoleNames()->first() }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if ($item->enabled == 1)
                            <span class="text-green-600">enable</span>
                        @else
                            <span class="text-red-600">disabled</span>
                        @endif
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
    


    