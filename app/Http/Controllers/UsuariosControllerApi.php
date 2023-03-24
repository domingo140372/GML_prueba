<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\UsuarioCreado;

use function PHPUnit\Framework\isNull;

class UsuariosControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // devuelve todos los registros de Usuario
        $usuarios = Usuarios::all();
        return response()->json($usuarios);
    }

    /**
     * Store funcion para crear y guardar un nevo usuario.
     */
    public function store(Request $request)
    {
        //se valida los parametros del usuario
        $request->validate([
            'nombres' => [
                'required',
                'string',
                'regex:/^[a-zA-Z]+$/',
                'max:100',
                'min:5'
            ],
            'apellidos' => [
                'required',
                'regex:/^[a-zA-Z]+$/',
                'string',
                'confirmed',
                'max:180',
            ],
            'cedula' => [
                'required',
                'string',
                'confirmed'.
                'unique:usuarios'
            ],            
            'email' => [
                'required|email:rfc,dns',
                'unique:usuarios',
                'max:150'
            ],
            'celular' => [
                'required|numeric',
                'string',
                'confirmed',
                'max:10',
            ],
            'direccion' => [
                'string',
                'confirmed'
            ],
            'id_pais' => [
                'integer',
                'confirmed'
            ],
            'id_categoria' => [
                'integer',
                'confirmed'
            ],
            'created_at' => [
                'required|date|before_or_equal:' . Carbon::now()->format('Y-m-d')
            ]

        ]);

        /***
         * Se devuelve un error si el telefono trae caraceteres
         * no numericos
         */
        $celular = $request->input('celular');

        if (!is_numeric($celular)) {
            return response()->json([
                'error' => 'El número de teléfono celular no puede incluir letras.'
            ], 400);
        }
        /**
         * se asignan los datos al arreglo
         */
        $usuarios = new Usuarios([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'cedula' => $request->cedula,
            'email' => $request->email,
            'celular' => $request->celular,
            'direccion' => $request->direccion,
            'id_pais' => $request->id_pais,
            'id_categoria' => $request->id_categoria,
            'created_at' => $request->created_at,
        ]);

        // se salvan los valores
        $usuarios->save();
        UsuarioCreado::dispatch($request->nombre, $request->email, $request->celular, 'Se ha creado un usuario');

        /**
         * Se devuelven los datos ingresados,
         * se envia mensaje de exito
         */
        return response()->json([
            'ususaios' => $usuarios,
            'success' => true,
            'mensaje' => 'Usuario ingresado con exito',
        ], 201);

    }
   
    /**
     * muestra los datos de la consulta de Usuarios.
     */
    public function show($id)
    {
        //se muestra la consulta de un usuario por su id
        $usuario = Usuarios::findOrFail($id);

        if(!$usuario or isNull()){
            return response()->json([
                'Error' => 'Usuario no encontrado'
            ], 401);
        }else{
            return response()->json([
                'usuario' => $usuario
            ], 200);
        }
    }

    /**
     * Actualiza un Usuario especifico por su ID.
     */
    public function update(Request $request, $id)
    {
        //se actualiza los datos del Usuario
        $usuario = Usuarios::findOrFail($id);
        $usuario->update($request->all());

        if(!$usuario or isNull()){
            return response()->json([
                'Error' => 'No se pudo actualizar los datos del usuario!!!!'
            ], 401); 
        }else{
            return response()->json([
                'usuario' => $usuario,
                'success' => true,
                'mensaje' => 'Usuario actualizado correctamente',
            ], 200);
        }
        
    }

    /**
     * Elima un Usuario especifco por su  ID.
     */
    public function destroy($id)
    {
        //se elimina un suario (en mi concepto este tipo de funciones no deberian existir)
        //la elimicaion de datos en una BD en produccion debe ser logica y no fisica
        //se debe crear un campo booleano True-False que permita esta accion
        $usuario = Usuarios::find($id);

            if (!$usuario) {
                return response()->json(['error' => 'El usuario no existe'], 404);
            }

            if ($usuario->id !== auth()->id()) {
                return response()->json(['error' => 'No está autorizado para realizar esta acción'], 403);
            }

            $usuario->delete();

            return response()->json(['success' => 'Se elimino el usuario correctamente'], 204);
    }
}
