@extends('layouts.app')
@section('content')
<div class='mb-3'>
 <a href='/tareas' class='btn btn-outline-secondary btn-sm'>
 &larr; Volver a la lista
 </a>
 <h1 class='mt-2'>Editar tarea</h1>
</div>
<div class='card shadow-sm'>
 <div class='card-body'>
 {{-- DIFERENCIA 1: action con el ID de la tarea --}}
 <form method='POST' action='/tareas/{{ $tarea->id }}'>
 @csrf
 {{-- DIFERENCIA 2: @method('PUT') para simular HTTP PUT --}}
 @method('PUT')
 <div class='mb-3'>
 <label class='form-label fw-bold'>Titulo *</label>
 {{-- DIFERENCIA 3: segundo argumento de old() pre-llena con valor de BD --}}
 <input type='text' name='titulo'
 class='form-control @error("titulo") is-invalid @enderror'
 value='{{ old("titulo", $tarea->titulo) }}' required>
 @error('titulo')
 <div class='invalid-feedback'>{{ $message }}</div>
 @enderror
 </div>
 <div class='mb-3'>
 <label class='form-label fw-bold'>Descripcion</label>
 <textarea name='descripcion' class='form-control' rows='3'>
{{ old('descripcion', $tarea->descripcion) }}</textarea>
 </div>
 <div class='mb-3'>
 <label class='form-label fw-bold'>Estado *</label>
 <select name='estado' class='form-select'>
 @foreach(['pendiente', 'en_progreso', 'completada'] as $op)
 <option value='{{ $op }}'
 {{ old('estado', $tarea->estado) == $op ? 'selected' : '' }}>
 {{ $op }}
 </option>
 @endforeach
 </select>
 </div>
 <button type='submit' class='btn btn-warning'>
 Actualizar tarea
 </button>
 </form>
 </div>
</div>
@endsection