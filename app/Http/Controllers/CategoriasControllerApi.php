<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias = Categorias::all();
        return response()->json([
            'success' => true,
            'data' => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $categoria = new Categorias;
        $categoria->categoria = $request->categoria;
        
        $categoria->save();

        return response()->json([
            'success' => true,
            'message' => 'Categoria creada correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $categoria = Categorias::find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria no encontrada'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $categoria = Categorias::find($id);
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria no encontrada'
            ], 400);
        }

        $categoria->nombre_categoria = $request->nombre_categoria;        
        $categoria->save();

        return response()->json([
            'success' => true,
            'message' => 'País actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $categoria = Categorias::find($id);

        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria no encontrada'
            ], 400);
        }

        $categoria->delete();

        return response()->json([
            'success' => true,
            'message' => 'Categoria eliminada correctamente'
        ]);
    }
}
