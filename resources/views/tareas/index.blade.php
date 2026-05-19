@extends('layouts.app')
@section('content')
<div class='d-flex justify-content-between align-items-center mb-4'>
 <h1>Mis tareas</h1>
 <a href='/tareas/create' class='btn btn-primary'>+ Nueva tarea</a>
</div>
{{-- Mensaje de exito --}}
@if(session('exito'))
 <div class='alert alert-success alert-dismissible'>
 {{ session('exito') }}
 <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
 </div>
@endif
{{-- Si no hay tareas --}}
@if($tareas->isEmpty())
 <div class='alert alert-info'>No hay tareas todavia. Crea la primera.</div>
@else
 <table class='table table-hover table-bordered'>
 <thead class='table-dark'>
 <tr>
 <th>Titulo</th>
 <th>Descripcion</th>
 <th>Estado</th>
 <th>Acciones</th>
 </tr>
 </thead>
 <tbody>
 @foreach($tareas as $tarea)
 <tr>
 <td>{{ $tarea->titulo }}</td>
 <td>{{ $tarea->descripcion ?? '-' }}</td>
 <td>
 @php
 $colores = [
 'pendiente' => 'secondary',
 'en_progreso' => 'warning',
 'completada' => 'success',
 ];
 @endphp
 <span class='badge bg-{{ $colores[$tarea->estado] }}'>
 {{ $tarea->estado }}
 </span>
 </td>
 <td class='d-flex gap-2'>
 {{-- Boton editar --}}
 <a href='/tareas/{{ $tarea->id }}/edit'
 class='btn btn-warning btn-sm'>Editar</a>
 {{-- Boton eliminar --}}
 <form method='POST' action='/tareas/{{ $tarea->id }}'
 onsubmit="return confirm('Eliminar esta tarea?')">
 @csrf
 @method('DELETE')
 <button class='btn btn-danger btn-sm'>Eliminar</button>
 </form>
 </td>
 </tr>
 @endforeach
 </tbody>
 </table>
@endif
@endsection
