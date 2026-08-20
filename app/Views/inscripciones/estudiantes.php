<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 1: Registrar Estudiante - Sistema Colegio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/estilos.css') ?>">
</head>
<body class="bg-light">

    <!-- Navegación Superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="<?= site_url('dashboard') ?>">
                <i class="fa-solid fa-school me-2"></i>Sistema Colegio
            </a>
            <div class="text-white">
                <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Volver al Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-4" style="max-width: 800px;">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 border-0">
                <h4 class="card-title fw-bold text-primary mb-0">
                    <i class="fa-solid fa-user-graduate me-2"></i>Paso 1: Añadir Estudiante
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= site_url('estudiantes/guardar') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Código</label>
                            <input type="text" name="codigo" class="form-control" placeholder="Ej: EST-01" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nombres</label>
                            <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Género</label>
                            <select name="genero" class="form-select" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Fecha Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Encargado / Padre</label>
                            <select name="id_padre" class="form-select" required>
                                <option value="">Seleccione Encargado</option>
                                <?php if (!empty($padres)): ?>
                                    <?php foreach ($padres as $p): ?>
                                        <option value="<?= $p['id_padre'] ?>"><?= esc($p['nombres'] . ' ' . $p['apellidos']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Dirección</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Dirección completa">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Fotografía Estudiante</label>
                            <input type="file" name="fotografia" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary px-4 rounded-pill">
                            <i class="fa-solid fa-arrow-left me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold shadow-sm">
                            Guardar y Continuar <i class="fa-solid fa-arrow-right ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>