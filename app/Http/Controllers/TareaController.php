<?php
namespace App\Http\Controllers;
use App\Models\Tarea;
use Illuminate\Http\Request;
class TareaController extends Controller
{
// READ — Lista todas las tareas
public function index(Request $request)
{
 // Leer los parametros de busqueda del URL
 // Si no existen, devuelven null por defecto
 $busqueda = $request->input('busqueda');
 $estado = $request->input('estado');
 // Construir la consulta usando query builder
 // Tarea::query() inicia la consulta sin ejecutarla todavia
 $tareas = Tarea::query()
 // when() aplica el bloque SOLO si $busqueda no es null ni vacio
 ->when($busqueda, function ($query, $busqueda) {
 $query->where('titulo', 'LIKE', '%' . $busqueda . '%')
 ->orWhere('descripcion', 'LIKE', '%' . $busqueda . '%');
 })
 // when() para el filtro de estado
 ->when($estado, function ($query, $estado) {
 $query->where('estado', $estado);
 })
 ->orderBy('created_at', 'desc')
 ->get();
 // Pasamos tambien $busqueda y $estado a la vista
 // para que el formulario mantenga los valores visibles
 return view('tareas.index', compact('tareas', 'busqueda', 'estado'));
}

// CREATE — Formulario vacio
public function create()
{
return view('tareas.create');
}
// STORE — Guardar nueva tarea
public function store(Request $request)
{
$request->validate([
'titulo' => 'required|max:200',
'descripcion' => 'nullable|max:500',
'estado' => 'required|in:pendiente,en_progreso,completada',
]);
Tarea::create([
'titulo' => $request->input('titulo'),
'descripcion' => $request->input('descripcion'),
'estado' => $request->input('estado'),
]);
return redirect('/tareas')
->with('exito', 'Tarea creada correctamente.');

}
// EDIT — Formulario con datos actuales
public function edit($id)
{
$tarea = Tarea::findOrFail($id);
return view('tareas.edit', compact('tarea'));
}
// UPDATE — Guardar cambios
public function update(Request $request, $id)
{
$tarea = Tarea::findOrFail($id);
$request->validate([
'titulo' => 'required|max:200',
'descripcion' => 'nullable|max:500',
'estado' => 'required|in:pendiente,en_progreso,completada',
]);
$tarea->update([
'titulo' => $request->input('titulo'),
'descripcion' => $request->input('descripcion'),
'estado' => $request->input('estado'),
]);
return redirect('/tareas')
->with('exito', 'Tarea actualizada correctamente.');
}
// DESTROY — Eliminar
public function destroy($id)
{
$tarea = Tarea::findOrFail($id);
$tarea->delete();
return redirect('/tareas')
->with('exito', 'Tarea eliminada correctamente.');
}
}