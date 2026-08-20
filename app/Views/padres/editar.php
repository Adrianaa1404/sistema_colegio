<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Encargado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="m-0">Editar Encargado</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('padres/actualizar/' . $padre['id_padre']) ?>" method="POST">
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombres</label>
                        <input type="text" name="nombres" class="form-control" value="<?= esc($padre['nombres']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" value="<?= esc($padre['apellidos']) ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Parentesco</label>
                        <input type="text" name="parentesco" class="form-control" value="<?= esc($padre['parentesco']) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">DPI</label>
                        <input type="text" name="dpi" class="form-control" value="<?= esc($padre['dpi']) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="<?= esc($padre['telefono']) ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="correo" class="form-control" value="<?= esc($padre['correo']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="<?= esc($padre['direccion']) ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Ocupación</label>
                        <input type="text" name="ocupacion" class="form-control" value="<?= esc($padre['ocupacion']) ?>">
                    </div>
                    <div class="col-md-6 d-flex align-items-center gap-4 mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="es_principal" value="1" <?= $padre['es_principal'] ? 'checked' : '' ?>>
                            <label class="form-check-label">Encargado Principal</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="autorizado_recoger" value="1" <?= $padre['autorizado_recoger'] ? 'checked' : '' ?>>
                            <label class="form-check-label">Autorizado para Recoger</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="2"><?= esc($padre['observaciones']) ?></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= site_url('padres') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>