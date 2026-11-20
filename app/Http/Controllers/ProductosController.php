<?php

namespace App\Http\Controllers;
use App\Models\categorias;
use App\Models\productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categor = categorias::all();
        $produc = productos::with('categoria')->get();
        return view ('produc.index', compact('categor','produc'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categor = categorias::all();
        return view ('produc.create', compact('categor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $merca = new productos();
        $merca->categoria_id = $request->categoria_id;
        $merca->nombre = $request->nombre;
        $merca->descripcion = $request->descripcion;
        $merca->precio = $request->precio;
        $merca->stock = $request->stock;
        $merca->stock_minimo = $request->stock_minimo;
        $merca->estado = $request->estado;

        $merca->save();
        return redirect()->route('produc.index');

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
        $merca = productos::findOrFail($id);
        $categor = categorias::all();
        return view ('produc.edit', compact('merca', 'categor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //$merca = new productos();

        $merca = productos::findOrFail($id);
        $merca->categoria_id = $request->categoria_id;
        $merca->nombre = $request->nombre;
        $merca->descripcion = $request->descripcion;
        $merca->precio = $request->precio;
        $merca->stock = $request->stock;
        $merca->stock_minimo = $request->stock_minimo;
        $merca->estado = $request->estado;

        $merca->save();
        return redirect()->route('produc.index')
            ->with('success', 'Producto actualizado. ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merca = productos::findOrfail($id);
        $merca->delete();
        return redirect()->route('produc.index');
    }
}
