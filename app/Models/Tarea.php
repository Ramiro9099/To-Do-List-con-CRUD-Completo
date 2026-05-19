<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tarea extends Model
{
// Campos que se pueden llenar con ::create() y ->update()
protected $fillable = [
'titulo',
'descripcion',
'estado',
];
}