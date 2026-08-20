<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Inscripciones - Sistema Escolar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- LIBRERÍA HTML2PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .main-container {
            max-width: 1200px;
            margin: 2.5rem auto;
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
        .table-custom {
            margin-bottom: 0;
        }
        .table-custom th {
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #475569;
            background-color: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.25rem;
        }
        .table-custom td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            font-size: 0.875rem;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }
        .table-hover tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="card card-custom">
            
            <!-- Cabecera de la Sección -->
            <div class="header-section d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-15 text-primary p-3 rounded-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-file-signature fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Listado de Inscripciones</h3>
                        <p class="text-muted small mb-0">Gestione, consulte y descargue los comprobantes o fichas del alumnado.</p>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" onclick="imprimirReporteFichas()" class="btn btn-danger btn-sm rounded-pill px-3 py-2 fw-semibold shadow-sm">
                        <i class="fa-solid fa-file-pdf me-1"></i> Descargar Fichas PDF
                    </button>
                    <a href="<?= site_url('inscripcion/nueva') ?>" class="btn btn-primary btn-sm rounded-pill px-3 py-2 fw-semibold shadow-sm">
                        <i class="fa-solid fa-plus me-1"></i> Nueva Inscripción
                    </a>
                    <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-2 fw-semibold shadow-sm">
                        <i class="fa-solid fa-arrow-left me-1"></i> Volver al Menú
                    </a>
                </div>
            </div>

            <!-- Alertas Flash / Mensajes -->
            <?php if (session()->has('mensaje')): ?>
                <div class="mx-4 mt-4">
                    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 border-0" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> <?= session('mensaje') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Contenedor de la Tabla -->
            <div class="p-4">
                <div class="table-responsive rounded-3 border border-light shadow-sm" id="historial-inscripciones">
                    <table class="table table-custom table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estudiante</th>
                                <th>Encargado / Padre</th>
                                <th>Grado / Sección</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($inscripciones) && is_array($inscripciones)): ?>
                                <?php foreach ($inscripciones as $inscripcion): ?>
                                    <tr>
                                        <td class="fw-bold text-secondary"><?= esc($inscripcion['id_inscripcion'] ?? '') ?></td>
                                        
                                        <!-- Nombre del estudiante -->
                                        <td>
                                            <div class="fw-semibold text-dark"><?= esc(($inscripcion['nombres'] ?? '') . ' ' . ($inscripcion['apellidos'] ?? '')) ?></div>
                                        </td>
                                        
                                        <!-- Nombre del encargado -->
                                        <td>
                                            <div class="text-secondary"><?= esc(($inscripcion['nombre_encargado'] ?? '') . ' ' . ($inscripcion['apellido_encargado'] ?? '')) ?></div>
                                        </td>
                                        
                                        <!-- Grado y Sección Corregidos -->
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1 fw-medium">
                                                <?= esc($inscripcion['grado'] ?? '') ?> <?= !empty($inscripcion['seccion']) ? '('.esc($inscripcion['seccion']).')' : '' ?>
                                            </span>
                                        </td>

                                        <!-- Estado Corregido (Garantiza texto legible e identificable) -->
                                        <td>
                                            <?php 
                                                $estado = !empty($inscripcion['estado']) ? trim($inscripcion['estado']) : 'Inscrito';
                                                $estadoLower = strtolower($estado);
                                                
                                                // Definición de clases de estado con color sólido para evitar problemas de contraste
                                                $badgeClass = 'bg-success text-white'; 
                                                if ($estadoLower === 'inactivo' || $estadoLower === 'retirado') {
                                                    $badgeClass = 'bg-danger text-white';
                                                } elseif ($estadoLower === 'egresado') {
                                                    $badgeClass = 'bg-secondary text-white';
                                                }
                                            ?>
                                            <span class="badge <?= $badgeClass ?> rounded-pill px-3 py-2 fw-semibold">
                                                <?= esc($estado) ?>
                                            </span>
                                        </td>

                                        <!-- Fecha Formateada (Día/Mes/Año) -->
                                        <td class="text-muted small">
                                            <?= !empty($inscripcion['fecha_inscripcion']) ? date('d/m/Y', strtotime($inscripcion['fecha_inscripcion'])) : '' ?>
                                        </td>
                                        
                                        <!-- Botón individual de descarga -->
                                        <td class="text-center">
                                            <a href="<?= site_url('inscripcion/descargarPdf/' . $inscripcion['id_inscripcion']) ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold shadow-sm" target="_blank" title="Descargar Comprobante PDF">
                                                <i class="fa-solid fa-file-pdf me-1"></i> PDF
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-folder-open fs-2 mb-2 d-block text-secondary opacity-50"></i>
                                        No hay inscripciones registradas todavía.
                                    </td>
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

    <!-- SCRIPT PARA LLAMAR A LA VISTA DE FICHAS -->
    <script>
        function imprimirReporteFichas() {
            window.open('<?= site_url('inscripcion/imprimirReporteGeneral') ?>', '_blank');
        }
    </script>
</body>
</html>