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
                        <li><a href="{{route('categor.index')}}">Categoria</a></li>
                        <li><a href="{{route('produc.index')}}">Registro</a></li>
                        <li><a href="{{route('vadmin.index')}}">Ventas</a></li>
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
        <form action="{{ route('movi.store')}}" method="POST" class="form-group1">
            @csrf
            <div class="formulario">

                <!-- Consultar e ingresar producto -->
                <label for="">Producto</label>

                <select name="producto_id" required>
                    <option value="">Seleccionar producto</option>
                    @foreach($produc as $merca)
                        <option value="{{$merca->id}}">
                            {{$merca->nombre}}</option>
                    @endforeach

                </select>
                <h2>Registro de movimiento</h2>
                <!-- datos para el ingreso de producto -->
                 <label for="">Tipo de movimiento</label>
                 <select name="tipo" class="opcion" required>
                    <option value="entrada">entrada</option>
                    <option value="salida">salida</option>
                    <option value="ajuste">ajuste</option>
                </select>
                <label for="">Cantidad</label>
                <input type="number" name="cantidad" placeholder="Breve descripción" required>

                <label for="">Motivo</label>
                <input type="text" name="motivo" placeholder="Nombre del producto" required>
                <label for="">Obervacion</label>
                <input type="text" name="observacion" placeholder="Describir observacion" required>
            </div>
            <div>
                <button type="submit">Registrar Movimiento</button>
            </div>

            <h1>Buscar</h1>
                <div class="buscador">
                    <input
                        type="text"
                        id="buscarProducto"
                        placeholder="Buscar producto por Id..."
                        autocomplete="off"
                    >
                </div>
                <div class="buscaNom">
                    <input
                        type="text"
                        id="buscarNombre"
                        placeholder="Buscar producto por nombre..."
                        autocomplete="off"
                    >
                </div>


        </form>

        <!-- Cod. formulario que muestra los datos -->
        <div class="form-group2">
            <h1>Control de Registro de Movimientos Realizados</h1><br>
            
        </div>
        
        <div class="form-group3" id="scroll" position:sticky>
            <div>
                <table id="tablaMovimientos" border="1"> <!-- ID para filtrar por nombre -->
                    <thead>
                        <tr>
                            <th>No.Regis_Id</th>
                            <th>Producto_Id</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Stock_anterior</th>
                            <th>Cantidad</th>
                            <th>Stock_nuevo</th>
                            <th>Motivo</th>
                            <th>Observacion</th>
                        </tr>
                    </thead>
            </div>
            <tbody class="form2">
                @foreach ($movi as $movimi)
                <tr>                                    
                    <td>{{$movimi->id}}</td>
                    <td>{{$movimi->producto->categoria_id ?? 'producto no encontrado'}}</td>
                    <td>{{$movimi->producto->nombre ?? 'producto no encontrado'}}</td>
                    <td>{{$movimi->tipo}}</td>
                    <td>{{$movimi->stock_anterior}}</td>
                    <td>{{$movimi->cantidad}}</td>
                    <td>{{$movimi->stock_nuevo}}</td>
                    <td>{{$movimi->motivo}}</td>
                    <td>{{$movimi->observacion}}</td>
                </tr>
                @endforeach
                    
            </tbody>

            </table>
        </div>

    </main>
    <script src="{{ asset('js/filtro.js') }}"></script>
    <script src="{{ asset('js/filtronom.js') }}"></script>

</body>

</html>
