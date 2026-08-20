<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table         = 'usuarios';
    protected $primaryKey    = 'id_usuario';
    
    // Si la columna en tu base de datos se llama 'rol', asegúrate de incluirla aquí:
    protected $allowedFields = ['usuario', 'password', 'nombres', 'apellidos', 'estado', 'id_rol', 'rol'];

    public function obtenerUsuarioConRol($usuario)
    {
        // Se quitó la línea del join('roles', ...)
        return $this->where('usuarios.usuario', $usuario)
                    ->where('usuarios.estado', 'Activo')
                    ->first();
    }
}