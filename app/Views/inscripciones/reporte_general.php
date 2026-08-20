<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Inscripción Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- LIBRERÍA HTML2PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        body { background-color: #f8f9fa; font-family: sans-serif; }
        .ficha-estudiante { 
            background: white; 
            padding: 30px; 
            margin-bottom: 30px; 
            border-radius: 12px; 
            border: 1px solid #dee2e6;
            page-break-after: always; /* Fuerza que cada ficha empiece en una página nueva en el PDF */
        }
        .section-title { 
            font-size: 0.95rem; 
            font-weight: bold; 
            color: #0d6efd; 
            margin-bottom: 12px; 
            border-bottom: 1px solid #dee2e6; 
            padding-bottom: 5px; 
        }
        .data-box { 
            background-color: #f8f9fa; 
            border: 1px solid #dee2e6; 
            padding: 8px 12px; 
            border-radius: 6px; 
            min-height: 38px; 
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

    <div class="container py-4">
        <?php if (!empty($inscripciones) && is_array($inscripciones)): ?>
            <?php foreach ($inscripciones as $inscripcion): ?>
                <div class="ficha-estudiante shadow-sm">
                    
                    <!-- ENCABEZADO -->
                    <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
                        <h4 class="text-primary m-0"><i class="fa-solid fa-file-signature me-2"></i> Comprobante de Inscripción Escolar</h4>
                    </div>
                    
                    <!-- 1. ESTUDIANTE -->
                    <div class="section-title">
                        <i class="fa-solid fa-user-graduate me-1"></i> 1. Datos del Estudiante
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="text-muted small">Estudiante Seleccionado</label>
                            <div class="data-box fw-bold text-dark">
                                <?= esc(($inscripcion['nombres'] ?? '') . ' ' . ($inscripcion['apellidos'] ?? '')) ?>
                            </div>
                        </div>
                    </div>

                    <!-- 2. ENCARGADO -->
                    <div class="section-title">
                        <i class="fa-solid fa-user-shield me-1"></i> 2. Datos del Encargado / Tutor
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="text-muted small">Encargado Asignado</label>
                            <div class="data-box">
                                <?= esc(($inscripcion['nombre_encargado'] ?? '')) ?> 
                                <?= esc(($inscripcion['apellido_encargado'] ?? '')) ?>
                            </div>
                        </div>
                    </div>

                    <!-- 3. DATOS PROPIOS DE LA INSCRIPCIÓN -->
                    <div class="section-title">
                        <i class="fa-solid fa-school me-1"></i> 3. Datos Propios de la Inscripción
                    </div>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="text-muted small">Año Escolar</label>
                            <div class="data-box"><?= esc($inscripcion['ciclo_escolar'] ?? '2026') ?></div>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small">Grado</label>
                            <div class="data-box"><?= esc($inscripcion['grado'] ?? '') ?></div>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small">Sección</label>
                            <div class="data-box"><?= esc($inscripcion['seccion'] ?? '') ?></div>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted small">Jornada</label>
                            <div class="data-box"><?= esc($inscripcion['jornada'] ?? 'Matutina') ?></div>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted small">Fecha de Inscripción</label>
                            <div class="data-box"><?= esc($inscripcion['fecha_inscripcion'] ?? '') ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small">Estado</label>
                            <div class="data-box fw-bold text-success">
                                <?= esc(!empty($inscripcion['estado']) ? $inscripcion['estado'] : 'Inscrito') ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="text-muted small">Observaciones</label>
                            <div class="data-box" style="min-height: 60px;">
                                <?= esc($inscripcion['observaciones'] ?? 'Sin observaciones adicionales.') ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center py-4">No hay inscripciones registradas para generar el reporte.</div>
        <?php endif; ?>
    </div>

    <!-- SCRIPT QUE GENERA Y DESCARGA EL PDF AUTOMÁTICAMENTE -->
    <script>
        window.onload = function() {
            const elemento = document.body;
            const opciones = {
                margin:       10,
                filename:     'Comprobante_Inscripcion_Escolar.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            
            html2pdf().set(opciones).from(elemento).save();
        };
    </script>
</body>
</html>