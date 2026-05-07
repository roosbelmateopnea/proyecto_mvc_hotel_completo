<?php

$fecha_hoy = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<?php require_once __DIR__ . '/../home.php'; ?>

<div class="container mt-3">
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-<?= $_SESSION['alert_type'] ?> alert-dismissible fade show shadow-sm border-0" role="alert">
            <div class="d-flex align-items-center text-white">
                <i class="bi <?= ($_SESSION['alert_type'] == 'danger') ? 'bi-trash' : 'bi-check-circle' ?> me-2"></i>
                <strong><?= $_SESSION['success']; ?></strong>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
        <?php 
            unset($_SESSION['success']); 
            unset($_SESSION['alert_type']); 
        ?>
    <?php endif; ?>
</div>

<div class="modal fade" id="modalReserva" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg border-0">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title"><i class="bi bi-calendar-check me-2"></i> Gestión de Reservas</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row g-4">
          
          <div class="col-lg-4 border-end">
            <h6 id="tituloForm" class="text-primary fw-bold mb-3">NUEVA RESERVA</h6>
            <form id="formReserva" method="POST" action="index.php?action=guardarReserva">
              
              <div class="mb-2">
                <label class="small text-muted">Tipo Habitación</label>
                <select id="tipo_habitacion" class="form-select">
                  <option value="">Seleccione</option>
                  <?php foreach($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['nombre'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-2">
                <label class="small text-muted">Habitación</label>
                <select name="id_habitacion" id="habitacionSelect" class="form-select" required>
                  <option value="">Seleccione</option>
                </select>
              </div>

              <div class="precio-contenedor">
                  <small>Precio / Noche</small>
                  <div id="labelPrecio" class="precio-texto">$0</div>
                  <input type="hidden" name="precio" id="inputPrecio">
              </div>

              <div class="row g-2 mb-2">
                <div class="col">
                    <label class="small text-muted">Llegada</label>
                    <input type="date" name="fecha_inicio" id="f_inicio" 
                           class="form-control" min="<?= $fecha_hoy ?>" required>
                </div>
                <div class="col">
                    <label class="small text-muted">Salida</label>
                    <input type="date" name="fecha_final" id="f_final" 
                           class="form-control" min="<?= $fecha_hoy ?>" required>
                </div>
              </div>

              <div class="mb-2">
                  <label class="small text-muted">Huéspedes</label>
                  <input type="number" name="num_personas" class="form-control" min="1" value="1" required>
              </div>

              <div class="mb-3">
                <label class="small text-muted">Método de Pago</label>
                <select name="id_metodo_pago" class="form-select" required>
                  <?php foreach($metodosPago as $m): ?>
                    <option value="<?= $m['id'] ?>"><?= $m['nombre'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="total-resumen">
                  Total Estancia: <span id="totalReserva">$0</span>
              </div>

              <button type="submit" id="btnGuardar" class="btn btn-primary w-100 mt-3">Guardar Reserva</button>
              <button type="button" id="btnCancelar" class="btn btn-link w-100 btn-sm d-none" onclick="location.reload()">Cancelar edición</button>
            </form>
          </div>

          <div class="col-lg-8">
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead class="table-dark">
                  <tr>
                    <th>Habitación</th>
                    <th>Fechas</th>
                    <th>Total</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php if(!empty($reservas)): foreach($reservas as $r): ?>
                    <tr>
                        <td class="fw-bold"><?= $r['habitacion'] ?></td>
                        <td class="small"><?= $r['fecha_inicio'] ?> / <?= $r['fecha_final'] ?></td>
                        <td class="text-success fw-bold">$<?= number_format($r['precio'], 0, ',', '.') ?></td>
                        <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn-corp btn-corp-edit" 
                                    onclick='editarReserva(<?= json_encode($r) ?>)'>
                                <i class="bi bi-pencil me-1"></i> Editar
                            </button>

                            <button class="btn-corp btn-corp-delete" 
                                    onclick="eliminarReserva(<?= $r['id'] ?>)">
                                <i class="bi bi-trash3 me-1"></i> Eliminar
                            </button>
                            
                            <button class="btn-corp btn-corp-print" 
                                    onclick="generarPDF(<?= $r['id'] ?>)" 
                                    title="Descargar Comprobante">
                                <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                            </button>
                        </div>
                    </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="4" class="text-center py-4">No tienes reservas registradas.</td></tr>
                <?php endif; ?>
                </tbody>
              </table>
              <a href="index.php?action=descargarExcel" 
                class="btn text-white shadow-sm" 
                style="background-color: #75553f; border: none;">
                  <i class="bi bi-file-earmark-excel me-2"></i> Reporte General Excel
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
const form = document.getElementById('formReserva');
const habitacionSelect = document.getElementById('habitacionSelect');
const precioInput = document.getElementById('inputPrecio');
const labelPrecio = document.getElementById('labelPrecio');
const totalReserva = document.getElementById('totalReserva');
const fInicio = document.getElementById('f_inicio');
const fFinal = document.getElementById('f_final');

fInicio.addEventListener('change', function() {
    const fechaSiguiente = new Date(this.value);
    fechaSiguiente.setDate(fechaSiguiente.getDate() + 1);
    const minFinal = fechaSiguiente.toISOString().split('T')[0];
    fFinal.min = minFinal;
    if (fFinal.value && fFinal.value <= this.value) {
        fFinal.value = "";
    }
    calcularTotal();
});

fFinal.addEventListener('change', calcularTotal);

document.getElementById('tipo_habitacion').addEventListener('change', async (e) => {
    const idCat = e.target.value;
    if(!idCat) {
        habitacionSelect.innerHTML = '<option value="">Seleccione</option>';
        return;
    }
    const res = await fetch(`index.php?action=getRoomsByType&type_room_id=${idCat}`);
    const json = await res.json();
    
    habitacionSelect.innerHTML = '<option value="">Seleccione</option>';
    json.data.forEach(h => {
        habitacionSelect.innerHTML += `<option value="${h.id}" data-precio="${h.precio}">Habitación ${h.num_habitacion}</option>`;
    });
});

habitacionSelect.addEventListener('change', (e) => {
    const option = e.target.options[e.target.selectedIndex];
    const precio = option.dataset.precio || 0;
    habitacionSelect.dataset.precioNoche = precio;
    labelPrecio.innerText = '$' + parseInt(precio).toLocaleString('es-CO');
    calcularTotal();
});

function calcularTotal() {
    const p = parseFloat(habitacionSelect.dataset.precioNoche) || 0;
    const d1 = new Date(fInicio.value);
    const d2 = new Date(fFinal.value);
    
    if (p > 0 && fInicio.value && fFinal.value && d2 > d1) {
        const noches = Math.ceil((d2 - d1) / (1000 * 60 * 60 * 24));
        const total = noches * p;
        totalReserva.innerText = '$' + total.toLocaleString('es-CO');
        precioInput.value = total;
    } else {
        totalReserva.innerText = '$0';
        precioInput.value = 0;
    }
}

window.editarReserva = function(data) {
    document.getElementById('tituloForm').innerText = "EDITAR RESERVA";
    form.action = `index.php?action=actualizarReserva&id=${data.id}`;
    
    fInicio.value = data.fecha_inicio;
    fFinal.value = data.fecha_final;
    fFinal.min = data.fecha_inicio;
    document.querySelector('[name="num_personas"]').value = data.num_personas;
    document.querySelector('[name="id_metodo_pago"]').value = data.id_metodo_pago;
    
    habitacionSelect.innerHTML = `<option value="${data.id_habitacion}" selected>Habitación actual</option>`;
    precioInput.value = data.precio;
    totalReserva.innerText = '$' + parseInt(data.precio).toLocaleString('es-CO');
    labelPrecio.innerText = '$' + parseInt(data.precio).toLocaleString('es-CO');

    document.getElementById('btnGuardar').innerText = "Actualizar Cambios";
    document.getElementById('btnGuardar').className = "btn btn-warning w-100 mt-3";
    document.getElementById('btnCancelar').classList.remove('d-none');
};

window.eliminarReserva = function(id) {
    if(confirm('¿Seguro que deseas eliminar esta reserva?')) {
        window.location.href = `index.php?action=eliminarReserva&id=${id}`;
    }
};

window.generarPDF = function(id) {
    window.open(`index.php?action=descargarComprobante&id=${id}`, '_blank');
};
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>