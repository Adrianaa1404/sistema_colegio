<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Colegio El Árbol del Conocimiento</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS Personalizado Externo -->
    <link rel="stylesheet" href="<?= base_url('css/estilos.css?v=2') ?>">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Insignia / Logotipo con árbol estilizado */
        .brand-logo-container {
            width: 85px;
            height: 85px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.15);
            overflow: hidden; /* Asegura que la imagen no se salga de los bordes redondeados */
        }
        .brand-logo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .brand-logo-badge {
            position: absolute;
            bottom: -6px;
            right: -6px;
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            color: #fff;
            font-size: 0.65rem;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 700;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg p-5 rounded-4 bg-white border-0" style="width: 100%; max-width: 500px;">
        <div class="text-center mb-4">
            <!-- Logotipo Institucional Mejorado -->
            <div class="brand-logo-container mb-3">
                <img src="<?= base_url('img/logo.jpg') ?>" alt="Logo TKT">
                <span class="brand-logo-badge">TKT</span>
            </div>
            <h2 class="fw-bold text-dark mb-1">El Árbol del Conocimiento</h2>
            <p class="text-muted fs-6">Por favor, ingresa tus credenciales</p>
        </div>

        <!-- Mensaje de Error -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm small" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-1"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('login') ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary">Usuario</label>
                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="usuario" class="form-control bg-light border-start-0 fs-6" placeholder="Ingresa tu usuario" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary">Contraseña</label>
                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control bg-light border-start-0 fs-6" placeholder="Ingresa tu contraseña" required>
                </div>
            </div>

            <!-- Selector de Tipo de Usuario Agregado -->
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary">Tipo de usuario</label>
                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-light text-muted border-end-0"><i class="fa-solid fa-id-badge"></i></span>
                    <select class="form-select bg-light border-start-0 fs-6" id="id_rol" name="id_rol" required>
                        <option value="" selected disabled>Selecciona tipo de usuario</option>
                        <option value="1">Administrador</option>
                        <option value="2">Estándar</option>
                    </select>
                </div>
            </div>
            
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold shadow-sm">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Ingresar
                </button>

                <a href="<?= site_url('/') ?>" class="btn btn-outline-secondary btn-lg rounded-pill py-2 fw-semibold shadow-sm">
                    <i class="fa-solid fa-right-from-bracket me-2"></i> Salir
                </a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>