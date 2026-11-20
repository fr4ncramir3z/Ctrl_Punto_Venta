<?php

namespace App\Http\Controllers;
use App\Models\categorias;
use App\Models\ventas;
use App\Models\productos;
use App\Models\movimientos;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
                
      //consulta de ventas y productos relacionados
        $venta = movimientos::with('producto')

        ->whereIn('id', function ($query) {

            $query->selectRaw('MAX(id)')
                ->from('movimientos')
                
                ->groupBy('producto_id');
        })
            ->orderBy('id', 'Asc')
            ->get();

        $ventas = ventas::with('producto', 'usuario')
        ->orderBy('id', 'Asc')
        ->get();

        // consultar productos para uso del formulario
        $produc = productos::all();
        $categor = categorias::all();

        // mostrar los datos
        return view('ventas.index', compact('venta', 'produc', 'categor'));

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'tipo' => 'required|in:venta,anulacion',
        'cantidad' => 'required|integer|min:1',
    ]);

    try {

        DB::transaction(function () use ($request) {

           
        // Buscar producto
            $produc = productos::where('id', $request->producto_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Obtener stock anterior
            $stock_anterior = $produc->stock;

            // Calcular nuevo stock
            if ($request->tipo == 'venta') {

                if ($request->cantidad > $stock_anterior) {
                    throw new \RuntimeException('stock_insuficiente');
                }

                $stock_nuevo = $stock_anterior - $request->cantidad;

            } elseif ($request->tipo == 'anulacion') {

                $stock_nuevo = $stock_anterior + $request->cantidad;

            }
            

            // Actualizar stock
            $produc->stock = $stock_nuevo;
            $produc->save();
            session()->flash('debug', 'Producto actualizado');


            // Registrar movimiento
            $vts = new movimientos();

            $vts->producto_id = $produc->id;
            $vts->tipo = $request->tipo;
            $vts->cantidad = $request->cantidad;
            $vts->stock_anterior = $stock_anterior;
            $vts->stock_nuevo = $stock_nuevo;
            $vts->motivo = 'Venta del dia';
            $vts->observacion = 'Ninguna';

            $vts->save();
            session()->flash('debug', 'Movimiento registrado');


            // Registrar nueva venta
            if ($request->tipo == 'venta') {

                $venta = new ventas();

                $venta->producto_id = $produc->id;
                $venta->user_id = Auth::id();
                $venta->cantidad = $request->cantidad;
                $venta->precio_unitario = $produc->precio;
                $venta->subtotal = $produc->precio * $request->cantidad;
                $venta->subtotal = $produc->precio * $request->cantidad;
                $venta->codigo_anulacion = strtoupper(Str::random(8));
                $venta->estado = 'activo';

                $venta->save();
                session()->flash('debug', 'Venta registrada');

            // Registrar venta como anulada
            } elseif ($request->tipo == 'anulacion') {

                $venta = new ventas();

                $venta->producto_id = $produc->id;
                $venta->user_id = Auth::id();
                $venta->cantidad = $request->cantidad;
                $venta->precio_unitario = $produc->precio;
                $venta->subtotal = $produc->precio * $request->cantidad;
                $venta->codigo_anulacion = strtoupper(Str::random(8));
                $venta->estado = 'Inactivo';

                $venta->save();
                session()->flash('debug', 'Anulación de Transaccion Anterior');
                
            }

        });

        return redirect()
            ->route('ventas.index')
            ->with('success', 'Transacción registrada correctamente.');

    } catch (\RuntimeException $e) {

        if ($e->getMessage() == 'stock_insuficiente') {

            return back()
                ->withInput()
                ->with('warning', 'Producto Insuficiente, Venta no efectuada.'); 
                
        }

        report($e);

        return back()
            ->withInput()
            ->with('error', 'Error al procesar la transacción.');

    } catch (\Throwable $e) {

        report($e);

        return back()
            ->withInput()
            ->with('error', 'Venta no registrada "Verificar datos".');
            
    }
}

    // Función para anular la venta mediante una serie /////////////////////////////////
    public function anular(Request $request) {
        // Validar el código ingresado 
        $request->validate([
            'codigo_anulacion' => 'required|string|max:12',
        ]);

        try {

            DB::transaction(function () use ($request) {

                // Buscar la venta y bloquear el registro
                $venta = ventas::where(
                    'codigo_anulacion',
                    $request->codigo_anulacion
                )
                ->lockForUpdate()
                ->first();

                // Comprobar que la venta exista
                if (!$venta) {
                    throw new \RuntimeException('venta_no_encontrada');
                }

                // Comprobar que la venta esté activa
                if ($venta->estado != 'activo') {
                    throw new \RuntimeException('venta_anulada');
                }

                // Buscar el producto y bloquear su registro
                $produc = productos::where('id', $venta->producto_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Obtener el stock anterior
                $stock_anterior = $produc->stock;

                // Devolver la cantidad al inventario
                $stock_nuevo = $stock_anterior + $venta->cantidad;

                // Actualizar el stock
                $produc->stock = $stock_nuevo;
                $produc->save();

                // Registrar el movimiento de anulación
                $movimiento = new movimientos();

                $movimiento->producto_id = $produc->id;
                $movimiento->tipo = 'anulacion';
                $movimiento->cantidad = $venta->cantidad;
                $movimiento->stock_anterior = $stock_anterior;
                $movimiento->stock_nuevo = $stock_nuevo;
                $movimiento->motivo = 'Anulación de venta';
                $movimiento->observacion = 'Serie: ' . $venta->codigo_anulacion;

                $movimiento->save();

                // Cambiar el estado de la venta
                $venta->estado = 'inactivo';
                $venta->save();

            });

            return redirect()
                ->route('ventas.index')
                ->with('success', 'Venta anulada correctamente. El stock ha sido restablecido.');

        } catch (\RuntimeException $e) {

            if ($e->getMessage() == 'venta_no_encontrada') {
                return back()
                    ->withInput()
                    ->with('warning', 'La serie ingresada no corresponde a ninguna venta.');
            }

            if ($e->getMessage() == 'venta_anulada') {
                return back()
                    ->withInput()
                    ->with('warning', 'Esta venta ya fue anulada anteriormente.');
            }

            report($e);

            return back()->with('error', 'No se pudo procesar la anulación.');

        } catch (\Throwable $e) {

            report($e);

            return back()
                ->withInput()
                ->with('error', 'Ocurrió un error al intentar anular la venta.');
        }
    }

        public function detalle()
        {
            $ventas = ventas::with('producto', 'usuario')
                ->orderBy('id', 'desc')
                ->get();

            return view('ventas.detalle', compact('ventas'));
        }

}
