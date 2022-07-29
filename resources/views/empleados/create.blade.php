<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario empleados</title>
</head>
<body>
    <h1>Formulario creación de empleados</h1>
    <form action="{{url('/empleado')}} " method="post" enctype="multipart/form-data">
    @csrf
    @include('empleados.form',['modo'=>'Crear']);
    </form>
</body>
</html>