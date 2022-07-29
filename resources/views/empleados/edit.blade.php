<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de edición</title>
</head>
<body>
    <h1>Formulario de edición de empleado</h1>
    <form action="{{url('/empleado/'.$empleado->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
    @include('empleados.form',['modo'=>'Editar']);
    </form>
    

</body>
</html>