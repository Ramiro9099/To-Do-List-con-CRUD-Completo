<?php
namespace App\Http\Controllers;
use App\Models\Tarea;
use Illuminate\Http\Request;
class TareaController extends Controller
{
// READ — Lista todas las tareas
public function index()
{
$tareas = Tarea::orderBy('created_at', 'desc')->get();
return view('tareas.index', compact('tareas'));
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