<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Encargado - Sistema Escolar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .main-container {
            max-width: 950px;
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
        .form-label-custom {
            font-weight: 600;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 0.4rem;
        }
        .form-control-custom, .form-select-custom {
            border-radius: 0.6rem;
            border: 1px solid #cbd5e1;
            padding: 0.6rem 0.9rem;
            font-size: 0.9rem;
            background-color: #ffffff;
            transition: all 0.2s ease-in-out;
        }
        .form-control-custom:focus, .form-select-custom:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .photo-container {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 2px dashed #cbd5e1;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            cursor: pointer;
            overflow: hidden;
            position: relative;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .photo-container:hover {
            border-color: #3b82f6;
            background-color: #f1f5f9;
        }
        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1e293b;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 0.5rem;
            margin-bottom: 1.25rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="card card-custom">
            
            <!-- Cabecera del Formulario -->
            <div class="header-section d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-15 text-primary p-3 rounded-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="fa-solid fa-user-plus fs-4"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Registrar Nuevo Encargado</h3>
                        <p class="text-muted small mb-0">Complete la información general, datos de contacto y fotografía del tutor.</p>
                    </div>
                </div>
                <div>
                    <a href="<?= site_url('padres') ?>" class="btn btn-secondary btn-sm rounded-pill px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-arrow-left me-1"></i> Volver
                    </a>
                </div>
            </div>

            <!-- Formulario Principal -->
            <div class="p-4 p-md-5">
                <form action="<?= site_url('padres/guardar') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Fotografía del Encargado -->
                    <div class="text-center mb-4">
                        <label class="form-label-custom d-block mb-2">Fotografía del Encargado</label>
                        
                        <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
                            <video id="videoCamaraPadre" width="120" height="120" autoplay playsinline class="rounded-circle border border-2 border-primary bg-dark shadow-sm" style="object-fit: cover; display: none;"></video>
                            
                            <div id="previewContainer" class="photo-container" onclick="document.getElementById('fileInputPadre').click();" title="Haz clic para subir foto">
                                <img id="imgPreviewPadre" src="" alt="Vista previa" class="w-100 h-100 object-fit-cover d-none position-absolute top-0 start-0">
                                <div id="placeholderText" class="text-muted text-center p-2" style="font-size: 0.75rem;">
                                    <i class="fa-solid fa-camera fs-4 mb-1 text-secondary"></i>
                                    <span class="d-block">Subir / Foto</span>
                                </div>
                            </div>
                        </div>

                        <canvas id="canvasFotoPadre" width="300" height="300" class="d-none"></canvas>

                        <div class="d-flex justify-content-center gap-2 mt-2">
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold" onclick="iniciarCamaraPadre()">
                                <i class="fa-solid fa-video me-1"></i> Encender Cámara
                            </button>
                            <button type="button" class="btn btn-success btn-sm rounded-pill px-3 fw-semibold" onclick="tomarFotoPadre()">
                                <i class="fa-solid fa-circle-dot me-1"></i> Capturar Foto
                            </button>
                        </div>

                        <!-- Inputs para archivo tradicional y Base64 de cámara -->
                        <input type="file" id="fileInputPadre" name="foto" class="d-none" accept="image/*" onchange="subirArchivoPadre(this)">
                        <input type="hidden" name="foto_base64" id="foto_base64_padre">
                    </div>

                    <h5 class="section-title"><i class="fa-solid fa-id-card me-2 text-primary"></i> Información Personal</h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Nombres</label>
                            <input type="text" class="form-control form-control-custom" name="nombres" placeholder="Nombres completos" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Apellidos</label>
                            <input type="text" class="form-control form-control-custom" name="apellidos" placeholder="Apellidos completos" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Parentesco</label>
                            <input type="text" class="form-control form-control-custom" name="parentesco" placeholder="Ej. Padre, Madre, Tío" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">DPI</label>
                            <input type="text" class="form-control form-control-custom" name="dpi" placeholder="Número de DPI">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-custom">Fecha de Nacimiento</label>
                            <input type="date" class="form-control form-control-custom" name="fecha_nacimiento">
                        </div>
                    </div>

                    <h5 class="section-title"><i class="fa-solid fa-address-book me-2 text-primary"></i> Contacto y Ubicación</h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Teléfono Principal</label>
                            <input type="text" class="form-control form-control-custom" name="telefono" placeholder="Número de contacto" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Teléfono Alternativo</label>
                            <input type="text" class="form-control form-control-custom" name="telefono_alternativo" placeholder="Número opcional">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-custom" name="correo" placeholder="correo@ejemplo.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Ocupación</label>
                            <input type="text" class="form-control form-control-custom" name="ocupacion" placeholder="Ocupación u oficio">
                        </div>
                        <div class="col-12">
                            <label class="form-label-custom">Dirección</label>
                            <input type="text" class="form-control form-control-custom" name="direccion" placeholder="Zona, municipio, dirección completa">
                        </div>
                    </div>

                    <h5 class="section-title"><i class="fa-solid fa-circle-info me-2 text-primary"></i> Permisos y Observaciones</h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="es_principal" value="1" id="es_principal">
                                <label class="form-check-label fw-medium small text-secondary" for="es_principal">
                                    ¿Es el encargado principal?
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="autorizado_recoger" value="1" id="autorizado_recoger">
                                <label class="form-check-label fw-medium small text-secondary" for="autorizado_recoger">
                                    ¿Está autorizado para recoger al estudiante?
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label-custom">Observaciones</label>
                            <textarea class="form-control form-control-custom" name="observaciones" rows="3" placeholder="Información adicional relevante..."></textarea>
                        </div>
                    </div>

                    <!-- Botón de Guardar -->
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <a href="<?= site_url('padres') ?>" class="btn btn-light border px-4 py-2 rounded-pill fw-semibold">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill fw-semibold shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Encargado
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts para manejo de cámara y vista previa -->
    <script>
        let videoPadre = document.getElementById('videoCamaraPadre');
        let canvasPadre = document.getElementById('canvasFotoPadre');
        let previewPadre = document.getElementById('imgPreviewPadre');
        let placeholder = document.getElementById('placeholderText');
        let inputFotoPadre = document.getElementById('foto_base64_padre');
        let streamCamaraPadre = null;

        // 1. Encender Cámara
        async function iniciarCamaraPadre() {
            try {
                streamCamaraPadre = await navigator.mediaDevices.getUserMedia({ video: { width: 300, height: 300 } });
                videoPadre.srcObject = streamCamaraPadre;
                videoPadre.style.display = 'inline-block';
                previewPadre.classList.add('d-none');
                placeholder.classList.add('d-none');
                inputFotoPadre.value = ""; // Limpiar base64 previo
            } catch (err) {
                alert("No se pudo acceder a la cámara web o se denegó el permiso.");
                console.error(err);
            }
        }

        // 2. Capturar Foto desde la Cámara
        function tomarFotoPadre() {
            if (!streamCamaraPadre) {
                alert("Primero debes encender la cámara web.");
                return;
            }
            let context = canvasPadre.getContext('2d');
            context.drawImage(videoPadre, 0, 0, 300, 300);
            
            let dataURL = canvasPadre.toDataURL('image/png');
            previewPadre.src = dataURL;
            previewPadre.classList.remove('d-none');
            placeholder.classList.add('d-none');
            inputFotoPadre.value = dataURL;

            // Detenemos la cámara
            streamCamaraPadre.getTracks().forEach(track => track.stop());
            streamCamaraPadre = null;
            videoPadre.style.display = 'none';
        }

        // 3. Subir archivo tradicional desde la computadora
        function subirArchivoPadre(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    previewPadre.src = e.target.result;
                    previewPadre.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                }
                reader.readAsDataURL(input.files[0]);
                inputFotoPadre.value = ""; // Limpiar base64 si selecciona archivo físico
            }
        }
    </script>
</body>
</html>