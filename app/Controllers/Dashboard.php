<?php

namespace App\Controllers;

use App\Models\EstudianteModel;
use App\Models\PadreModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // 1. Verificación de sesión iniciada
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('login'));
        }

        $estudianteModel = new EstudianteModel();
        $padreModel      = new PadreModel();

        // 2. Carga de datos manteniendo la conexión del JOIN con los Padres
        $data = [
            'estudiantes' => $estudianteModel->obtenerEstudiantesConPadre(),
            'padres'      => $padreModel->findAll()
        ];

        return view('dashboard/index', $data);
    }

    public function guardarEstudiante()
    {
        // Restricción por rol de usuario
        if (session()->get('rol') !== 'Administrador') {
            return redirect()->to(site_url('dashboard'))->with('error', 'Acceso denegado.');
        }

        // Procesamiento de la fotografía en formato Binario (LONGBLOB)
        $file = $this->request->getFile('fotografia');
        $fotoBlob = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fotoBlob = file_get_contents($file->getTempName());
        }

        $estudianteModel = new EstudianteModel();
        $estudianteModel->save([
            'codigo'           => $this->request->getPost('codigo'),
            'nombres'          => $this->request->getPost('nombres'),
            'apellidos'        => $this->request->getPost('apellidos'),
            'genero'           => $this->request->getPost('genero'),
            'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
            'direccion'        => $this->request->getPost('direccion'),
            'telefono'         => $this->request->getPost('telefono'),
            'id_padre'         => $this->request->getPost('id_padre') ?: null,
            'fotografia'       => $fotoBlob
        ]);

        return redirect()->to(site_url('dashboard'))->with('success', 'Estudiante guardado correctamente.');
    }

    public function guardarPadre()
    {
        // Restricción por rol de usuario
        if (session()->get('rol') !== 'Administrador') {
            return redirect()->to(site_url('dashboard'))->with('error', 'Acceso denegado.');
        }

        // Procesamiento de la fotografía en formato Binario (LONGBLOB)
        $file = $this->request->getFile('fotografia');
        $fotoBlob = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fotoBlob = file_get_contents($file->getTempName());
        }

        $padreModel = new PadreModel();
        $padreModel->save([
            'dpi'        => $this->request->getPost('dpi'),
            'nombres'    => $this->request->getPost('nombres'),
            'apellidos'  => $this->request->getPost('apellidos'),
            'telefono'   => $this->request->getPost('telefono'),
            'correo'     => $this->request->getPost('correo'),
            'direccion'  => $this->request->getPost('direccion'),
            'fotografia' => $fotoBlob
        ]);

        return redirect()->to(site_url('dashboard'))->with('success', 'Encargado guardado correctamente.');
    }
}