<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Validated;

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
        $camposVal=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email|',
            'Foto'=>'required|max:10000'
        ];

        $mensajeError=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $camposVal,$mensajeError);

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
        $camposVal=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email|'
        ];

        $mensajeError=[
            'required'=>'El :attribute es requerido',
            
        ];

        if($request->hasFile('Foto')){ //valida si la foto existe
             $camposVal = ['Foto'=>'required|max:10000'];
             $mensajeError = ['Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request, $camposVal,$mensajeError);

        $datosEmpleado = request()->except(['_token','_method']);
        if($request->hasFile('Foto')){
            $empleado = Empleado::findOrfail($id); //recuperar id
            Storage::delete(['public/'.$empleado->Foto]);//borrar
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads','public');
        }

        Empleado::where('id', '=', $id)->update($datosEmpleado);//actualizo datos

        $empleado = Empleado::findOrfail($id); //recuperar id
        //return view('empleados.edit',compact('empleado'));//enviar formulario datos actualizados
        return redirect('empleado')->with('mensaje','Empleado modificado con éxito');
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
