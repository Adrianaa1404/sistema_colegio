<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Estudiante - Sistema Escolar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .form-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            background: #ffffff;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #475569;
        }
        .form-control, .form-select {
            border-radius: 0.6rem;
            border: 1px solid #cbd5e1;
            padding: 0.6rem 0.9rem;
            font-size: 0.9rem;
            transition: all 0.2s ease-in-out;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .photo-container {
            background: #f1f5f9;
            border: 2px dashed #cbd5e1;
            border-radius: 1rem;
            padding: 1.5rem;
            transition: border-color 0.2s;
        }
        .photo-container:hover {
            border-color: #3b82f6;
        }
        .preview-avatar {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }
        .preview-avatar:hover {
            transform: scale(1.02);
        }
        .video-cam {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            display: none;
        }
    </style>
</head>
<body>

    <div class="container my-5" style="max-width: 900px;">
        <div class="card form-card p-4 p-md-5">
            
            <!-- Encabezado del Formulario -->
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <div class="bg-primary bg-opacity-15 text-primary p-3 rounded-4 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                    <i class="fa-solid fa-user-plus fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Registrar Nuevo Estudiante</h3>
                    <p class="text-muted small mb-0">Complete los datos personales y académicos del alumno.</p>
                </div>
            </div>
            
            <form action="<?= site_url('estudiantes/guardar') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Sección de Fotografía -->
                <div class="row mb-5 justify-content-center">
                    <div class="col-md-7 text-center">
                        <div class="photo-container">
                            <label class="form-label d-block mb-3 text-uppercase text-secondary tracking-wide" style="font-size: 0.75rem;">Fotografía del Estudiante</label>
                            
                            <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                                <video id="videoCamaraEst" autoplay playsinline class="video-cam rounded-circle bg-dark"></video>
                                <img id="imgPreviewEst" src="<?= base_url('assets/img/user_default.png') ?>" 
                                     alt="Vista previa" class="img-thumbnail rounded-circle preview-avatar" 
                                     onclick="document.getElementById('fileInput').click();" title="Haz clic para subir foto">
                            </div>

                            <canvas id="canvasFotoEst" width="300" height="300" class="d-none"></canvas>

                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-semibold" onclick="iniciarCamaraEst()">
                                    <i class="fa-solid fa-camera me-1"></i> Encender Cámara
                                </button>
                                <button type="button" class="btn btn-success btn-sm rounded-pill px-3 fw-semibold" onclick="tomarFotoEst()">
                                    <i class="fa-solid fa-circle-dot me-1"></i> Capturar Foto
                                </button>
                            </div>

                            <!-- Inputs ocultos para la foto -->
                            <input type="file" id="fileInput" name="foto" class="d-none" accept="image/*" onchange="subirArchivo(this)">
                            <input type="hidden" name="foto_base64" id="foto_base64_est">
                        </div>
                    </div>
                </div>

                <!-- Datos Principales -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Código <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="codigo" required placeholder="Ej. EST-2026-001">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nombres <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nombres" required placeholder="Nombres completos">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Apellidos <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="apellidos" required placeholder="Apellidos completos">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Género <span class="text-danger">*</span></label>
                        <select name="genero" class="form-select">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Grado <span class="text-danger">*</span></label>
                        <select name="grado" class="form-select" required>
                            <option value="">Seleccione un grado...</option>
                            <option value="Primero Básico">Primero Básico</option>
                            <option value="Segundo Básico">Segundo Básico</option>
                            <option value="Tercero Básico">Tercero Básico</option>
                            <option value="Cuarto Diversificado">Cuarto Diversificado</option>
                            <option value="Quinto Diversificado">Quinto Diversificado</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Sección</label>
                        <input type="text" class="form-control" name="seccion" placeholder="Ej. A, B...">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nacimiento">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Lugar de Nacimiento</label>
                        <input type="text" class="form-control" name="lugar_nacimiento" placeholder="Ej. Ciudad de Guatemala">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tipo de Sangre</label>
                        <select name="tipo_sangre" class="form-select">
                            <option value="">Seleccione...</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" placeholder="Número de contacto">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="email" placeholder="correo@ejemplo.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección Residencial</label>
                    <input type="text" class="form-control" name="direccion" placeholder="Zona, municipio, dirección completa">
                </div>

                <div class="mb-4">
                    <label class="form-label">Alergias o Condiciones Médicas (Opcional)</label>
                    <textarea class="form-control" name="alergias" rows="2" placeholder="Describa si padece de alguna alergia o condición médica relevante..."></textarea>
                </div>

                <!-- Botones de Acción -->
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                    <a href="<?= site_url('estudiantes') ?>" class="btn btn-light border px-4 rounded-pill fw-semibold text-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4 rounded-pill fw-semibold shadow-sm">Guardar Estudiante</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts de la Cámara y Archivos -->
    <script>
        let videoEst = document.getElementById('videoCamaraEst');
        let canvasEst = document.getElementById('canvasFotoEst');
        let previewEst = document.getElementById('imgPreviewEst');
        let inputBase64 = document.getElementById('foto_base64_est');

        // 1. Lógica Cámara
        async function iniciarCamaraEst() {
            try {
                let stream = await navigator.mediaDevices.getUserMedia({ video: { width: 400, height: 400 } });
                videoEst.srcObject = stream;
                videoEst.style.display = 'inline-block';
                previewEst.style.display = 'none'; // Ocultar imagen previa mientras usa la cámara
                inputBase64.value = ""; 
            } catch (err) { 
                alert("No se pudo acceder a la cámara."); 
            }
        }

        function tomarFotoEst() {
            if (!videoEst.srcObject) { alert("Primero enciende la cámara."); return; }
            let context = canvasEst.getContext('2d');
            context.drawImage(videoEst, 0, 0, 300, 300);
            let dataURL = canvasEst.toDataURL('image/png');
            
            previewEst.src = dataURL;
            previewEst.style.display = 'inline-block';
            inputBase64.value = dataURL;
            
            videoEst.srcObject.getTracks().forEach(track => track.stop());
            videoEst.style.display = 'none';
        }

        // 2. Lógica Subir Archivo tradicional
        function subirArchivo(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => { 
                    previewEst.src = e.target.result;
                    previewEst.style.display = 'inline-block';
                    videoEst.style.display = 'none';
                    if(videoEst.srcObject) {
                        videoEst.srcObject.getTracks().forEach(track => track.stop());
                    }
                }
                reader.readAsDataURL(input.files[0]);
                inputBase64.value = ""; // Limpiar base64 si sube archivo
            }
        }
    </script>
</body>
</html>