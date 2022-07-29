<h1>{{$modo}} empleado </h1>

<div class="form-group">
<label for="Nombre"> Nombre</label>
<input type="text" class="form-control" name= "Nombre" value="{{isset($empleado->Nombre)?$empleado->Nombre:' '}}" id="Nombre" >
</div>
<br>

<div class="form-group">
<label for="ApellidoPaterno"> Apellido Paterno</label>
<input type="text" class="form-control" name ="ApellidoPaterno"  value="{{isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:' '}}" id="ApellidoPaterno">
</div>
<br>

<div class="form-group">
<label for="ApellidoMaterno"> Apellido Materno</label>
<input type="text" class="form-control" name ="ApellidoMaterno"  value="{{isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:' '}}" id="ApellidoMaterno">
</div>
<br>

<div class="form-group">
<label for="Correo"> Correo</label>
<input type="text" class="form-control" name="Correo"  value="{{isset($empleado->Correo)?$empleado->Correo:' '}}" id="Correo">
</div>
<br>

<div class="form-group">
<label for="Foto"> </label>
{{-- {{$empleado->Foto}} --}}
@if (isset($empleado->Foto))
    <img src="{{asset('storage').'/'.$empleado->Foto}}" class="img-thumbnail img-fluid"  width="200" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">
</div>
<br>
<input type="submit" class="btn btn-success" value="{{$modo}} datos">

<a href="{{url('empleado')}}" class="btn btn-primary ">Regresar</a>
<br>
