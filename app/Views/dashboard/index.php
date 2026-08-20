<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal - El Árbol del Conocimiento</title>
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
            --tkt-naranja: #f97316;
            --tkt-dark: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.08) 0px, transparent 50%);
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

        /* Tarjetas con efecto moderno de elevación */
        .card-admin {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.25rem;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
            position: relative;
            overflow: hidden;
        }

        .card-admin::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: transparent;
            transition: background 0.3s ease;
        }

        .card-admin.border-primary-top::before { background: linear-gradient(90deg, #0ea5e9, #3b82f6); }
        .card-admin.border-success-top::before { background: linear-gradient(90deg, #10b981, #059669); }
        .card-admin.border-warning-top::before { background: linear-gradient(90deg, #f59e0b, #f97316); }

        .card-admin:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: rgba(203, 213, 225, 0.8);
        }

        /* Contenedores de Iconos Estilizados */
        .icon-box-glow {
            width: 85px;
            height: 85px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
            transition: transform 0.3s ease;
        }

        .card-admin:hover .icon-box-glow {
            transform: scale(1.1) rotate(3deg);
        }

        /* Botones sofisticados estilo píldora */
        .btn-tkt {
            border-radius: 50rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .btn-tkt-celeste {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            border: none;
            color: #fff;
        }
        .btn-tkt-celeste:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            box-shadow: 0 6px 15px rgba(14, 165, 233, 0.35);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-tkt-verde {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            color: #fff;
        }
        .btn-tkt-verde:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.35);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-tkt-amarillo {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border: none;
            color: #fff;
        }
        .btn-tkt-amarillo:hover {
            background: linear-gradient(135deg, #d97706 100%, #b45309 100%);
            box-shadow: 0 6px 15px rgba(245, 158, 11, 0.35);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Sello de Marca de Agua sutil o insignia en navbar */
        .brand-badge-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(14, 165, 233, 0.15) 100%);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
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
                    <a href="<?= site_url('logout') ?>" class="btn btn-outline-light btn-sm fw-semibold px-3 py-2 rounded-pill transition-all" style="border-color: rgba(255,255,255,0.2);">
                        <i class="fa-solid fa-right-from-bracket me-1 text-danger"></i> Salir
                    </a>
                </div>
            </div>
        </nav>

        <!-- Encabezado del Panel -->
        <header class="container text-center my-5 py-3">
            <div class="inline-block mb-3">
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill fw-semibold shadow-sm" style="font-size: 0.85rem;">
                    <i class="fa-solid fa-shield-halved me-1"></i> Sistema de Gestión Institucional v2.0
                </span>
            </div>
            <h1 class="fw-extrabold display-6 text-dark mb-2" style="font-weight: 800; letter-spacing: -0.5px;">Panel de Administración</h1>
            <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">Selecciona el módulo académico de tu preferencia para comenzar a administrar la información escolar.</p>
        </header>

        <!-- Módulos Interactivos -->
        <section class="container mb-5 pb-4">
            <div class="row g-4 justify-content-center">
                
                <!-- Tarjeta 1: Estudiantes -->
                <div class="col-lg-4 col-md-6">
                    <div class="card card-admin border-primary-top h-100 text-center p-4">
                        <div class="card-body d-flex flex-column justify-content-between p-2">
                            <div>
                                <div class="icon-box-glow bg-primary bg-opacity-10 text-primary shadow-sm">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-3 text-dark">Estudiantes</h3>
                                <p class="card-text text-muted fs-6 lh-base mb-4">
                                    Control total sobre el registro, expedientes académicos, datos personales e historial de los alumnos.
                                </p>
                            </div>
                            <a href="<?= site_url('estudiantes') ?>" class="btn btn-tkt btn-tkt-celeste w-100 shadow-sm">
                                <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Ingresar al Módulo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 2: Encargados -->
                <div class="col-lg-4 col-md-6">
                    <div class="card card-admin border-success-top h-100 text-center p-4">
                        <div class="card-body d-flex flex-column justify-content-between p-2">
                            <div>
                                <div class="icon-box-glow bg-success bg-opacity-10 text-success shadow-sm">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-3 text-dark">Encargados</h3>
                                <p class="card-text text-muted fs-6 lh-base mb-4">
                                    Administra la información de contacto, perfiles y datos de los padres, madres o tutores legales.
                                </p>
                            </div>
                            <a href="<?= site_url('padres') ?>" class="btn btn-tkt btn-tkt-verde w-100 shadow-sm">
                                <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Ingresar al Módulo
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 3: Inscripciones -->
                <?php if (session('id_rol') == 1): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-admin border-warning-top h-100 text-center p-4">
                        <div class="card-body d-flex flex-column justify-content-between p-2">
                            <div>
                                <div class="icon-box-glow bg-warning bg-opacity-10 text-warning shadow-sm">
                                    <i class="fa-solid fa-file-pen"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-3 text-dark">Inscripciones</h3>
                                <p class="card-text text-muted fs-6 lh-base mb-4">
                                Ejecuta, procesa y consulta de manera ágil los nuevos ingresos y matrículas de los estudiantes.
                                </p>
                            </div>
                            <a href="<?= site_url('inscripciones') ?>" class="btn btn-tkt btn-tkt-amarillo w-100 shadow-sm">
                            <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Ingresar al Módulo
                             </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                </div>

            </div>
        </section>
    </div>

    <!-- Footer Moderno -->
    <footer class="text-white py-4 mt-auto text-center">
        <div class="container">
            <p class="text-muted small mb-1 fw-medium">&copy; <?= date('Y') ?> Colegio Bilingüe Cristiano El Árbol del Conocimiento</p>
            <p class="text-secondary" style="font-size: 0.75rem;">Plataforma de Administración Escolar Segura • Todos los derechos reservados</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>