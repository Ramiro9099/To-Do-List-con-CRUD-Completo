@extends('layouts.app')
@section('content')
<div class='d-flex justify-content-between align-items-center mb-3'>
 <h1>Mis tareas</h1>
 <a href='/tareas/create' class='btn btn-primary'>+ Nueva tarea</a>
</div>
{{-- Mensaje flash de exito --}}
@if(session('exito'))
 <div class='alert alert-success alert-dismissible'>
 {{ session('exito') }}
 <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
 </div>
@endif
{{-- ═══ FORMULARIO DE BUSQUEDA Y FILTROS ═══ --}}
<div class='card mb-4 shadow-sm'>
 <div class='card-body'>
 {{-- method GET para que los valores queden en la URL --}}
 <form method='GET' action='/tareas'>
 <div class='row g-2 align-items-end'>
 {{-- Campo de busqueda por texto --}}
 <div class='col-md-5'>
 <label class='form-label fw-bold'>Buscar</label>
 <input type='text' name='busqueda' class='form-control'
 {{-- value mantiene el texto que el usuario escribio --}}
 value='{{ $busqueda }}'
placeholder='Buscar por titulo o descripcion...'>
 </div>
 {{-- Filtro por estado --}}
 <div class='col-md-4'>
 <label class='form-label fw-bold'>Estado</label>
 <select name='estado' class='form-select'>
 <option value=''>-- Todos los estados --</option>
 @foreach(['pendiente', 'en_progreso', 'completada'] as $op)
 <option value='{{ $op }}'
 {{-- selected mantiene el filtro elegido --}}
 {{ $estado == $op ? 'selected' : '' }}>
 {{ $op }}
 </option>
 @endforeach
 </select>
 </div>
 {{-- Botones --}}
 <div class='col-md-3 d-flex gap-2'>
 <button type='submit' class='btn btn-primary w-100'>
 Buscar
 </button>
 {{-- Limpiar filtros: redirige a /tareas sin parametros --}}
 <a href='/tareas' class='btn btn-outline-secondary w-100'>
 Limpiar
 </a>
 </div>
 </div>
 </form>
 </div>
</div>
{{-- ═══════════════════════════════════════════ --}}
{{-- Indicador de resultados --}}
<p class='text-muted mb-2'>
 {{ $tareas->count() }} tarea(s) encontrada(s)
 @if($busqueda || $estado)
 <a href='/tareas' class='ms-2 small'>Quitar filtros</a>
 @endif
</p>
{{-- Tabla de tareas --}}
@if($tareas->isEmpty())
 <div class='alert alert-info'>
 No se encontraron tareas con esos criterios.
 </div>
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
 <a href='/tareas/{{ $tarea->id }}/edit'
 class='btn btn-warning btn-sm'>Editar</a>
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
