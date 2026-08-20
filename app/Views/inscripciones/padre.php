<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Paso 2: Registrar Encargado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container my-5" style="max-width: 600px;">
        <div class="card shadow-sm border-0 rounded-4 p-4">
            <h4 class="text-success fw-bold mb-4"><i class="fa-solid fa-user-shield me-2"></i>Paso 2: Datos del Encargado</h4>
            
            <form action="<?= site_url('padres/guardar') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label class="form-label">DPI</label>
                    <input type="text" name="dpi" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombres</label>
                        <input type="text" name="nombres" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= site_url('estudiantes/nuevo') ?>" class="btn btn-outline-secondary">Atrás</a>
                    <button type="submit" class="btn btn-success px-4">Finalizar Inscripción</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>