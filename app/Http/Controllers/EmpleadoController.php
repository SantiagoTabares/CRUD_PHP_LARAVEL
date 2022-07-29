<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleado'] = Empleado::paginate(5);
        return view('empleados.index',$datos);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');
        
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Empleado::insert($datosEmpleado);

        
        //return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje','Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id )
    {
        //
        $empleado = Empleado::findOrfail($id); //recuperar id
        return view('empleados.edit',compact('empleado'));//enviar formulario
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosEmpleado = request()->except(['_token','_method']);
        if($request->hasFile('Foto')){
            $empleado = Empleado::findOrfail($id); //recuperar id
            Storage::delete(['public/'.$empleado->Foto]);//borrar
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Empleado::where('id', '=', $id)->update($datosEmpleado);//actualizo datos

        $empleado = Empleado::findOrfail($id); //recuperar id
        return view('empleados.edit',compact('empleado'));//enviar formulario datos actualizados
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado = Empleado::findOrfail($id); //recuperar id

        if(Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }
        
        return redirect('empleado')->with('mensaje','Empleado borrado con éxito');
    }
}
