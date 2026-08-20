<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Estudiantes - El Árbol del Conocimiento</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --tkt-celeste: #0ea5e9;
            --tkt-verde: #10b981;
            --tkt-amarillo: #f59e0b;
            --tkt-rojo: #ef4444;
            --tkt-dark: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.05) 0px, transparent 50%);
            color: #334155;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrap {
            flex: 1;
        }

        /* Navbar Glassmorphism */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Contenedor principal de la tabla con diseño de tarjeta elevada */
        .main-card {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.25rem;
            background: #ffffff;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        /* Cabecera interna del módulo */
        .module-header {
            border-bottom: 1px solid #f1f5f9;
            padding: 1.5rem 2rem;
            background: #ffffff;
        }

        /* Tabla estilizada */
        .table-custom {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table-custom th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 1rem 1.25rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-custom td {
            padding: 1rem 1.25rem;
            color: #334155;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-custom tbody tr {
            transition: all 0.2s ease;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Estados (Badges modernos) */
        .badge-status {
            padding: 0.35rem 0.75rem;
            border-radius: 50rem;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Botones de acción en tabla */
        .btn-action {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
        .btn-action-edit { background: #fef3c7; color: #d97706; }
        .btn-action-edit:hover { background: #fde68a; color: #b45309; transform: translateY(-2px); }
        
        .btn-action-delete { background: #fee2e2; color: #dc2626; }
        .btn-action-delete:hover { background: #fecaca; color: #b91c1c; transform: translateY(-2px); }

        /* Botones superiores */
        .btn-tkt-primary {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            border: none;
            color: #fff;
            border-radius: 50rem;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
            transition: all 0.3s ease;
        }
        .btn-tkt-primary:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(14, 165, 233, 0.35);
            color: #fff;
        }

        .btn-tkt-outline {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #475569;
            border-radius: 50rem;
            padding: 0.5rem 1.25rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-tkt-outline:hover {
            background: #f8fafc;
            color: #1e293b;
            border-color: #94a3b8;
            transform: translateY(-2px);
        }

        .form-control-custom, .form-select-custom {
            border-radius: 0.75rem;
            border: 1px solid #cbd5e1;
            padding: 0.65rem 1rem;
            font-size: 0.9rem;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.02);
            transition: all 0.2s ease;
        }
        .form-control-custom:focus, .form-select-custom:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15);
        }

        .brand-badge-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(14, 165, 233, 0.15) 100%);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        footer {
            background: #0f172a !important;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body>

    <div class="content-wrap">
        <!-- Navbar Superior Estilizado -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top shadow-sm px-4 py-3">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center fs-5 fw-bold text-white" href="<?= site_url('dashboard') ?>">
                    <div class="brand-badge-icon me-2 shadow-sm">
                        <i class="fa-solid fa-tree text-success fs-5"></i>
                    </div>
                    <span>El Árbol del Conocimiento</span>
                </a>
                <div class="d-flex align-items-center gap-3">
                    <div class="d-none d-sm-flex align-items-center bg-white bg-opacity-10 px-3 py-1.5 rounded-pill border border-white border-opacity-10">
                        <i class="fa-solid fa-circle-user text-info me-2"></i>
                        <span class="text-light small fw-medium"><?= session()->get('usuario') ?? 'Administrador' ?></span>
                    </div>
                    <a href="<?= site_url('logout') ?>" class="btn btn-outline-light btn-sm fw-semibold px-3 py-2 rounded-pill" style="border-color: rgba(255,255,255,0.2);">
                        <i class="fa-solid fa-right-from-bracket me-1 text-danger"></i> Salir
                    </a>
                </div>
            </div>
        </nav>

        <!-- Contenedor Principal -->
        <div class="container my-5">
            <div class="main-card">
                
                <!-- Cabecera del Módulo -->
                <div class="module-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-4 shadow-sm" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-user-graduate fs-4"></i>
                        </div>
                        <div>
                            <h2 class="h4 fw-extrabold text-dark mb-0" style="font-weight: 800;">Listado de Estudiantes</h2>
                            <p class="text-muted small mb-0">Gestión y control de registros del alumnado activo e inactivo</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2">
                        <?php if (session('id_rol') == 1): ?>
                        <a href="<?= site_url('estudiantes/nuevo') ?>" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Nuevo Estudiante
                        </a>
                        <?php endif; ?>
                        <a href="<?= site_url('dashboard') ?>" class="btn btn-tkt-outline btn-sm">
                            <i class="fa-solid fa-arrow-left me-1"></i> Volver al Menú
                        </a>
                    </div>
                </div>

                <!-- Barra de Búsqueda y Filtros Interactivos -->
                <div class="p-4 bg-light border-bottom">
                    <div class="row g-3">
                        <div class="col-lg-7">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3 rounded-start-3">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" id="buscadorEstudiantes" class="form-control form-control-custom border-start-0 ps-0" placeholder="Buscar por número de código o nombre...">
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3 rounded-start-3">
                                    <i class="fa-solid fa-filter"></i>
                                </span>
                                <select id="filtroGrado" class="form-select form-select-custom border-start-0 ps-0">
                                    <option value="">Filtrar por todos los grados</option>
                                    <option value="Prekinder">Prekinder</option>
                                    <option value="Kínder">Kínder</option>
                                    <option value="Preparatoria">Preparatoria</option>
                                    <option value="Primero Primaria">Primero Primaria</option>
                                    <option value="Segundo Primaria">Segundo Primaria</option>
                                    <option value="Tercero Primaria">Tercero Primaria</option>
                                    <option value="Cuarto Primaria">Cuarto Primaria</option>
                                    <option value="Quinto Primaria">Quinto Primaria</option>
                                    <option value="Sexto Primaria">Sexto Primaria</option>
                                    <option value="Primero Básico">Primero Básico</option>
                                    <option value="Segundo Básico">Segundo Básico</option>
                                    <option value="Tercero Básico">Tercero Básico</option>
                                    <option value="Cuarto Diversificado">Cuarto Diversificado</option>
                                    <option value="Quinto Diversificado">Quinto Diversificado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Datos -->
                <div class="table-responsive">
                    <table class="table table-custom" id="tablaEstudiantes">
                        <thead>
                            <tr>
                                <th class="ps-4">Foto</th>
                                <th>Código</th>
                                <th>Nombres y Apellidos</th>
                                <th>Género</th>
                                <th>Teléfono</th>
                                <th>Grado</th>
                                <th>Estado</th>
                                <?php if (session('id_rol') == 1): ?>
                                <th class="text-center pe-4">Acciones</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($estudiantes) && is_array($estudiantes)): ?>
                                <?php foreach ($estudiantes as $estudiante): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <?php if (!empty($estudiante['foto'])): ?>
                                                <img src="<?= base_url('uploads/estudiantes/' . esc($estudiante['foto'])) ?>" alt="Foto" width="42" height="42" class="rounded-circle shadow-sm" style="object-fit: cover; border: 2px solid #fff;">
                                            <?php else: ?>
                                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; border: 2px solid #fff;">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('estudiantes/editar/' . $estudiante['id_estudiante']) ?>" class="fw-bold text-primary text-decoration-none">
                                                <?= esc($estudiante['codigo'] ?? '') ?>
                                            </a>
                                        </td>
                                        <td class="fw-semibold text-dark"><?= esc(($estudiante['nombres'] ?? '') . ' ' . ($estudiante['apellidos'] ?? '')) ?></td>
                                        <td class="text-muted"><?= esc($estudiante['genero'] ?? '') ?></td>
                                        <td class="text-muted"><?= esc($estudiante['telefono'] ?? '') ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1">
                                                <?= esc($estudiante['grado'] ?? 'N/D') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php 
                                                $estadoEst = !empty($estudiante['estado']) ? trim($estudiante['estado']) : 'Activo';
                                                $estadoLower = strtolower($estadoEst);
                                                
                                                $badgeStyle = 'background: rgba(16, 185, 129, 0.1); color: #059669; border: 1px solid rgba(16, 185, 129, 0.2);';
                                                if ($estadoLower === 'inactivo' || $estadoLower === 'retirado') {
                                                    $badgeStyle = 'background: rgba(239, 68, 68, 0.1); color: #dc2626; border: 1px solid rgba(239, 68, 68, 0.2);';
                                                } elseif ($estadoLower === 'egresado' || $estadoLower === 'reinscrito') {
                                                    $badgeStyle = 'background: rgba(245, 158, 11, 0.1); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.2);';
                                                }
                                            ?>
                                            <span class="badge-status" style="<?= $badgeStyle ?>">
                                                <i class="fa-solid fa-circle" style="font-size: 6px;"></i> <?= esc($estadoEst) ?>
                                            </span>
                                        </td>

                                        <?php if (session('id_rol') == 1): ?>
                                        <td class="text-center pe-4">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="<?= site_url('estudiantes/editar/' . $estudiante['id_estudiante']) ?>" class="btn-action btn-action-edit" title="Editar">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <a href="<?= site_url('estudiantes/eliminar/' . $estudiante['id_estudiante']) ?>" class="btn-action btn-action-delete" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este estudiante?');">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                        <?php endif; ?>
                                        
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-folder-open fs-2 mb-2 text-secondary opacity-50"></i>
                                        <p class="mb-0">No hay estudiantes registrados todavía.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white py-4 mt-auto text-center">
        <div class="container">
            <p class="text-muted small mb-1 fw-medium">&copy; <?= date('Y') ?> Colegio Bilingüe Cristiano El Árbol del Conocimiento</p>
            <p class="text-secondary" style="font-size: 0.75rem;">Plataforma de Administración Escolar Segura • Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Script de filtrado interactivo -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buscador = document.getElementById('buscadorEstudiantes');
            const filtroGrado = document.getElementById('filtroGrado');
            const filas = document.querySelectorAll('#tablaEstudiantes tbody tr');

            function filtrarTabla() {
                const textoBusqueda = buscador.value.toLowerCase();
                const gradoSeleccionado = filtroGrado.value.toLowerCase();

                filas.forEach(fila => {
                    if (fila.cells.length < 8) return; 

                    const codigo = fila.cells[1].textContent.toLowerCase();
                    const nombre = fila.cells[2].textContent.toLowerCase();
                    const grado = fila.cells[5].textContent.trim().toLowerCase();

                    const coincideTexto = codigo.includes(textoBusqueda) || nombre.includes(textoBusqueda);
                    const coincideGrado = (gradoSeleccionado === "" || grado === gradoSeleccionado);

                    if (coincideTexto && coincideGrado) {
                        fila.style.display = "";
                    } else {
                        fila.style.display = "none";
                    }
                });
            }

            buscador.addEventListener('keyup', filtrarTabla);
            filtroGrado.addEventListener('change', filtrarTabla);
        });
    </script>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>