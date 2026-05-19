@extends('layouts.app')
@section('content')
<div class='mb-3'>
 <a href='/tareas' class='btn btn-outline-secondary btn-sm'>
 &larr; Volver a la lista
 </a>
 <h1 class='mt-2'>Nueva tarea</h1>
</div>
<div class='card shadow-sm'>
 <div class='card-body'>
 <form method='POST' action='/tareas'>
 @csrf
 {{-- Campo: Titulo --}}
 <div class='mb-3'>
 <label class='form-label fw-bold'>Titulo *</label>
 <input type='text' name='titulo'
 class='form-control @error("titulo") is-invalid @enderror'
 value='{{ old("titulo") }}' required>
 @error('titulo')
 <div class='invalid-feedback'>{{ $message }}</div>
 @enderror
 </div>
 {{-- Campo: Descripcion --}}
 <div class='mb-3'>
 <label class='form-label fw-bold'>Descripcion</label>
 <textarea name='descripcion' class='form-control' rows='3'>
{{ old('descripcion') }}</textarea>
 </div>
 {{-- Campo: Estado --}}
 <div class='mb-3'>
 <label class='form-label fw-bold'>Estado *</label>
 <select name='estado'
 class='form-select @error("estado") is-invalid @enderror'>
 <option value='pendiente'
 {{ old('estado') == 'pendiente' ? 'selected' : '' }}>
 Pendiente
 </option>
 <option value='en_progreso'
 {{ old('estado') == 'en_progreso' ? 'selected' : '' }}>
 En progreso
 </option>
 <option value='completada'
 {{ old('estado') == 'completada' ? 'selected' : '' }}>
 Completada
 </option>
 </select>
 @error('estado')
 <div class='invalid-feedback'>{{ $message }}</div>
 @enderror
 </div>
 <button type='submit' class='btn btn-primary'>
 Guardar tarea
 </button>
 </form>
 </div>
</div>
@endsection