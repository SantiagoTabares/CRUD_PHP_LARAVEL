@extends('layouts.app')
@section('content')
<div class="container"><h1>Formulario creación de empleados</h1>
<form action="{{url('/empleado')}} " method="post" enctype="multipart/form-data">
@csrf
@include('empleados.form',['modo'=>'Crear']);
</form>
</div>
@endsection