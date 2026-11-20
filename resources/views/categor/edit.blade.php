<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="/css/inicio.css">
    <link rel="stylesheet" href="/css/create.css">

</head>

<body>
    <section>
        <header>
            <div class="logo">
                <img src="/img/ImgPortada.png" alt="logo" class="Imglogo">
                <h1>Administrador</h1>
            </div>
            <nav>
                <div class="menu">

                    <ul class="menu-links">
                        <li><a href="{{route('categor.index')}}">Inicio</a></li>
                        <li><a href="">Ventas</a></li>
                        <li><a href="">Producto</a></li>

                    </ul>
                </div>
            </nav>
        </header>
    </section>

    <main id="form-principal">
        <section class="form-group1">
            <h1>Editar registro</h1>
    <form class="formulario" action="{{ route('categor.update', $catego->id)}}" method="POST">
        @csrf
        @method('PUT')
        <br>
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="{{ $catego->nombre}}">
        <br>
        <select name="estado" id="" class="opcion">
            <option value="Activo" {{ $catego->estado =='Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Inactivo" {{ $catego->estado =='Inactivo' ? 'selected' : '' }}>Inactivo</option>
            <option value="Eliminado">Eliminado</option>
        </select>
        <br>
        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="{{route('categor.index')}}">Regresar al inicio</a>


        </section>
    </main>
</body>

</html>
