<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="/css/inicio.css">
    <link rel="stylesheet" href="/css/create.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

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
                        <li><a href="">Ventas</a></li>
                        <li><a href="">Movimientos</a></li>
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
                <label for="">Stock Anterior</label>
                <input type="number" name="stock_anterior" placeholder="Stock Inicial">
                <label for="">Stock Nuevo</label>
                <input type="number" name="stock_nuevo" placeholder="Stock Minimo">
                <label for="">Motivo</label>
                <input type="text" name="motivo" placeholder="Nombre del producto" required>
                <label for="">Obervacion</label>
                <input type="text" name="observacion" placeholder="Describir observacion" required>
            </div>
            <div>
                <button type="submit">Registrar Movimiento</button>
            </div>
        </form>

        <!-- Cod. formulario que muestra los datos -->
        <h1 class="form-group2">Stock</h1>
        <div class="form-group3" id="scroll" position:sticky>
            <div>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Productos_id</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Stock_anterior</th>
                            <th>Stock_nuevo</th>
                            <th>Motivo</th>
                            <th>Observacion</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
            </div>
            <tbody class="form2">
                @foreach ($movi as $movimi)
                <tr>                                    
                    <td>{{$movimi->id}}</td>
                    <td>{{$movimi->roducto->nombre ?? 'producto no encontrado'}}</td>
                    <td>{{$movimi-pnombre}}</td>
                    <td>{{$movimi->descripcion}}</td>
                    <td>{{$movimi->precio}}</td>
                    <td>{{$movimi->stock}}</td>
                    <td>{{$movimi->stock_minimo}}</td>
                    <td>{{$movimi->estado}}</td>
                    <td><a href="{{route('produc.edit', $movimi->id)}}">Click</a></td>
                    <td>
                        <form action="{{ route('produc.destroy', $movimi->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                    
            </tbody>

            </table>
        </div>

    </main>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
</body>

</html>
