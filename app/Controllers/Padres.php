<?php

namespace App\Controllers;

use App\Models\PadreModel;

class Padres extends BaseController
{
    public function index()
    {
        $model = new PadreModel();
        $data['padres'] = $model->obtenerPadresConEstudiante();
        return view('padres/index', $data);
    }

    public function nuevo()
    {
        // Bloqueo de seguridad: solo Administrador
        if (session('id_rol') != 1) {
            return redirect()->to(site_url('padres'));
        }

        return view('padres/nuevo');
    }

    public function store()
    {
        // Bloqueo de seguridad: solo Administrador
        if (session('id_rol') != 1) {
            return redirect()->to(site_url('padres'));
        }

        $model = new PadreModel();

        // 1. Procesamiento de la foto
        $fotoNombre = null;
        $rutaCarpeta = FCPATH . 'uploads/padres/';

        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0777, true);
        }

        $fotoBase64 = $this->request->getPost('foto_base64');
        if (!empty($fotoBase64)) {
            // Foto tomada desde la cámara web
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

        // 2. Mapeo de datos usando 'fotografia'
        $data = [
            'dpi'                  => $this->request->getPost('dpi'),
            'nombres'              => $this->request->getPost('nombres'),
            'apellidos'            => $this->request->getPost('apellidos'),
            'telefono'             => $this->request->getPost('telefono'),
            'correo'               => $this->request->getPost('correo'),
            'direccion'            => $this->request->getPost('direccion'),
            'fotografia'           => $fotoNombre,
            'parentesco'           => $this->request->getPost('parentesco'),
            'fecha_nacimiento'     => $this->request->getPost('fecha_nacimiento'),
            'telefono_alternativo' => $this->request->getPost('telefono_alternativo'),
            'ocupacion'            => $this->request->getPost('ocupacion'),
            'es_principal'         => $this->request->getPost('es_principal') ? 1 : 0,
            'autorizado_recoger'   => $this->request->getPost('autorizado_recoger') ? 1 : 0,
            'observaciones'        => $this->request->getPost('observaciones')
        ];

        $model->save($data);
        return redirect()->to(site_url('padres'))->with('mensaje', 'Padre registrado con éxito.');
    }

    // Alias para que funcione si el formulario apunta a 'padres/guardar'
    public function guardar()
    {
        return $this->store();
    }

    public function editar($id)
    {
        // Bloqueo de seguridad: solo Administrador
        if (session('id_rol') != 1) {
            return redirect()->to(site_url('padres'));
        }

        $model = new PadreModel();
        $data['padre'] = $model->find($id);

        if (!$data['padre']) {
            return redirect()->to(site_url('padres'))->with('error', 'Encargado no encontrado.');
        }

        return view('padres/editar', $data);
    }

    public function actualizar($id)
    {
        // Bloqueo de seguridad: solo Administrador
        if (session('id_rol') != 1) {
            return redirect()->to(site_url('padres'));
        }

        $model = new PadreModel();
        $padreActual = $model->find($id);

        if (!$padreActual) {
            return redirect()->to(site_url('padres'))->with('error', 'Encargado no encontrado.');
        }

        // Mantenemos la foto actual por defecto
        $fotoNombre = $padreActual['fotografia'] ?? null;
        $rutaCarpeta = FCPATH . 'uploads/padres/';

        // Verificar si se subió o tomó una nueva foto al editar
        $fotoBase64 = $this->request->getPost('foto_base64');
        if (!empty($fotoBase64)) {
            $fotoBase64 = str_replace('data:image/png;base64,', '', $fotoBase64);
            $fotoBase64 = str_replace(' ', '+', $fotoBase64);
            $dataImagen = base64_decode($fotoBase64);

            $fotoNombre = time() . '_' . uniqid() . '.png';
            file_put_contents($rutaCarpeta . $fotoNombre, $dataImagen);
        } else {
            $file = $this->request->getFile('foto');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fotoNombre = $file->getRandomName();
                $file->move($rutaCarpeta, $fotoNombre);
            }
        }

        $data = [
            'dpi'                  => $this->request->getPost('dpi'),
            'nombres'              => $this->request->getPost('nombres'),
            'apellidos'            => $this->request->getPost('apellidos'),
            'telefono'             => $this->request->getPost('telefono'),
            'correo'               => $this->request->getPost('correo'),
            'direccion'            => $this->request->getPost('direccion'),
            'fotografia'           => $fotoNombre,
            'parentesco'           => $this->request->getPost('parentesco'),
            'fecha_nacimiento'     => $this->request->getPost('fecha_nacimiento'),
            'telefono_alternativo' => $this->request->getPost('telefono_alternativo'),
            'ocupacion'            => $this->request->getPost('ocupacion'),
            'es_principal'         => $this->request->getPost('es_principal') ? 1 : 0,
            'autorizado_recoger'   => $this->request->getPost('autorizado_recoger') ? 1 : 0,
            'observaciones'        => $this->request->getPost('observaciones')
        ];

        $model->update($id, $data);
        return redirect()->to(site_url('padres'))->with('mensaje', 'Padre actualizado con éxito.');
    }

    public function eliminar($id)
    {
        // Bloqueo de seguridad: solo Administrador
        if (session('id_rol') != 1) {
            return redirect()->to(site_url('padres'));
        }

        $model = new PadreModel();
        $model->delete($id);
        return redirect()->to(site_url('padres'))->with('mensaje', 'Padre eliminado con éxito.');
    }
}