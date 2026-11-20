<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    
    @include('layouts.mensajes')
    
</head>

<body>
    <!--  -->
    <section>
        <header>
            <div class="logo">
                <img src="{{ asset('img/ImgPortada.png') }}" alt="logo" class="Imglogo">
                
                <h1>USUARIO</h1>
            </div>
            <nav>
                <div class="menu">
                    <ul>
                        <li><a href="{{route('vadmin.index')}}">Ventas</a></li>
                    </ul>
                    
                </div>
            </nav>
        </header>
    </section>

    <main id="form-principal">

        <div class="form-group4" id="scroll">
            <form action=""></form>
            <h2>Registro de ventas</h2>

        <table border="2">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Usuario</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                    <th>Serie de anulación</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>

                @foreach($ventas as $venta)

                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>
                            {{ $venta->producto->nombre ?? 'No disponible' }}
                        </td>
                        <td>
                            {{ $venta->usuario->name ?? 'No disponible' }}
                        </td>
                        <td>{{ $venta->cantidad }}</td>
                        <td>{{ $venta->precio_unitario }}</td>
                        <td>{{ $venta->subtotal }}</td>
                        <td>{{ $venta->codigo_anulacion }}</td>
                        <td>{{ $venta->estado }}</td>
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