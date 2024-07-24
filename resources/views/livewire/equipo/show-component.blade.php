<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="grid grid-cols-3 bg-white p-4 m-2 rounded-md border shadow-md">
        <div class="col-span-2">
            <h2 class="text-xl font-bold">Informacion del equipo</h2>
            <span class="font-bold">Descripcion</span>
            <p class="mb-2">{{ $equipo->descripcion }}</p>
            <div class="grid grid-cols-3 mb-2">
                <p><span class="font-bold">Marca: </span>{{ $equipo->marca->nombre }}</p>
                <p><span class="font-bold">Modelo: </span>{{ $equipo->modelo }}</p>
                <p><span class="font-bold">Serie: </span>{{ $equipo->serie }}</p>
            </div>
            <p><span class="font-bold">Serietec: </span>{{ $equipo->serietec }}</p>
            <span class="font-bold">Observaciones</span>
            <p>{{ $equipo->observaciones }}</p>
            <div class="grid grid-cols-3 mb-2">
                <p><span class="font-bold">A cargo de: </span>{{ $equipo->persona?$equipo->persona->nombre:'admin' }}</p>
                <p><span class="font-bold">fecha creacion: </span>{{ date('d-M-Y', strtotime($equipo->created_at)) }}</p>
                <p><span class="font-bold">fecha actualización: </span>{{ date('d-M-Y', strtotime($equipo->updated_at)) }}</p>
            </div>
        
            <p><span class="font-bold">Cantidad de accesorios: </span>{{ $accesorios }}</p>
            <p><span class="font-bold">Cantidad de acciones: </span>{{ $acciones }}</p>
            
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
            
            {{-- <div class="flex gap-2">
                <a href="{{ route('accesorio.create', $equipo->slug) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar Accesorio</a>
                <a href="{{ route('accion.create', $equipo->slug) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar Accion</a>
            
            </div> --}}
            <div class="my-2">
                <a href="{{ route('equipo.pdf', $equipo->slug) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generar Reporte</a>
            </div>
        </div>
        <div class="justify-center">
            <h2 class="text-xl font-bold text-center">QR del equipo</h2>
            <div id="contenedorQR" class="flex justify-center p-4">{!! $qrcode !!}</div>
            <button id="descargarQR" class="inline-block mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Descargar QR</button>
        </div>
    </div>
</div>
