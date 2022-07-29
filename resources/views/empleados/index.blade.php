<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista empleados</title>
</head>
<body>
    <h1>Mostrar lista empleados</h1>
    @if (Session::has('mensaje'))
    {{Session::get('mensaje')}}        
    @endif
    <a href="{{url('empleado/create')}}">Registrar nuevo empleado</a>
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
                    <img src="{{asset('storage').'/'.$empleado->Foto}}" width="100" alt="">
                    {{-- {{$empleado ->Foto}} --}}
                    </th>
                    
                    <th>{{$empleado ->Nombre}}</th>
                    <th>{{$empleado ->ApellidoPaterno}}</th>
                    <th>{{$empleado ->ApellidoMaterno}}</th>
                    <th>{{$empleado ->Correo}}</th>
                    <th>
                        
                    <a href="{{url('/empleado/'.$empleado->id.'/edit')}}">
                        Editar
                    </a>
                     |

                    <form action="{{url('/empleado/'.$empleado->id)}}" method="post">
                    @csrf
                    {{method_field('DELETE')}}
                    <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
                    </form>
                    </th>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>