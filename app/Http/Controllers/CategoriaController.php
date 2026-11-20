<?php

namespace App\Http\Controllers;
use App\Models\categorias;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categor = categorias::all();
        return view ('categor.index', compact('categor'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('categor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $catego = new categorias();
        $catego->nombre = $request->nombre;
        $catego->estado = $request->estado;

        $catego->save();
        return redirect()->route('categor.index');

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
        $catego = categorias::findOrFail($id);
        return view ('categor.edit', compact('catego'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $catego = new categorias()::findOrFail($id);
        $catego->nombre = $request->nombre;
        $catego->estado = $request->estado;

        $catego->save();
        return redirect()->route('categor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catego = categorias::findOrfail($id);
        $catego->delete();
        return redirect()->route('categor.index');
    }


}