<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Encargados - Sistema Escolar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .main-container {
            max-width: 1250px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .card-custom {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            background: #ffffff;
            overflow: hidden;
        }
        .header-section {
            padding: 1.75rem 2rem;
            border-bottom: 1px solid #f1f5f9;
            background: #ffffff;
        }
        .filter-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
        }
        .form-label-custom {
            font-weight: 600;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 0.4rem;
        }
        .form-select-custom {
            border-radius: 0.6rem;
            border: 1px solid #cbd5e1;
            padding: 0.55rem 0.9rem;
            font-size: 0.9rem;
            background-color: #ffffff;
            transition: all 0.2s ease-in-out;
        }
        .form-select-custom:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        /* Estilos de Tabla Mejorados */
        .table-custom {
            margin-bottom: 0;
            vertical-align: middle;
        }
        .table-custom > thead > tr > th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            border-top: none;
        }
        .table-custom > tbody > tr > td {
            padding: 1rem 1rem;
            color: #334155;
            font-size: 0.9rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .table-custom > tbody > tr:hover {
            background-color: #f8fafc;
        }
        .avatar-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
        .badge-grado {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            font-weight: 500;
            font-size: 0.75rem;
            padding: 0.3em 0.6em;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="card card-custom">
            
            <!-- Cabecera de la Página -->
            <div class="header-section d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-15 text-primary p-3 rounded-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-user-tie fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Listado de Encargados</h3>
                        <p class="text-muted small mb-0">Gestión de padres, tutores legales y estudiantes vinculados.</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <?php if (session('id_rol') == 1): ?>
                        <a href="<?= site_url('padres/nuevo') ?>" class="btn btn-success">
                        <i class="fa-solid fa-user-plus"></i> Nuevo Encargado
                        </a>
                    <?php endif; ?>
                    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary btn-sm rounded-pill px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-arrow-left me-1"></i> Volver al Menú
                    </a>
                </div>
            </div>

            <div class="p-4">
                <!-- Filtro de Grado -->
                <div class="filter-card">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <label for="filtroGrado" class="form-label-custom">Filtrar por Grado:</label>
                            <select id="filtroGrado" class="form-select form-select-custom" onchange="filtrarPorGrado()">
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

                <!-- Tabla de Datos Dinámica -->
                <div class="table-responsive">
                    <table class="table table-custom" id="tablaEncargados">
                        <thead>
                            <tr>
                                <th style="width: 70px;">Foto</th>
                                <th style="width: 60px;">ID</th>
                                <th>Nombre de Encargado</th>
                                <th>Estudiante Asignado</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>DPI</th>
                                <?php if (session('id_rol') == 1): ?>
                                <th>ACCIONES</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($padres) && is_array($padres)): ?>
                                <?php foreach ($padres as $padre): ?>
                                    <tr>
                                        <!-- Columna de la foto -->
                                        <td>
                                            <?php if (!empty($padre['fotografia']) && file_exists(FCPATH . 'uploads/padres/' . $padre['fotografia'])): ?>
                                                <img src="<?= base_url('uploads/padres/' . $padre['fotografia']) ?>" 
                                                alt="Foto" 
                                                class="rounded-circle" 
                                                width="40" 
                                                height="40" 
                                                style="object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                                    style="width: 40px; height: 40px;">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-semibold text-secondary"><?= esc($padre['id_padre'] ?? '') ?></td>
                                        <td><span class="fw-semibold text-dark"><?= esc(($padre['nombres'] ?? '') . ' ' . ($padre['apellidos'] ?? '')) ?></span></td>
                                        <td>
                                            <?php if (!empty($padre['estudiante_nombres'])): ?>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-semibold text-dark mb-1">
                                                        <i class="fa-solid fa-user-graduate me-1 text-secondary"></i>
                                                        <?= esc($padre['estudiante_nombres'] . ' ' . $padre['estudiante_apellidos']) ?>
                                                    </span>
                                                    <?php if (!empty($padre['grado'])): ?>
                                                        <span class="badge badge-grado w-fit-content"><i class="fa-solid fa-graduation-cap me-1"></i><?= esc($padre['grado']) ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted fst-italic">Sin estudiante asignado</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($padre['telefono'] ?? '') ?></td>
                                        <td><?= esc($padre['direccion'] ?? '') ?></td>
                                        <td><code class="text-dark bg-light px-2 py-1 rounded"><?= esc($padre['dpi'] ?? '') ?></code></td>
                                        <?php if (session('id_rol') == 1): ?>
                                        <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                        <a href="<?= site_url('padres/editar/' . $padre['id_padre']) ?>" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="<?= site_url('padres/eliminar/' . $padre['id_padre']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este encargado?');">
                                        <i class="fa-solid fa-trash"></i>
                                        </a>
                                        </div>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No hay encargados registrados todavía.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT DE FILTRADO DINÁMICO POR GRADO -->
    <script>
        function filtrarPorGrado() {
            let selectValue = document.getElementById('filtroGrado').value.toLowerCase();
            let filas = document.querySelectorAll('#tablaEncargados tbody tr');

            filas.forEach(fila => {
                let textoFila = fila.textContent.toLowerCase();
                if (selectValue === "" || textoFila.includes(selectValue)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>