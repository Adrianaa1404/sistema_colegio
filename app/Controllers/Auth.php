<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->is('post')) {
            $usuarioModel = new UsuarioModel();

            $usuarioInput  = $this->request->getPost('usuario');
            $passwordInput = $this->request->getPost('password');

            $user = $usuarioModel->obtenerUsuarioConRol($usuarioInput);

            // Validación flexible: acepta tanto MD5 como texto plano
            $passwordValida = false;
            if ($user) {
                if (md5($passwordInput) === $user['password'] || $passwordInput === $user['password']) {
                    $passwordValida = true;
                }
            }

           // 1. Recibir el tipo de usuario enviado desde el select de login
            $rolInput = $this->request->getPost('id_rol');

        // 2. Verificar usuario, contraseña Y que el rol seleccionado coincida
        if ($user && $passwordValida && $user['id_rol'] == $rolInput) {
             session()->set([
                'user_id'   => $user['id_usuario'],
                'usuario'   => $user['usuario'],
                'id_rol'    => $user['id_rol'], // <-- AHORA SÍ COINCIDE CON LA VISTA
                'rol'       => $user['id_rol'] == 1 ? 'Administrador' : 'Estándar',
                'logged_in' => true
            ]);

            return redirect()->to(site_url('dashboard'));
     
            }

            return redirect()->back()->with('error', 'Usuario o contraseña incorrectos.');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}