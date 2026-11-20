<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/create.css">
    @include('layouts.mensajes')

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
                        <li><a href="{{route('produc.index')}}">Registro</a></li>
                        <li><a href="{{route('vadmin.index')}}">Ventas</a></li>
                        <li><a href="{{route('movi.index')}}">Movimiento</a></li>
                        <form class="form-group" method="POST" action="{{ route('logout') }}">
                        @csrf
                            <button type="submit" class="btn-salir">
                                Cerrar sesión
                            </button>
                        </form>
                    </ul>
                </div>
            </nav>
        </header>
    </section>

    <main id="form-principal">
        <!-- datos para ingresar una categaria -->
        <form action="{{ route('categor.store')}}" method="POST" class="form-group1">
            @csrf
            <div class="formulario">

                <h2>Nueva Categoria</h2>
                <label for="">Categoria:</label>
                <input type="text" name="nombre" required>
                <label for="">Estado:</label>
                <select name="estado" id="" class="opcion">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
            <div>
                <button type="submit">Registrar</button>
            </div>
        </form>

        <!-- Cod. formulario que muestra los datos -->
        <h1 class="form-group2">Control de Registro de Nuevas Categorias</h1>
        <div class="form-group3" id="scroll">
            <div>
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>N_Categoria</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Enviar A</th>
                        </tr>
                    </thead>
            </div>
            <tbody class="form2">
                @foreach ($categor as $catego)
                <tr>
                    <td>{{$catego->id}}</td>
                    <td>{{$catego->nombre}}</td>
                    <td>{{$catego->estado}}</td>
                    <td><a href="{{route('categor.edit', $catego->id)}}">Click</a></td>
                    <td>
                        <form action="{{ route('categor.destroy', $catego->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit">Papelera</button>
                        </form>
                    </td>
                @endforeach
            </tbody>

            </table>
        </div>

    </main>
</body>

</html>
