document.addEventListener('DOMContentLoaded', function () {

    const buscaNom = document.getElementById('buscarNombre');
    const tabla = document.getElementById('tablaMovimientos');

    // Comprobar que existan los elementos
    if (!buscaNom || !tabla) {
        return;
    }

    const filas = tabla.querySelectorAll('tbody tr');

    buscaNom.addEventListener('input', function () {

        const texto = buscaNom.value.toLowerCase().trim();

        filas.forEach(function (fila) {

            // Obtener el nombre del producto
            const nombre = fila.cells[2].textContent.toLowerCase();

            // Filtrar registros
            if (nombre.includes(texto)) {

                fila.style.display = '';

            } else {

                fila.style.display = 'none';

            }

        });

    });

});