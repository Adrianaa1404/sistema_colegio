<?php

namespace App\Controllers;
use App\Models\EstudianteModel;

class Estudiantes extends BaseController
{
    public function index()
    {
        $model = new EstudianteModel();
        // Usamos la función personalizada para traer los datos del padre/encargado
        $data['estudiantes'] = $model->obtenerEstudiantesConPadre();
        return view('estudiantes/index', $data);
    }

    public function nuevo()
    {
        return view('estudiantes/nuevo');
    }

    public function store()
    {
        $model = new EstudianteModel();
        
        // 1. Procesamiento de la foto
        $fotoNombre = null;
        $rutaCarpeta = FCPATH . 'uploads/estudiantes/';

        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0777, true);
        }

        $fotoBase64 = $this->request->getPost('foto_base64');
        if (!empty($fotoBase64)) {
            // Foto desde la cámara web
            $fotoBase64 = str_replace('data:image/png;base64,', '', $fotoBase64);
            $fotoBase64 = str_replace(' ', '+', $fotoBase64);
            $dataImagen = base64_decode($fotoBase64);

            $fotoNombre = time() . '_' . uniqid() . '.png';
            file_put_contents($rutaCarpeta . $fotoNombre, $dataImagen);
        } else {
            // Foto subida como archivo desde la PC
            $file = $this->request->getFile('foto');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fotoNombre = $file->getRandomName();
                $file->move($rutaCarpeta, $fotoNombre);
            }
        }

        // 2. Guardar datos en la base de datos
        $data = [
            'codigo' => $this->request->getPost('codigo'),
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
            'genero' => $this->request->getPost('genero'),
            'lugar_nacimiento' => $this->request->getPost('lugar_nacimiento'),
            'nacionalidad' => $this->request->getPost('nacionalidad'),
            'direccion' => $this->request->getPost('direccion'),
            'telefono' => $this->request->getPost('telefono'),
            'email' => $this->request->getPost('email'),
            'grado' => $this->request->getPost('grado'),
            'seccion' => $this->request->getPost('seccion'),
            'jornada' => $this->request->getPost('jornada'),
            'anio_escolar' => $this->request->getPost('anio_escolar'),
            'tipo_sangre' => $this->request->getPost('tipo_sangre'),
            'alergias' => $this->request->getPost('alergias'),
            'enfermedades' => $this->request->getPost('enfermedades'),
            'medicamentos' => $this->request->getPost('medicamentos'),
            'contacto_emergencia' => $this->request->getPost('contacto_emergencia'),
            'estado' => $this->request->getPost('estado') ?? 'Activo',
            'foto' => $fotoNombre
        ];

        $model->save($data);
        return redirect()->to(site_url('estudiantes'))->with('mensaje', 'Estudiante registrado con éxito.');
    }

    // Alias por si el formulario llama a 'guardar' en lugar de 'store'
    public function guardar()
    {
        return $this->store();
    }

    public function editar($id)
    {
        $model = new EstudianteModel();
        $data['estudiante'] = $model->find($id);
        return view('estudiantes/editar', $data);
    }

    public function actualizar($id)
    {
        $model = new EstudianteModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to(site_url('estudiantes'));
    }

    public function eliminar($id)
    {
        $model = new EstudianteModel();
        $model->delete($id);
        return redirect()->to(site_url('estudiantes'));
    }

    public function json($id)
    {
        $model = new EstudianteModel();
        $estudiante = $model->find($id);
        
        if (!empty($estudiante['fecha_nacimiento'])) {
            $fnac = new \DateTime($estudiante['fecha_nacimiento']);
            $hoy = new \DateTime();
            $estudiante['edad'] = $hoy->diff($fnac)->y;
        } else {
            $estudiante['edad'] = 'N/D';
        }

        return $this->response->setJSON($estudiante);
    }
}