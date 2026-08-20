<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Inscripción Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- LIBRERÍA HTML2PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">
                <i class="fa-solid fa-file-pen text-primary me-2"></i>Nueva Inscripción Escolar
            </h2>
            <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                <i class="fa-solid fa-arrow-left me-2"></i>Volver al Dashboard
            </a>
        </div>

        <form action="<?= site_url('inscripciones/registrar') ?>" method="POST" enctype="multipart/form-data" id="formInscripcion">
            <?= csrf_field() ?>

            <!-- CONTENEDOR ENVUELTO PARA EL PDF -->
            <div id="area-comprobante">
                <!-- CAMPOS OCULTOS PARA LA BASE DE DATOS -->
                <input type="hidden" name="nombre_encargado" id="input_nombre_padre">
                <input type="hidden" name="apellido_encargado" id="input_apellido_padre">
                <input type="hidden" name="parentesco_encargado" id="input_parentesco_padre">
                <input type="hidden" name="telefono_encargado" id="input_telefono_padre">
                <input type="hidden" name="dpi_encargado" id="input_dpi_padre">
                <input type="hidden" name="direccion_encargado" id="input_direccion_padre">
                <input type="hidden" name="foto_base64" id="foto_base64_inscripcion">

                <!-- SECCIÓN 1: FOTOGRAFÍA DE INSCRIPCIÓN / CÁMARA -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom text-start">
                            <i class="fa-solid fa-camera me-2"></i>1. Fotografía o Comprobante Visual
                        </h5>
                        
                        <div class="d-flex justify-content-center align-items-center gap-3 mb-2">
                            <video id="videoCamaraInscripcion" width="110" height="110" autoplay playsinline class="rounded-circle border border-2 border-secondary bg-dark" style="object-fit: cover; display: none;"></video>
                            
                            <div id="previewContainer" class="rounded-circle border border-2 border-secondary d-flex align-items-center justify-content-center overflow-hidden bg-white shadow-sm" style="width: 110px; height: 110px; cursor: pointer;" onclick="document.getElementById('fileInputInscripcion').click();" title="Haz clic para subir foto">
                                <img id="imgPreviewInscripcion" src="" alt="Vista previa" class="w-100 h-100 object-fit-cover d-none">
                                <div id="placeholderText" class="text-muted text-center p-2" style="font-size: 0.80rem;">
                                    <i class="fa-solid fa-camera fa-lg mb-1 text-secondary"></i><br>
                                    <span>Subir / Foto</span>
                                </div>
                            </div>
                        </div>

                        <canvas id="canvasFotoInscripcion" width="300" height="300" class="d-none"></canvas>

                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2" onclick="iniciarCamaraInscripcion()">
                                <i class="fa-solid fa-camera me-1"></i> Encender Cámara
                            </button>
                            <button type="button" class="btn btn-success btn-sm rounded-pill px-3" onclick="tomarFotoInscripcion()">
                                <i class="fa-solid fa-circle-dot me-1"></i> Capturar Foto
                            </button>
                        </div>

                        <input type="file" id="fileInputInscripcion" name="foto" class="d-none" accept="image/*" onchange="subirArchivoInscripcion(this)">
                    </div>
                </div>

                <!-- SECCIÓN 2: SELECCIÓN DE ESTUDIANTE -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom">
                            <i class="fa-solid fa-graduation-cap me-2"></i>2. Seleccionar Estudiante Existente
                        </h5>
                        
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <label class="form-label fw-semibold small">Buscar Estudiante</label>
                                <select name="id_estudiante" id="selectEstudiante" class="form-select rounded-3 shadow-sm" required onchange="cargarDatosEstudiante(this.value)">
                                    <option value="">Seleccione un estudiante...</option>
                                    <?php if (!empty($estudiantes)): foreach($estudiantes as $e): ?>
                                        <option value="<?= $e['id_estudiante'] ?? $e['id'] ?? '' ?>">[<?= esc($e['codigo'] ?? 'S/C') ?>] - <?= esc($e['nombres'] ?? $e['nombre'] ?? '') ?> <?= esc($e['apellidos'] ?? $e['apellido'] ?? '') ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label fw-semibold small text-muted">Datos Obtenidos Automáticamente:</label>
                                <div class="p-3 bg-light border rounded-3 small text-dark" id="infoEstudiante">
                                    <span class="text-muted italic">Seleccione un estudiante para ver sus datos aquí...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN 3: SELECCIÓN DE ENCARGADO -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom">
                            <i class="fa-solid fa-user-shield me-2"></i>3. Seleccionar Encargado (Padre / Madre / Tutor)
                        </h5>
                        
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <label class="form-label fw-semibold small">Buscar Encargado</label>
                                <select name="encargado_id" id="selectEncargado" class="form-select rounded-3 shadow-sm" required onchange="cargarDatosEncargado(this.value)">
                                    <option value="">Seleccione un encargado...</option>
                                    <?php if (!empty($padres)): foreach($padres as $enc): ?>
                                        <option value="<?= $enc['id'] ?? $enc['id_padre'] ?? '' ?>"><?= esc($enc['nombres'] ?? $enc['nombre'] ?? '') ?> <?= esc($enc['apellidos'] ?? $enc['apellido'] ?? '') ?> (<?= esc($enc['parentesco'] ?? 'Sin parentesco') ?>)</option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label fw-semibold small text-muted">Datos Obtenidos Automáticamente:</label>
                                <div class="p-3 bg-light border rounded-3 small text-dark" id="infoEncargado">
                                    <span class="text-muted italic">Seleccione un encargado para ver sus datos aquí...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN 4: DATOS PROPIOS DE LA INSCRIPCIÓN -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-primary mb-3 pb-2 border-bottom">
                            <i class="fa-solid fa-clipboard-list me-2"></i>4. Datos Propios de la Inscripción
                        </h5>
                        
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold small">Año Escolar</label>
                                <input type="text" name="ciclo_escolar" class="form-control rounded-3 shadow-sm" value="2026" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold small">Grado</label>
                                <select name="grado" class="form-select rounded-3 shadow-sm" required>
                                    <option value="">Seleccione un grado...</option>
                                    <option value="Prekínder">Prekínder</option>
                                    <option value="Kínder">Kínder</option>
                                    <option value="Párvulos">Párvulos</option>
                                    <option value="Primero Primaria">Primero Primaria</option>
                                    <option value="Segundo Primaria">Segundo Primaria</option>
                                    <option value="Tercero Primaria">Tercero Primaria</option>
                                    <option value="Cuarto Primaria">Cuarto Primaria</option>
                                    <option value="Quinto Primaria">Quinto Primaria</option>
                                    <option value="Sexto Primaria">Sexto Primaria</option>
                                    <option value="Primero Básico">Primero Básico</option>
                                    <option value="Segundo Básico">Segundo Básico</option>
                                    <option value="Tercero Básico">Tercero Básico</option>
                                    <option value="Cuarto Diversificado">Cuarto Diversificado</option>
                                    <option value="Quinto Diversificado">Quinto Diversificado</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold small">Sección</label>
                                <input type="text" name="seccion" class="form-control rounded-3 shadow-sm" required placeholder="Ej. A">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Jornada</label>
                                <select name="jornada" class="form-select rounded-3 shadow-sm">
                                    <option value="Matutina">Matutina</option>
                                    <option value="Vespertina">Vespertina</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Fecha de Inscripción</label>
                                <input type="date" name="fecha_inscripcion" class="form-control rounded-3 shadow-sm" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Estado</label>
                                <select name="estado" class="form-select rounded-3 shadow-sm" required>
                                    <option value="">Seleccione un estado...</option>
                                    <option value="Nuevo inscrito">Nuevo inscrito</option>
                                    <option value="Reinscrito">Reinscrito</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                    <option value="Retirado">Retirado</option>
                                    <option value="Egresado">Egresado</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold small">Observaciones</label>
                                <textarea name="observaciones" class="form-control rounded-3 shadow-sm" rows="2" placeholder="Observaciones adicionales..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTONES DE ACCIÓN (Fuera del área del comprobante PDF para que no salgan impresos) -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" onclick="descargarPDF()" class="btn btn-danger rounded-pill px-4 py-2 shadow-sm fw-bold">
                    <i class="fa-solid fa-file-pdf me-2"></i>Descargar Comprobante PDF
                </button>
                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm fw-bold">
                    <i class="fa-solid fa-floppy-disk me-2"></i>Guardar Inscripción Oficial
                </button>
            </div>
        </form>
    </div>

    <!-- SCRIPTS COMPLETOS -->
    <script>
        let videoInscripcion = document.getElementById('videoCamaraInscripcion');
        let canvasInscripcion = document.getElementById('canvasFotoInscripcion');
        let previewInscripcion = document.getElementById('imgPreviewInscripcion');
        let placeholder = document.getElementById('placeholderText');
        let inputFotoInscripcion = document.getElementById('foto_base64_inscripcion');
        let streamCamaraInscripcion = null;

        async function iniciarCamaraInscripcion() {
            try {
                streamCamaraInscripcion = await navigator.mediaDevices.getUserMedia({ video: { width: 300, height: 300 } });
                videoInscripcion.srcObject = streamCamaraInscripcion;
                videoInscripcion.style.display = 'inline-block';
                inputFotoInscripcion.value = "";
            } catch (err) {
                alert("No se pudo acceder a la cámara web o se denegó el permiso.");
                console.error(err);
            }
        }

        function tomarFotoInscripcion() {
            if (!streamCamaraInscripcion) {
                alert("Primero debes encender la cámara web.");
                return;
            }
            let context = canvasInscripcion.getContext('2d');
            context.drawImage(videoInscripcion, 0, 0, 300, 300);
            
            let dataURL = canvasInscripcion.toDataURL('image/png');
            previewInscripcion.src = dataURL;
            previewInscripcion.classList.remove('d-none');
            placeholder.classList.add('d-none');
            inputFotoInscripcion.value = dataURL;

            streamCamaraInscripcion.getTracks().forEach(track => track.stop());
            streamCamaraInscripcion = null;
            videoInscripcion.style.display = 'none';
        }

        function subirArchivoInscripcion(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    previewInscripcion.src = e.target.result;
                    previewInscripcion.classList.remove('d-none');
                    placeholder.classList.add('d-none');
                }
                reader.readAsDataURL(input.files[0]);
                inputFotoInscripcion.value = "";
            }
        }

        function cargarDatosEstudiante(id) {
            if(!id) {
                document.getElementById('infoEstudiante').innerHTML = '<span class="text-muted italic">Seleccione un estudiante para ver sus datos aquí...</span>';
                return;
            }
            fetch(`<?= site_url('estudiantes/json/') ?>/${id}`)
                .then(res => res.json())
                .then(data => {
                    let nombres = data.nombres || data.nombre || '';
                    let apellidos = data.apellidos || data.apellido || '';
                    
                    document.getElementById('infoEstudiante').innerHTML = `
                        <div class="row">
                            <div class="col-6"><strong>Nombre:</strong> ${nombres} ${apellidos}</div>
                            <div class="col-6"><strong>Código:</strong> ${data.codigo || 'N/D'}</div>
                            <div class="col-6 mt-1"><strong>Género:</strong> ${data.genero || 'N/D'}</div>
                            <div class="col-6 mt-1"><strong>Teléfono:</strong> ${data.telefono || 'N/D'}</div>
                        </div>
                    `;
                })
                .catch(err => console.error("Error al cargar estudiante:", err));
        }

        function cargarDatosEncargado(id) {
            if(!id) {
                document.getElementById('infoEncargado').innerHTML = '<span class="text-muted italic">Seleccione un encargado para ver sus datos aquí...</span>';
                document.getElementById('input_nombre_padre').value = '';
                document.getElementById('input_apellido_padre').value = '';
                document.getElementById('input_parentesco_padre').value = '';
                document.getElementById('input_telefono_padre').value = '';
                document.getElementById('input_dpi_padre').value = '';
                document.getElementById('input_direccion_padre').value = '';
                return;
            }
            
            fetch(`<?= site_url('padres/json/') ?>/${id}`)
                .then(res => res.json())
                .then(data => {
                    let nombres = data.nombres || data.nombre || '';
                    let apellidos = data.apellidos || data.apellido || '';
                    let parentesco = data.parentesco || data.relacion || 'No especificado';
                    let dpi = data.dpi || data.cui || 'No registrado';
                    let telefono = data.telefono || data.celular || 'No registrado';
                    let direccion = data.direccion || 'No registrada';

                    document.getElementById('infoEncargado').innerHTML = `
                        <div class="row">
                            <div class="col-6"><strong>Nombre:</strong> ${nombres} ${apellidos}</div>
                            <div class="col-6"><strong>Parentesco:</strong> ${parentesco}</div>
                            <div class="col-6 mt-1"><strong>DPI:</strong> ${dpi}</div>
                            <div class="col-6 mt-1"><strong>Teléfono:</strong> ${telefono}</div>
                        </div>
                    `;

                    document.getElementById('input_nombre_padre').value = nombres;
                    document.getElementById('input_apellido_padre').value = apellidos;
                    document.getElementById('input_parentesco_padre').value = parentesco;
                    document.getElementById('input_telefono_padre').value = telefono;
                    document.getElementById('input_dpi_padre').value = dpi;
                    document.getElementById('input_direccion_padre').value = direccion;
                })
                .catch(err => console.error("Error al cargar encargado:", err));
        }

        function descargarPDF() {
            const elemento = document.getElementById('area-comprobante');
            const opciones = {
                margin:       10,
                filename:     'Comprobante_Inscripcion.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(opciones).from(elemento).save();
        }
    </script>
</body>
</html>