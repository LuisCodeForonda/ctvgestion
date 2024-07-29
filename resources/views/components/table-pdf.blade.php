@props(['titulo', 'user', 'fecha'])

<div class="container">
    <!-- It is never too late to be what you might have been. - George Eliot -->
    <h1 class="titulo">{{ $titulo }}</h1>
    <div>
        <p style="display: inline-block; margin-right: 2em"><strong >Solicitante: </strong>{{ $user }} </p>
        <p style="display: inline-block"><strong>fecha:</strong> {{ $fecha }}</p>
    </div>

    <table class="table">
        {{ $slot }}
    </table>

    <!-- Page Footer -->
    @if (isset($footer))
        <footer>
            <div>
                {{ $footer }}
            </div>
        </footer>
    @endif
   
</div>
