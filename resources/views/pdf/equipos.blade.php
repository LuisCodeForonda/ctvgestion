<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marca</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            font-size: 1.1em;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .titulo {
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
        }

        th,
        td {
            border: 1px solid;
        }

        table {
            width: 100%;
            border: 1px solid;
            border-collapse: collapse;
        }

        .head>th {
            padding: 5px 0;
        }

        .body>th {
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
    <x-table-pdf :titulo="'Reporte Equipos'" :user="$user" :fecha="$fecha">
        @foreach ($data as $equipo)
        <table>
            <tbody>
                <tr>
                    <th colspan="4">Descripcion</th>
                    <th>Fecha registro</th>
                    <td>
                        {{ $equipo->created_at }}
                    </td>
                </tr>
                <tr>
                    <td colspan="6">{{ $equipo->descripcion }}</td>
                </tr>
                <tr>
                    <th colspan="2">Marca</th>
                    <th colspan="2">Modelo</th>
                    <th colspan="2">Serie</th>
                </tr>
                <tr>
                    <td colspan="2">
                        {{ $equipo->marca->nombre }}
                    </td>
                    <td colspan="2">
                        {{ $equipo->modelo }}
                    </td>
                    <td colspan="2">
                        {{ $equipo->serie }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Serie tec
                    </th>
                    <td colspan="2">
                        {{ $equipo->serietec }}
                    </td>
                    <th>
                        Estado
                    </th>
                    <td colspan="2">
                        @if ($equipo->estado == 1)
                            Operativo
                        @endif
                        @if ($equipo->estado == 2)
                            Mantenimiento
                        @endif
                        @if ($equipo->estado == 3)
                            Stand By
                        @endif
                        @if ($equipo->estado == 4)
                            Malo
                        @endif
                    </td>
                </tr>
                
            </tbody>
        </table>
        <br>
        @endforeach

        {{-- incrustar contenido fuera del slot esto se evalua para renderizar o no esta parte --}}
        <x-slot name="footer">
            <p>Total registros: {{ $data->count() }}</p>
        </x-slot>

    </x-table-pdf>
</body>

</html>
