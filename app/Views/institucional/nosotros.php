<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Bilingüe Cristiano | El Árbol del Conocimiento (TKT)</title>
    <!-- Frameworks & Fuentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ==========================================
           PALETA INSPIRADA EN EL LOGO "TKT"
           ========================================== */
        :root {
            --tkt-sky: #0284c7;            /* Azul celeste institucional */
            --tkt-green: #16a34a;          /* Verde árbol */
            --tkt-yellow: #d97706;         /* Amarillo / Dorado */
            --tkt-orange: #ea580c;         /* Naranja TKT */
            --nav-bg: #0f172a;             /* Azul marino para contraste superior */
            --bg-light: #f8fafc;           /* Fondo general limpio */
            --card-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08);
            --card-shadow-hover: 0 20px 30px -5px rgba(15, 23, 42, 0.12);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: #334155;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            scroll-behavior: smooth;
        }

        .content-wrap {
            flex: 1;
        }

        /* Navbar */
        .navbar-custom {
            background-color: var(--nav-bg);
            border-bottom: 3px solid var(--tkt-sky);
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        /* Hero Limpio */
        .hero-section {
            background: linear-gradient(180deg, #ffffff 0%, #f0f9ff 100%);
            padding: 4rem 0 5rem;
            position: relative;
            border-bottom: 1px solid #e2e8f0;
        }

        .hero-badge {
            background: rgba(2, 132, 199, 0.1);
            border: 1px solid rgba(2, 132, 199, 0.25);
            color: var(--tkt-sky);
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        /* Tarjetas de Indicadores */
        .stat-card {
            background: #ffffff;
            border-radius: 1.25rem;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: var(--card-shadow);
        }

        /* Tarjetas Institucionales */
        .card-institutional {
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            background: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .card-institutional::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: transparent;
            transition: background 0.3s ease;
        }

        .card-mision::before { background: var(--tkt-sky); }
        .card-vision::before { background: var(--tkt-green); }
        .card-historia::before { background: var(--tkt-orange); }

        .card-institutional:hover {
            transform: translateY(-6px);
            box-shadow: var(--card-shadow-hover);
        }

        /* Botones Personalizados */
        .btn-tkt-sky {
            background-color: var(--tkt-sky);
            color: #fff;
            border: none;
            font-weight: 600;
        }
        .btn-tkt-sky:hover { background-color: #0369a1; color: #fff; }

        .btn-tkt-green {
            background-color: var(--tkt-green);
            color: #fff;
            border: none;
            font-weight: 600;
        }
        .btn-tkt-green:hover { background-color: #15803d; color: #fff; }

        .btn-tkt-orange {
            background-color: var(--tkt-orange);
            color: #fff;
            border: none;
            font-weight: 600;
        }
        .btn-tkt-orange:hover { background-color: #c2410c; color: #fff; }

        /* Iconos Circulares */
        .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 1.25rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 1.25rem;
            border: none;
        }

        /* Efecto Hover para el QR */
        .hover-zoom {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-zoom:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2) !important;
        }

        /* Pie de página */
        footer {
            background-color: #0f172a;
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="content-wrap">
        <!-- Barra de navegación superior con Logo -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom px-4 py-2 sticky-top shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-3" href="<?= site_url('/') ?>">
    <img src="<?= base_url('img/logo.jpg') ?>" alt="Logo TKT" class="rounded-circle" style="height: 48px; width: 48px; object-fit: cover;">
    <span class="fs-5 text-white fw-bold">El Árbol del Conocimiento</span>
</a>
                <div class="d-flex align-items-center gap-2">
                    <a href="#seccion-nosotros" class="btn btn-outline-light btn-sm fw-semibold px-3 py-2 rounded-pill d-none d-sm-inline-block">
                        <i class="fa-solid fa-circle-info me-1"></i> Conocer Más
                    </a>
                    <a href="#seccion-grados" class="btn btn-outline-light btn-sm fw-semibold px-3 py-2 rounded-pill d-none d-sm-inline-block">
                        <i class="fa-solid fa-graduation-cap me-1"></i> Oferta Académica
                    </a>
                    <a href="<?= site_url('login') ?>" class="btn btn-light text-primary btn-sm fw-bold px-4 py-2 rounded-pill shadow-sm ms-1">
                        <i class="fa-solid fa-right-to-bracket me-1"></i> Iniciar Sesión
                    </a>
                </div>
            </div>
        </nav>

        <!-- Encabezado Principal (Hero) -->
        <header class="hero-section text-center pt-5 pb-5">
            <div class="container position-relative">
                <span class="badge hero-badge px-3 py-2 rounded-pill mb-3 fw-semibold">
                    <i class="fa-solid fa-dove me-1"></i> Excelencia Académica y Cristiana
                </span>
                
                <h1 class="fw-extrabold display-5 text-dark mb-1 tracking-tight">Colegio Bilingüe Cristiano</h1>
                <h2 class="h3 fw-bold mb-3" style="color: var(--tkt-sky);">El Árbol del Conocimiento</h2>
                
                <p class="text-muted max-w-2xl mx-auto lead fs-6 mb-0" style="max-width: 650px;">
                   “Será como árbol plantado junto a corrientes de aguas, que da su fruto a su tiempo, y su hoja no cae; y todo lo que hace, prosperará.”
— Salmos 1:3
            </div>
        </header>

        <!-- Sección de Indicadores Rápidos -->
        <section class="container" style="margin-top: -2rem; position: relative; z-index: 10;">
            <div class="row g-3 justify-content-center text-center">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="fw-bold fs-4" style="color: var(--tkt-sky);"><i class="fa-solid fa-language me-2"></i>100%</div>
                        <div class="text-muted small fw-medium">Educación Bilingüe</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="fw-bold fs-4" style="color: var(--tkt-green);"><i class="fa-solid fa-dove me-2"></i>Valores</div>
                        <div class="text-muted small fw-medium">Formación Cristiana</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="fw-bold fs-4" style="color: var(--tkt-orange);"><i class="fa-solid fa-award me-2"></i>Líderes</div>
                        <div class="text-muted small fw-medium">Liderazgo Integral</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección Misión, Visión, Historia -->
        <section id="seccion-nosotros" class="container my-5 py-4">
            <div class="row g-4 justify-content-center">
                
                <!-- Tarjeta Misión -->
                <div class="col-lg-4 col-md-6">
                    <div class="card card-institutional card-mision h-100 text-center p-4">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="icon-box bg-info bg-opacity-10 text-info mx-auto">
                                    <i class="fa-solid fa-bullseye"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-3 text-dark">Misión</h3>
                                <p class="card-text text-muted fs-6 lh-base mb-4">
                                    Brindar educación bilingüe de calidad, contribuyendo al desarrollo de la comunidad con experiencia docente en la formación de personas íntegras.
                                </p>
                            </div>
                            <button type="button" class="btn btn-tkt-sky rounded-pill py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalMision">
                                Conocer Misión <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Visión -->
                <div class="col-lg-4 col-md-6">
                    <div class="card card-institutional card-vision h-100 text-center p-4">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="icon-box bg-success bg-opacity-10 text-success mx-auto">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-3 text-dark">Visión</h3>
                                <p class="card-text text-muted fs-6 lh-base mb-4">
                                    Ser reconocidos por la alta calidad humana y académica, estimulando una robusta espiritualidad basada en la palabra de Dios (Biblia).
                                </p>
                            </div>
                            <button type="button" class="btn btn-tkt-green rounded-pill py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalVision">
                                Conocer Visión <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta Historia -->
                <div class="col-lg-4 col-md-6">
                    <div class="card card-institutional card-historia h-100 text-center p-4">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="icon-box bg-warning bg-opacity-10 text-warning mx-auto">
                                    <i class="fa-solid fa-book-open"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-3 text-dark">Historia</h3>
                                <p class="card-text text-muted fs-6 lh-base mb-4">
                                    Repasa nuestros orígenes, la evolución constante y los momentos clave que han marcado la trayectoria de nuestra institución.
                                </p>
                            </div>
                            <button type="button" class="btn btn-tkt-orange rounded-pill py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalHistoria">
                                Conocer Historia <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- SECCIÓN DE GRADOS ACADÉMICOS -->
        <section id="seccion-grados" class="container py-5 border-top">
            <div class="text-center mb-5">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-2 fw-semibold">
                    <i class="fa-solid fa-school me-1"></i> Oferta Educativa
                </span>
                <h2 class="fw-bold text-dark">Niveles y Grados Académicos</h2>
                <p class="text-muted">Formación integral estructurada desde los primeros años hasta la etapa diversificada.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Preprimaria -->
                <div class="col-md-4">
                    <div class="card card-institutional h-100 p-4">
                        <div class="card-body">
                            <div class="text-info fs-3 mb-3"><i class="fa-solid fa-child-reaching"></i></div>
                            <h4 class="h5 fw-bold mb-3 text-dark">Preprimaria</h4>
                            <ul class="list-unstyled text-muted lh-lg mb-0 small">
                                <li><i class="fa-solid fa-circle-check text-success me-2"></i> Prekínder</li>
                                <li><i class="fa-solid fa-circle-check text-success me-2"></i> Kínder</li>
                                <li><i class="fa-solid fa-circle-check text-success me-2"></i> Párvulos</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Primaria -->
                <div class="col-md-4">
                    <div class="card card-institutional h-100 p-4">
                        <div class="card-body">
                            <div class="fs-3 mb-3" style="color: var(--tkt-green);"><i class="fa-solid fa-book-reader"></i></div>
                            <h4 class="h5 fw-bold mb-3 text-dark">Primaria</h4>
                            <ul class="list-unstyled text-muted lh-lg mb-0 small">
                                <li><i class="fa-solid fa-circle-check text-success me-2"></i> Primero a Sexto Primaria</li>
                                <li><i class="fa-solid fa-circle-check text-success me-2"></i> Inglés intensivo y computación</li>
                                <li><i class="fa-solid fa-circle-check text-success me-2"></i> Formación en valores bíblicos</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Básicos y Diversificado -->
                <div class="col-md-4">
                    <div class="card card-institutional h-100 p-4">
                        <div class="card-body">
                            <div class="text-warning fs-3 mb-3"><i class="fa-solid fa-graduation-cap"></i></div>
                            <h4 class="h5 fw-bold mb-3 text-dark">Básicos y Diversificado</h4>
                            <ul class="list-unstyled text-muted lh-lg mb-0 small">
                                <li><i class="fa-solid fa-circle-check text-success me-2"></i> <strong>Ciclo Básico:</strong> 1ro, 2do y 3ro Básico</li>
                                <li class="mt-2 fw-semibold text-dark"><i class="fa-solid fa-gears text-primary me-2"></i> Carreras con Enfoque Técnico:</li>
                                <li class="ms-3"><i class="fa-solid fa-angle-right me-1 text-muted"></i> Bach. en Computación Comercial</li>
                                <li class="ms-3"><i class="fa-solid fa-angle-right me-1 text-muted"></i> Bach. en Ciencias Biológicas</li>
                                <li class="ms-3"><i class="fa-solid fa-angle-right me-1 text-muted"></i> Peritados Técnicos Especializados</li>
                                <li class="ms-3"><i class="fa-solid fa-angle-right me-1 text-muted"></i> Menciones en Mecánica y Electricidad</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
<!-- FOOTER INSTITUCIONAL -->
<footer class="py-4 mt-auto">
    <div class="container">
        <div class="row align-items-center g-3 text-center text-md-start">
            
            <!-- Información Principal -->
            <div class="col-md-7 col-lg-8">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-tree text-warning me-2"></i> Colegio Bilingüe Cristiano El Árbol del Conocimiento</h5>
                <p class="mb-2 text-light opacity-75 small">
                    <i class="fa-solid fa-location-dot text-danger me-2"></i> 32 Av. "D", Lote 45-25, Col. Granizo II, Zona 7
                </p>
                <p class="mb-0 text-light opacity-75 small">
                    <i class="fa-solid fa-phone text-success me-2"></i> Teléfono / Celular: 4203-5921
                </p>
            </div>

            <!-- Botones de Redes Sociales -->
            <div class="col-md-5 col-lg-4 text-center text-md-end">
                <div class="d-flex flex-column align-items-center align-items-md-end gap-2">
                    
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/colegio_tkt?igsh=OWl1a295dGR0MWxh" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="btn btn-sm text-white fw-bold w-100 rounded-pill shadow-sm hover-zoom py-2" 
                       style="background-color: #5865F2; max-width: 220px; font-size: 0.85rem;">
                        <i class="fa-brands fa-instagram me-2"></i> INSTAGRAM TKT
                    </a>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/share/193WSSvj6p/?mibextid=wwXIfr" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="btn btn-sm text-dark fw-bold w-100 rounded-pill shadow-sm hover-zoom py-2" 
                       style="background-color: #FACC15; max-width: 220px; font-size: 0.85rem;">
                        <i class="fa-brands fa-facebook me-2"></i> FACEBOOK TKT
                    </a>

                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@arboldelconocimiento?_r=1&_t=ZS-98yRDhfI1J3" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="btn btn-sm text-white fw-bold w-100 rounded-pill shadow-sm hover-zoom py-2" 
                       style="background-color: #EA580C; max-width: 220px; font-size: 0.85rem;">
                        <i class="fa-brands fa-tiktok me-2"></i> TIKTOK TKT
                    </a>

                </div>
            </div>

        </div>

        <hr class="border-secondary my-3 opacity-25">
        <p class="text-white small text-center mb-0">&copy; <?= date('Y') ?> Sistema de Gestión Académica. Todos los derechos reservados.</p>
    </div>
</footer>

    <!-- MODAL DE MISIÓN -->
    <div class="modal fade" id="modalMision" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg overflow-hidden">
                <div class="modal-header text-white px-4 py-3" style="background-color: var(--tkt-sky);">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-bullseye me-2"></i> Misión Institucional</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-secondary lh-lg">
                    <p class="mb-0">Ser una institución educativa bilingüe que se dedique a brindar una educación de calidad, contribuyendo al desarrollo de la comunidad, contando con experiencia docente en la formación de personas íntegras.</p>
                </div>
                <div class="modal-footer px-4 py-3 bg-light">
                    <button type="button" class="btn btn-secondary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE VISIÓN -->
    <div class="modal fade" id="modalVision" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg overflow-hidden">
                <div class="modal-header text-white px-4 py-3" style="background-color: var(--tkt-green);">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-eye me-2"></i> Visión Institucional</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-secondary lh-lg">
                    <p class="mb-0">Ser una institución reconocida por la alta calidad humana y académica de sus egresados en las dimensiones socio-efectivas y cognitivas que estimule el desarrollo de una robusta espiritualidad de fraternidad que emana del fundamento de la palabra de Dios “Biblia”, siendo una casa de estudios que privilegie la reciprocidad y la independencia que edifica las bases para hacer de nuestros estudiantes excelentes profesionales, promoviendo las virtudes de una vida digna.</p>
                </div>
                <div class="modal-footer px-4 py-3 bg-light">
                    <button type="button" class="btn btn-secondary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE HISTORIA -->
    <div class="modal fade" id="modalHistoria" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg overflow-hidden">
                <div class="modal-header bg-dark text-white px-4 py-3">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-book-open me-2 text-warning"></i> Nuestra Historia</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-secondary lh-lg">
                    <p>Fundado con el firme propósito de transformar la educación local, nuestro colegio abrió sus puertas con un pequeño grupo de alumnos y un gran ideal de superación.</p>
                    <p class="mb-0">A lo largo de los años hemos evolucionado adaptándonos a las nuevas exigencias académicas y tecnológicas, integrando sistemas modernos para la gestión escolar y manteniendo siempre vigentes los valores que nos dieron origen.</p>
                </div>
                <div class="modal-footer px-4 py-3 bg-light">
                    <button type="button" class="btn btn-secondary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>