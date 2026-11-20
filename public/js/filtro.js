document.addEventListener('DOMContentLoaded', function () {

    const buscador = document.getElementById('buscarProducto');
    const tabla = document.getElementById('tablaMovimientos');

    // Comprobar que existan los elementos
    if (!buscador || !tabla) {
        return;
    }

    const filas = tabla.querySelectorAll('tbody tr');

    buscador.addEventListener('input', function () {

        const texto = buscador.value.toLowerCase().trim();

        filas.forEach(function (fila) {

            // Obtener el nombre del producto
            const nombre = fila.cells[1].textContent.toLowerCase();

            // Filtrar registros
            if (nombre.includes(texto)) {

                fila.style.display = '';

            } else {

                fila.style.display = 'none';

            }

        });

    });

});