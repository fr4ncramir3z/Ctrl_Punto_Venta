// Codigo que recupera datos
let productos =
    JSON.parse(localStorage.getItem("productos")) || [];

// Función para agregar datos a la tabla
function Agregarproductos(codigo, producto, cantidad, precio) {

    let subtotal = cantidad * precio;

    productos.push({
        codigo: codigo,
        producto: producto,
        cantidad: cantidad,
        precio: precio,
        subtotal: subtotal
    });

    //codigo que guarda los datos en el localstorage
    //localStorage.setItem(
    //    "productos",
    //    JSON.stringify(productos)
    //);

    Mostrarproductos();
}

function Eliminarproductos(indice){
    productos.splice(indice, 1);
    Mostrarproductos();
}

// Vaciar datos de LocalStorage
function Vaciarproductos() {
    localStorage.removeItem("productos");
    productos = [];

    Mostrarproductos();
}


// función que muestra los datos
function Mostrarproductos() {

    const tabla =
        document.getElementById("tablaproductos");

    tabla.innerHTML = "";

    productos.forEach(function (item, indice) {

        tabla.innerHTML += `
                    <tr>
                        <td>${item.codigo}</td>
                        <td>${item.producto}</td>
                        <td>${item.cantidad}</td>
                        <td>${item.precio.toFixed(2)}</td>
                        <td>${item.subtotal.toFixed(2)}</td
                        <td><button type="button" onclick="Eliminarproductos(${indice})">Eliminar</button></td>
                    </tr>
                `;
    });
}

//codigo para enviar los datos al formulario
document
    .getElementById("formulario")
    .addEventListener("submit", function (event) {

        event.preventDefault();

        const codigo =
            Number(document.getElementById("codigo").value);

        const producto =
            document.getElementById("producto").value;

        const cantidad =
            Number(document.getElementById("cantidad").value);

        const precio =
            Number(document.getElementById("precio").value);

        Agregarproductos(
            codigo,
            producto,
            cantidad,
            precio
        )

        this.reset();

    })

// codigo para mostrar los datos al iniciar la pagina
Mostrarproductos();