<?php

namespace App\Models;
use CodeIgniter\Model;

class EstudianteModel extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'id_estudiante';

   protected $allowedFields = [
    'codigo', 
    'nombres', 
    'apellidos', 
    'fecha_nacimiento', 
    'genero', 
    'lugar_nacimiento', 
    'nacionalidad', 
    'direccion', 
    'telefono', 
    'email', 
    'grado', 
    'seccion', 
    'jornada', 
    'anio_escolar', 
    'tipo_sangre', 
    'alergias', 
    'enfermedades', 
    'medicamentos', 
    'contacto_emergencia', 
    'estado',
    'foto' // <-- ASEGÚRATE DE QUE 'foto' ESTÉ EN ESTA LISTA
];
    // Función personalizada para traer los datos del padre o encargado
    public function obtenerEstudiantesConPadre()
    {
        return $this->select('estudiantes.*, padres.nombres as nombre_padre')
                    ->join('padres', 'padres.id_padre = estudiantes.id_padre', 'left')
                    ->findAll();
    }
}