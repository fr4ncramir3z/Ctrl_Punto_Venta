<?php

namespace App\Http\Controllers;
use App\Models\movimientos;
use App\Models\productos;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
    // consulta de movimientos y productos relacionados
        $movi = movimientos::with('producto')
            ->orderBy('id', 'Asc')
            ->get();

        // consultar productos para uso del formulario
        $produc = productos::all();

        // mostrar los datos
        return view('movi.index', compact('movi', 'produc'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produc = productos::all();

        return view('movi.create', compact('produc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|in:entrada,salida, venta, anulacion',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'nullable|string',
            'observacion' => 'nullable|string'
        ]);

        try {

            DB::transaction(function () use ($request) {

                // Busqueda de producto 
                $produc = productos::where('id', $request->producto_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // Busqueda de stock anterior
                $stock_anterior = $produc->stock;

                // Calcular nuevo stock
                if ($request->tipo == 'entrada') {

                    $stock_nuevo = $stock_anterior + $request->cantidad;

                } else {

                    if ($request->cantidad > $stock_anterior) {
                        throw new \Exception('Stock insuficiente.');
                    }

                    $stock_nuevo = $stock_anterior - $request->cantidad;
                } 

                // Actualizar stock del producto
                $produc->stock = $stock_nuevo;
                $produc->save();

                // Registrar movimiento
                $movimi = new movimientos();

                $movimi->producto_id = $produc->id;
                $movimi->tipo = $request->tipo;
                $movimi->cantidad = $request->cantidad;
                $movimi->stock_anterior = $stock_anterior;
                $movimi->stock_nuevo = $stock_nuevo;
                $movimi->motivo = $request->motivo;
                $movimi->observacion = $request->observacion;

                $movimi->save();

            });

            return redirect()
                ->route('movi.index')
                ->with('success', 'Movimiento registrado correctamente.');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movimi = movimientos::findOrFail($id);
        return view ('movi.edit', compact('movimi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movimi = new movimientos()::findOrFail($id);
        $movimi->pnombre = $request->pnombre;
        $movimi->pdescripcion = $request->pdescripcion;
        $movimi->pprecio = $request->pprecio;
        $movimi->pstock = $request->pstock;
        $movimi->pstock_minimo = $request->pstock_minimo;
        $movimi->pestado = $request->pestado;

        $movimi->save();
        return redirect()->route('movi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movimi = movimientos::findOrfail($id);
        $movimi->delete();
        return redirect()->route('movi.index');
    }
}
