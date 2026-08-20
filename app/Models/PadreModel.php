<?php

namespace App\Models;

use CodeIgniter\Model;

class PadreModel extends Model
{
    protected $table = 'padres';
    protected $primaryKey = 'id_padre'; 
    protected $allowedFields = [
        'dpi', 'nombres', 'apellidos', 'telefono', 'correo',
        'direccion', 'fotografia', 'parentesco', 'fecha_nacimiento',
        'telefono_alternativo', 'ocupacion', 'es_principal',
        'autorizado_recoger', 'observaciones'
    ];

    // Función actualizada para traer al estudiante y el grado de la inscripción
    public function obtenerPadresConEstudiante()
    {
        return $this->select('padres.*, 
                              estudiantes.nombres as estudiante_nombres, 
                              estudiantes.apellidos as estudiante_apellidos,
                              inscripciones.grado as grado')
                    ->join('inscripciones', 'inscripciones.encargado_id = padres.id_padre', 'left')
                    ->join('estudiantes', 'estudiantes.id_estudiante = inscripciones.id_estudiante', 'left')
                    ->groupBy('padres.id_padre')
                    ->findAll();
    }
}