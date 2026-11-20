@if(session('success') || session('warning'))

    <div id="notificacion"
         class="notificacion {{ session('success') ? 'exito' : 'warning' }}">

        {{ session('success') ?? session('warning') }}

    </div>

@endif

<style>
    .notificacion {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        border-radius: 8px;
        color: white;
        font-size: 25px;
        z-index: 9999;
        min-width: 250px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);

        animation: aparecer 0.5s ease;
    }

    .exito {
        background-color: #198754;
    }

    .warning {
        background-color: #dc3545;
    }

    @keyframes aparecer {
        from {
            opacity: 0;
            transform: translateX(100px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .ocultar {
        opacity: 0;
        transform: translateX(100px);
        transition: all 0.5s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const notificacion = document.getElementById('notificacion');

        if (notificacion) {

            // Mostrar durante 10 segundos
            setTimeout(function () {

                notificacion.classList.add('ocultar');

                // Eliminar del HTML
                setTimeout(function () {
                    notificacion.remove();
                }, 500);

            }, 2500);

        }

    });
</script>