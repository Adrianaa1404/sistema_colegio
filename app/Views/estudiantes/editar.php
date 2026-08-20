<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow-sm border-0 rounded-4 p-4">
            <h3 class="text-warning fw-bold mb-4 text-dark"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Estudiante</h3>
            
            <form action="<?= site_url('estudiantes/actualizar/' . $estudiante['id_estudiante']) ?>" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Código</label>
                        <input type="text" class="form-control" name="codigo" value="<?= esc($estudiante['codigo']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Nombres</label>
                        <input type="text" class="form-control" name="nombres" value="<?= esc($estudiante['nombres']) ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" value="<?= esc($estudiante['apellidos']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="<?= esc($estudiante['telefono']) ?>">
                    </div>
                </div>

                <div class="row">
                    <!-- Campo de Grado actualizado con todos los niveles -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Grado</label>
                        <select name="grado" class="form-select" required>
                            <option value="" disabled <?= empty($estudiante['grado']) ? 'selected' : '' ?>>Seleccione un grado...</option>
                            <option value="Prekinder" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Prekinder') ? 'selected' : '' ?>>Prekinder</option>
                            <option value="Kínder" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Kínder') ? 'selected' : '' ?>>Kínder</option>
                            <option value="Preparatoria" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Preparatoria') ? 'selected' : '' ?>>Preparatoria</option>
                            <option value="Primero Primaria" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Primero Primaria') ? 'selected' : '' ?>>Primero Primaria</option>
                            <option value="Segundo Primaria" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Segundo Primaria') ? 'selected' : '' ?>>Segundo Primaria</option>
                            <option value="Tercero Primaria" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Tercero Primaria') ? 'selected' : '' ?>>Tercero Primaria</option>
                            <option value="Cuarto Primaria" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Cuarto Primaria') ? 'selected' : '' ?>>Cuarto Primaria</option>
                            <option value="Quinto Primaria" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Quinto Primaria') ? 'selected' : '' ?>>Quinto Primaria</option>
                            <option value="Sexto Primaria" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Sexto Primaria') ? 'selected' : '' ?>>Sexto Primaria</option>
                            <option value="Primero Básico" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Primero Básico') ? 'selected' : '' ?>>Primero Básico</option>
                            <option value="Segundo Básico" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Segundo Básico') ? 'selected' : '' ?>>Segundo Básico</option>
                            <option value="Tercero Básico" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Tercero Básico') ? 'selected' : '' ?>>Tercero Básico</option>
                            <option value="Cuarto Diversificado" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Cuarto Diversificado') ? 'selected' : '' ?>>Cuarto Diversificado</option>
                            <option value="Quinto Diversificado" <?= (isset($estudiante['grado']) && $estudiante['grado'] == 'Quinto Diversificado') ? 'selected' : '' ?>>Quinto Diversificado</option>
                        </select>
                    </div>

                    <!-- Campo de Estado -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Estado</label>
                        <select name="estado" class="form-select" required>
                            <option value="" disabled <?= empty($estudiante['estado']) ? 'selected' : '' ?>>Seleccione un estado...</option>
                            <option value="Nuevo inscrito" <?= (isset($estudiante['estado']) && $estudiante['estado'] == 'Nuevo inscrito') ? 'selected' : '' ?>>Nuevo inscrito</option>
                            <option value="Reinscrito" <?= (isset($estudiante['estado']) && $estudiante['estado'] == 'Reinscrito') ? 'selected' : '' ?>>Reinscrito</option>
                            <option value="Activo" <?= (isset($estudiante['estado']) && $estudiante['estado'] == 'Activo') ? 'selected' : '' ?>>Activo</option>
                            <option value="Inactivo" <?= (isset($estudiante['estado']) && $estudiante['estado'] == 'Inactivo') ? 'selected' : '' ?>>Inactivo</option>
                            <option value="Retirado" <?= (isset($estudiante['estado']) && $estudiante['estado'] == 'Retirado') ? 'selected' : '' ?>>Retirado</option>
                            <option value="Egresado" <?= (isset($estudiante['estado']) && $estudiante['estado'] == 'Egresado') ? 'selected' : '' ?>>Egresado</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= site_url('estudiantes') ?>" class="btn btn-secondary rounded-pill px-4 me-2">Cancelar</a>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 text-dark fw-bold">Actualizar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>