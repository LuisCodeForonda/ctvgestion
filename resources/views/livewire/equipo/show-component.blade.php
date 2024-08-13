<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <div class="grid gap-4 grid-cols-9 bg-white p-4 m-2 rounded-md border shadow-md">
        <h1 class="col-span-9">Informacion del Equipo</h1>
        <div class="col-span-3">
            <span class="font-bold">Descripcion</span>
            <p class="mb-2">{{ $equipo->descripcion }}</p>
        </div>
        <div class="col-span-3">
            <span class="font-bold">Observaciones</span>
            <p>{{ $equipo->observaciones }}</p>
        </div>
        <div class="col-span-3 row-span-6 items-center">
            <h2 class="text-xl font-bold text-center">QR del equipo</h2>
            <div id="contenedorQR" class="flex justify-center p-4">{!! $qrcode !!}</div>
            <button id="descargarQR"
                class="mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Descargar
                QR</button>
        </div>
        <div class="col-span-2">
            <p><span class="font-bold">Marca: </span>{{ $equipo->marca->nombre }}</p>
        </div>
        <div class="col-span-2">
            <p><span class="font-bold">Modelo: </span>{{ $equipo->modelo }}</p>
        </div>
        <div class="col-span-2">
            <p><span class="font-bold">Serie: </span>{{ $equipo->serie }}</p>
        </div>
        <div class="col-span-2">
            <p><span class="font-bold">Serietec: </span>{{ $equipo->serietec }}</p>
        </div>
        <div class="col-span-2">
            <p><span class="font-bold">A cargo de: </span>{{ $equipo->persona ? $equipo->persona->nombre : 'admin' }}
            </p>
        </div>
        <div class="col-span-2">
            <p><span class="font-bold">fecha creacion: </span>{{ date('d-M-Y', strtotime($equipo->created_at)) }}</p>
        </div>

        <div class="col-span-2">
            <p><span class="font-bold">Cantidad de accesorios: </span>{{ $accesorios }}</p>
        </div>
        <div class="col-span-2">
            <p><span class="font-bold">Cantidad de acciones: </span>{{ $acciones }}</p>
        </div>
        <div class="col-span-2">
            @if ($equipo->estado == 1)
                <p class="font-bold">Estado actual: <span class=" text-green-600">Operativo</span></p>
            @endif
            @if ($equipo->estado == 2)
                <p class="font-bold">Estado actual: <span class=" text-yellow-600">Mantenimiento</span></p>
            @endif
            @if ($equipo->estado == 3)
                <p class="font-bold">Estado actual: <span class=" text-blue-600">Stand-by</span></p>
            @endif
            @if ($equipo->estado == 4)
                <p class="font-bold">Estado actual: <span class=" text-red-600">Malo</span></p>
            @endif
        </div>

        <div class="col-span-6">
            <div class="flex ">
                <a href="{{ route('equipo.pdf', $equipo->slug) }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generar
                    Reporte</a>
                <a href="{{ route('equipo.pdf', $equipo->slug) }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generar
                    Reporte</a>
            </div>
        </div>
    </div>
</div>
