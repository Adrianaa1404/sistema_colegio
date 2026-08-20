<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// 1. Ruta principal
$routes->get('/', 'Home::nosotros');

// 2. Rutas de Autenticación
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// 3. Dashboard Principal
$routes->get('dashboard', 'Dashboard::index');

// 4. Módulos Principales
$routes->get('estudiantes', 'Estudiantes::index');
$routes->get('padres', 'Padres::index');
$routes->get('inscripciones', 'InscripcionController::index');

// 5. Módulo de Estudiantes
$routes->get('estudiantes/nuevo', 'Estudiantes::nuevo');
$routes->post('estudiantes/guardar', 'Estudiantes::store');
$routes->get('estudiantes/editar/(:num)', 'Estudiantes::editar/$1');
$routes->post('estudiantes/actualizar/(:num)', 'Estudiantes::actualizar/$1');
$routes->get('estudiantes/eliminar/(:num)', 'Estudiantes::eliminar/$1');
$routes->get('estudiantes/json/(:num)', 'Estudiantes::json/$1');

// 6. Módulo de Padres
$routes->get('padres/nuevo', 'Padres::nuevo');
$routes->post('padres/guardar', 'Padres::store');
$routes->post('padres/store', 'Padres::store'); // Soporte alternativo
$routes->get('padres/editar/(:num)', 'Padres::editar/$1');
$routes->post('padres/actualizar/(:num)', 'Padres::actualizar/$1');
$routes->get('padres/eliminar/(:num)', 'Padres::eliminar/$1');
$routes->get('padres/json/(:num)', 'Padres::json/$1');

// 7. Módulo de Inscripciones (Soporta plural y singular)
$routes->get('inscripciones/nueva', 'InscripcionController::nueva');
$routes->get('inscripcion/nueva', 'InscripcionController::nueva'); 

$routes->post('inscripciones/registrar', 'InscripcionController::registrar');
$routes->post('inscripcion/registrar', 'InscripcionController::registrar'); 

// Reportes e Impresiones
$routes->get('inscripciones/imprimirReporteGeneral', 'InscripcionController::imprimirReporteGeneral');
$routes->get('inscripcion/imprimirReporteGeneral', 'InscripcionController::imprimirReporteGeneral'); 

// Descargas PDF
$routes->get('inscripciones/descargarPdf/(:num)', 'InscripcionController::descargarPdf/$1');
$routes->get('inscripcion/descargarPdf/(:num)', 'InscripcionController::descargarPdf/$1');

// 8. Otros
$routes->get('nosotros', 'Home::nosotros');