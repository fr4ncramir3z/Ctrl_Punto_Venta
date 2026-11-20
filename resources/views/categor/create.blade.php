<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="/css/inicio.css">
    <link rel="stylesheet" href="/css/create.css">

</head>

<body>
    <!--  -->
    <section>
        <header>
            <div class="logo">
                <img src="img/ImgPortada.png" alt="logo" class="Imglogo">
                <h1>Administrador</h1>
            </div>
            <nav>
                <div class="menu">

                    <ul class="menu-links">
                        <li><a href="/inicio">Inicio</a></li>
                        <li><a href="/ventas">Ventas</a></li>
                        <li><a href="/articulo">Producto</a></li>
                        <li><a href="/inventario">Inventario</a></li>
                        <input type="search" id="campo" placeholder="Buscar">
                    </ul>
                </div>
            </nav>
        </header>
    </section>

    <main id="form-principal">
        <!-- datos para ingresar una categaria -->
        <form action="{{ route('adminis.store')}}" method="POST" class="form-group1">
            @csrf
            <div class="formulario">
                <label for="">Categoria:</label>
                <input type="text" name="c_catego">
                <label for="">Estado:</label>
                <select name="c_estado" id="" class="opcion">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>

            </div>
            <div>
                <button type="submit">Registrar</button>
            </div>
        </form>

        </table>
        </div>

    </main>
</body>

</html>
