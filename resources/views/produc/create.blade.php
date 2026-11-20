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
                <h1>user de Inventario</h1>
            </div>
            <nav>
                <div class="menu">

                    <ul class="menu-links">
                        <li><a href="{{route('produc.index')}}">Registro</a></li>

                    </ul>
                </div>
            </nav>
        </header>
    </section>

    <main id="form-principal">
        <!-- datos para ingresar una categaria -->
        <form action="{{ route('produc.store')}}" method="POST" class="form-group1">
            @csrf
            <div class="formulario">
                <label for="">Categoria:</label>
                <input type="text" name="c_catego">
                <label for="">Estado:</label>
                <select name="c_estado" id="" class="opcion">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>

                <h2>Datos del Producto</h2>
                <!-- datos para el ingreso de producto -->
                <label for="">Nombre</label>
                <input type="text" name="p_nombre" placeholder="Nombre del producto">
                <label for="">Descripcion</label>
                <input type="text" name="p_descripcion" placeholder="Breve descripción">
                <label for="">Precio</label>
                <input type="number" name="p_precio" placeholder="Precio del producto">
                <label for="">Stock</label>
                <input type="number" name="p_stock" placeholder="Stock Inicial">
                <label for="">Stock Minimo</label>
                <input type="number" name="p_stock_minimo" placeholder="Stock Minimo">
                <label for="">Estado</label>
                <select name="p_estado" id="" class="opcion">
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
