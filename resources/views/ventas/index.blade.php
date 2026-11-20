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
                <h1>USUARIO</h1>
            </div>
            <nav>
                <div class="menu">
                    <ul>
                        <li><a href="{{route('ventas.detalle')}}">Detalle</a></li>
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
         <div class="form-group1">
        <form action="{{ route('ventas.store')}}" method="POST">
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
                <h2>Registro de Venta</h2>
                <!-- datos para el ingreso de producto -->
                 <label for="">Tipo de transacción</label>
                 <select name="tipo" class="opcion" required>
                    <option value="venta">venta</option>
                </select>
                <label for="">Cantidad</label>
                <input type="number" name="cantidad" placeholder="Ingrese Cantidad" required>
                <button type="submit">Registrar Movimiento</button>
                
                <div> <!-- Buscador -->
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

                </div>
            </div>
            
            
        </form>
                <div class="formulario"> <!-- Cod. anular por serie -->
                    <form action="{{ route('ventas.anular') }}" method="POST">
                        @csrf

                        <label for="codigo_anulacion">
                            <h1>Serie de anulación:</h1>
                        </label>

                        <input
                            type="text"
                            name="codigo_anulacion"
                            id="codigo_anulacion"
                            maxlength="12"
                            placeholder="Ingrese la serie"
                            value="{{ old('codigo_anulacion') }}"
                            required
                        >

                        <button type="submit">
                            Anular venta
                        </button>

                    </form>
                </div>
    </div>


        <!-- Cod. formulario que muestra los datos -->
        <div class="form-group2">
            <h1>Control de Ventas</h1><br>
            
        </div>
        
        <div class="form-group3" id="scroll" position:sticky>
            <div>
                <table id="tablaMovimientos" border="1"> <!-- ID para filtrar por nombre -->
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>NOMBRE DEL PRODUCTO</th>
                            <th>DESCRIPCON</th>
                            <th>EXISTENCIA</th>
                     
                    
                        </tr>
                    </thead>
            </div>
            <tbody class="form2">
                @foreach ($venta as $vts)
                <tr>                                    
                    <td>{{$vts->producto->id ?? 'producto no encontrado'}}</td>
                    <td>{{$vts->producto->nombre ?? 'producto no encontrado'}}</td>
                    <td>{{$vts->producto->descripcion ?? 'producto no encontrado'}}</td>
                    <td>{{$vts->producto->stock ?? 'producto no encontrado'}}</td>

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
