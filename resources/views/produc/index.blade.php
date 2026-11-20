<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="/css/inicio.css">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">

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
                        <li><a href="{{route('categor.index')}}">Categoria</a></li>
                        <li><a href="{{route('vadmin.index')}}">Ventas</a></li>
                        <li><a href="{{route('movi.index')}}">Movimiento</a></li>
                        <!-- Cierra la sesión y volviendo al login -->
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
        
        <!-- Formulario para registar un producto -->
        <form action="{{ route('produc.store')}}" method="POST" class="form-group1">
            @csrf
            <div class="formulario">
                <!-- Formulario para el ingreso de datos -->

                <h2>Nuevo Producto</h2>
                 <!-- Consultar e ingresar categoria -->
                <label for="">Categoria</label>
                <select name="categoria_id" required>
                    <option value="">Seleccionar categoria</option>
                    @foreach($categor as $catego)
                        <option value="{{$catego->id}}">
                            {{$catego->nombre}}</option>
                    @endforeach
                </select>
                
                <!-- Ingreso de producto -->
                <br><br>
                <label for="">Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre del producto" required>
                <label for="">Descripcion</label>
                <input type="text" name="descripcion" placeholder="Breve descripción" required>
                <label for="">Precio</label>
                <input type="number" name="precio" placeholder="Precio del producto" required>
                <label for="">Stock</label>
                <input type="number" name="stock" placeholder="Stock Inicial" required>
                <label for="">Stock Minimo</label>
                <input type="number" name="stock_minimo" placeholder="Stock Minimo" required>
                <label for="">Estado</label>
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
         
        <h1 class="form-group2">Control de Registro de Nuevos Productos</h1>
        
        <div class="form-group3" id="scroll">
            <div>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Id_Producto</th>
                            <th>Id_Categoria</th>
                            <th>N_Categoria</th>
                            <th>N_Producto</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>stock_minimo</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Enviar A</th>
                        </tr>
                    </thead>
            </div>
            <tbody class="form2">
                @foreach ($produc as $merca)
                <tr>                                    
                    <td>{{$merca->id}}</td>
                    <td>{{$merca->categoria_id}}</td>
                    <td>{{$merca->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>{{$merca->nombre}}</td>
                    <td>{{$merca->descripcion}}</td>
                    <td>{{$merca->precio}}</td>
                    <td>{{$merca->stock}}</td>
                    <td>{{$merca->stock_minimo}}</td>
                    <td>{{$merca->estado}}</td>
                    <td><a href="{{route('produc.edit', $merca->id)}}">Click</a></td>
                    <td>
                        <form action="{{ route('produc.destroy', $merca->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit">Papelera</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                    
            </tbody>

            </table>
        </div>

    </main>
</body>

</html>
