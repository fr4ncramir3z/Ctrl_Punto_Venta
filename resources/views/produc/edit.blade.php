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
                <h1>Control Administrador</h1>
            </div>
            <nav>
                <div class="menu">

                    <ul class="menu-links">
                        <li><a href="{{route('produc.index')}}">Registro</a></li>
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
    <form class="formulario" action="{{ route('produc.update', $merca->id)}}" method="POST">
        @csrf
        @method('PUT')
                 <!-- Consultar e ingresar categoria -->
                <label for="">Categoria</label>
                <select name="categoria_id" required>
                    @foreach($categor as $catego)
                    <option value="{{$catego->id}}"
                    {{$merca->categoria_id == $catego->id ? 'selected' : ''}}>
                    {{$catego->nombre}}
                    </option>
                    @endforeach
                </select>

        <br>
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="{{ $merca->nombre}}">
        <br>
        <label for="">Descripcion</label>
        <input type="text" name="descripcion" value="{{ $merca->descripcion}}">
        <br>
        <label for="">Precio</label>
        <input type="number" name="precio" value="{{ $merca->precio}}">
        <br>
        <label for="">Stock</label>
        <input type="number" name="stock" value="{{ $merca->stock}}">
        <br>
        <label for="">Stock Minimo</label>
        <input type="number" name="stock_minimo" value="{{ $merca->stock_minimo}}">
        <br>
        <select name="estado" id="" class="opcion">
            <option value="Activo" {{ $merca->estado =='Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Inactivo" {{ $merca->estado =='Inactivo' ? 'selected' : '' }}>Inactivo</option>
            <option value="Eliminado">Eliminado</option>
        </select>
        <br>
        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="{{route('produc.index')}}">Regresar al inicio</a>


        </section>
    </main>
</body>

</html>
