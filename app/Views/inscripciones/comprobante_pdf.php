<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Inscripción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- LIBRERÍA HTML2PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body { background: #f8f9fa; font-family: Arial, sans-serif; }
        .comprobante-card { max-width: 700px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <div class="container">
        <!-- BOTONES DE ACCIÓN -->
        <div class="text-end mb-3 no-print">
            <button onclick="descargarPDF()" class="btn btn-danger">
                <i class="fa-solid fa-download me-1"></i> Descargar PDF
            </button>
            <a href="<?= site_url('inscripciones') ?>" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver
            </a>
        </div>

        <!-- CONTENEDOR DEL COMPROBANTE -->
        <div class="comprobante-card" id="area-comprobante">
            <div class="text-center border-bottom pb-3 mb-4">
                <h3 class="fw-bold text-primary"><i class="fa-solid fa-school me-2"></i>Comprobante de Inscripción Escolar</h3>
                <p class="text-muted mb-0">Ciclo Escolar: <?= esc(!empty($inscripcion['ciclo_escolar']) ? $inscripcion['ciclo_escolar'] : '2026') ?></p>
            </div>

            <!-- DATOS DEL ESTUDIANTE CON FOTO -->
            <div class="mb-4">
                <h5 class="text-secondary border-bottom pb-2 d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-user-graduate me-2"></i>Datos del Estudiante</span>
                    
                    <!-- FOTO DEL ESTUDIANTE -->
                    <?php 
                        $foto = $inscripcion['foto_inscripcion'] ?? '';
                        if (!empty($foto)): 
                            $urlFoto = (strpos($foto, 'uploads') !== false) ? base_url($foto) : base_url('uploads/inscripciones/' . $foto);
                    ?>
                        <img src="<?= esc($urlFoto) ?>" alt="Foto Estudiante" width="70" height="70" class="rounded-circle shadow-sm border" style="object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 70px; height: 70px;">
                            <i class="fa-solid fa-user fs-4"></i>
                        </div>
                    <?php endif; ?>
                </h5>

                <p class="mb-1"><strong>Nombre Completo:</strong> <?= esc(($inscripcion['nombres'] ?? '') . ' ' . ($inscripcion['apellidos'] ?? '')) ?></p>
                <p class="mb-1"><strong>Código de Estudiante:</strong> <?= esc(!empty($inscripcion['codigo']) ? $inscripcion['codigo'] : ($inscripcion['codigo_estudiante'] ?? 'N/A')) ?></p>
                <p class="mb-1"><strong>Teléfono:</strong> <?= esc(!empty($inscripcion['telefono_estudiante']) ? $inscripcion['telefono_estudiante'] : ($inscripcion['telefono'] ?? 'N/A')) ?></p>
            </div>

            <!-- DATOS DEL ENCARGADO / PADRE -->
            <div class="mb-4">
                <h5 class="text-secondary border-bottom pb-2"><i class="fa-solid fa-user-shield me-2"></i>Datos del Encargado</h5>
                <?php 
                    $nombreEncargado = !empty($inscripcion['nombre_encargado']) 
                        ? ($inscripcion['nombre_encargado'] . ' ' . ($inscripcion['apellido_encargado'] ?? ''))
                        : (($padre['nombres'] ?? '') . ' ' . ($padre['apellidos'] ?? ''));
                    $telEncargado = $inscripcion['telefono_encargado'] ?? $padre['telefono'] ?? 'N/A';
                    $dpiEncargado = $inscripcion['dpi_encargado'] ?? $padre['dpi'] ?? 'N/A';
                    $parentesco = $inscripcion['parentesco_encargado'] ?? 'Encargado';
                ?>
                <p class="mb-1"><strong>Nombre del Encargado:</strong> <?= esc(trim($nombreEncargado) !== '' ? $nombreEncargado : 'N/A') ?></p>
                <p class="mb-1"><strong>Parentesco:</strong> <?= esc($parentesco) ?></p>
                <p class="mb-1"><strong>DPI / Identificación:</strong> <?= esc($dpiEncargado) ?></p>
                <p class="mb-1"><strong>Teléfono Encargado:</strong> <?= esc($telEncargado) ?></p>
            </div>

            <!-- DETALLES DE LA INSCRIPCIÓN -->
            <div class="mb-4">
                <h5 class="text-secondary border-bottom pb-2"><i class="fa-solid fa-book-open me-2"></i>Detalles de la Inscripción</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Grado:</strong> <?= esc($inscripcion['grado'] ?? $inscripcion['nombre_grado'] ?? '') ?></p>
                        <p class="mb-1"><strong>Sección:</strong> <?= esc($inscripcion['seccion'] ?? '') ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Jornada:</strong> <?= esc($inscripcion['jornada'] ?? '') ?></p>
                        <p class="mb-1">
                            <strong>Estado:</strong> 
                            <span class="badge bg-success">
                                <?= esc(!empty($inscripcion['estado']) ? $inscripcion['estado'] : (!empty($inscripcion['estado_inscripcion']) ? $inscripcion['estado_inscripcion'] : 'Inscrito')) ?>
                            </span>
                        </p>
                    </div>
                </div>
                
                <!-- FECHA FORMATEADA A DÍA/MES/AÑO -->
                <p class="mt-2 mb-1">
                    <strong>Fecha de Inscripción:</strong> 
                    <?= !empty($inscripcion['fecha_inscripcion']) ? date('d/m/Y', strtotime($inscripcion['fecha_inscripcion'])) : date('d/m/Y') ?>
                </p>

                <?php if (!empty($inscripcion['observaciones'])): ?>
                    <p class="mt-2 mb-1"><strong>Observaciones:</strong> <?= esc($inscripcion['observaciones']) ?></p>
                <?php endif; ?>
            </div>

            <div class="text-center mt-5 pt-3 border-top text-muted small">
                <p class="mb-0">Este documento es un comprobante oficial generado por el sistema escolar.</p>
            </div>
        </div>
    </div>

    <!-- SCRIPT PARA GENERAR PDF CON HTML2PDF -->
    <script>
        function descargarPDF() {
            const elemento = document.getElementById('area-comprobante');
            const opciones = {
                margin:       10,
                filename:     'Comprobante_Inscripcion_<?= esc($inscripcion['id_inscripcion'] ?? '1') ?>.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(elemento).set(opciones).save();
        }
    </script>
</body>
</html>