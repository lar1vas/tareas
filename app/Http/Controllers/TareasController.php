<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Tarea;
use App\Estado;

use App\Http\Requests\TareasRequest;

// Esta librería nos permitirá hacer redireccionamiento de nuestras acciones.
use Illuminate\Support\Facades\Redirect;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Mostrar registros existentes (GET)
        
        // Nos devuelve todas las tareas
        // $tareas = Tarea::all();

        // Devuelve las tareas del usuario que inicio sesion
        $tareas = User::find(Auth::id())->tareas;

        // dd(User::find(Auth::id())->getRoleNames());
        // dd(User::find(Auth::id())->getAllPermissions());
        
        // Saber si un usuario tiene un rol
        // $user->hasRole('admin') 

        // Saber si un usuario tiene un permiso
        // $user->hasRole('admin');

        // Listado de roles que posee el usuario
        // $user->getRoleNames();

        // Listado de Permisos de un usuario
        // $user->getAllPermissions();

        return View('tareas.index')->with('tareas', $tareas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostrar ncurses_use_env(flag)vos datos a crear (GET)
    
        $tarea = new Tarea();
        $estados = Estado::all();

        return View('tareas.save')
            ->with('tarea', $tarea)
            ->with('estados', $estados)
            ->with('method','POST');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TareasRequest $request)
    {
        // Crear nuevos datos(POST)
    
        // Crear tarea nueva
        $tarea = new Tarea();

        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->estado_id = $request->estado_id;
        $tarea->user_id = Auth::id();

        $tarea->save();

        // Redirigimos a la lista de tareas
        return Redirect::to('tareas')->with('notice', 'Tarea guardada correctamente.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mostrar un registro (GET)
        
        $tarea = Tarea::find($id);

        return View('tareas.show')->with('tarea', $tarea);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Mostrar un registro a modificar (GET)
    
        $tarea = Tarea::find($id);
        $estados = Estado::all();

        return View('tareas.save')
            ->with('tarea', $tarea)
            ->with('estados', $estados)
            ->with('method','PUT');
    }

    /**
         * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TareasRequest $request, $id)
    {
        // Modificar un registro (PUT)

        $tarea = Tarea::find($id);

        $tarea->titulo = $request->titulo;
        $tarea->descripcion = $request->descripcion;
        $tarea->estado_id = $request->estado_id;
        $tarea->user_id = Auth::id();

        $tarea->save();

        // Redirigimos a la lista de tareas
        return Redirect::to('tareas')->with('notice', 'Tarea guardada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar un registro (DELETE)
    
        // $tarea = Tarea::find($id);
        $tarea = Tarea::where(array(
            'id' => $id,
            'user_id' => Auth::id()
        ))->first();
        
        $tarea->delete();

        // Redirigimos a la lista de tareas
        return Redirect::to('tareas')->with('notice', 'Tarea eliminada correctamente.');
    }
}
