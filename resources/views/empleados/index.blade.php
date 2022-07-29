@extends('layouts.app')
@section('content')
<div class="container">

@if (Session::has('mensaje'))
{{Session::get('mensaje')}}        
@endif

<a href="{{url('empleado/create')}}" class="btn btn-success ">Registrar nuevo empleado</a>
<br>
<br>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>ApellidoPaterno</th>
            <th>ApellidoMaterno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleado as $empleado)
        <tr>
            <td>
                <th>{{$empleado ->id}}</th>
                <th>
                <img src="{{asset('storage').'/'.$empleado->Foto}}" width="100" alt="" class="img-thumbnail img-fluid">
                {{-- {{$empleado ->Foto}} --}}
                </th>
                
                <th>{{$empleado ->Nombre}}</th>
                <th>{{$empleado ->ApellidoPaterno}}</th>
                <th>{{$empleado ->ApellidoMaterno}}</th>
                <th>{{$empleado ->Correo}}</th>
                <th>
                    
                <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">
                    Editar
                </a>
                 |
                <form action="{{url('/empleado/'.$empleado->id)}}" method="post" class="d-inline">
                @csrf
                {{method_field('DELETE')}}
                <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar" class="btn btn-danger">
                </form>
                </th>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection