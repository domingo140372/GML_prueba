<?php

namespace App\Http\Controllers;

use App\Models\Paises;
use Illuminate\Http\Request;

class PaisesControllerApi extends Controller
{
    /**
     * Muestra la lista de Paises.
     */
    public function index()
    {
        //
        $paises = Paises::all();
        return response()->json([
            'success' => true,
            'data' => $paises
        ]);
    }

    /**
     * Se gusrda un nuevo pais en la BD.
     */
    public function store(Request $request)
    {
        //
        $pais = new Paises;
        $pais->nombre_pais = $request->nombre_pais;
        $pais->latitud = $request->latitud;
        $pais->longitud = $request->longitud;

        $pais->save();

        return response()->json([
            'success' => true,
            'message' => 'País creado correctamente'
        ]);

    }

    /**
     * Muestra un pais especifico por la ID.
     */
    public function show($id)
    {
        //
        $pais = Paises::find($id);

        if (!$pais) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $pais
        ]);
    }

    /**
     * Se actualiza un pais por la ID.
     */
    public function update(Request $request,  $id)
    {
        //
        $pais = Paises::find($id);
        if (!$pais) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado'
            ], 400);
        }

        $pais->nombre_pais = $request->nombre_pais;
        $pais->latitud = $request->latitud;
        $pais->longitud = $request->longitud;
        $pais->save();

        return response()->json([
            'success' => true,
            'message' => 'País actualizado correctamente'
        ]);
    }

    /**
     * Se elimina un pais por la ID.
     */
    public function destroy($id)
    {
        //
        $pais = Paises::find($id);

        if (!$pais) {
            return response()->json([
                'success' => false,
                'message' => 'País no encontrado'
            ], 400);
        }

        $pais->delete();

        return response()->json([
            'success' => true,
            'message' => 'País eliminado correctamente'
        ]);
    }
}
