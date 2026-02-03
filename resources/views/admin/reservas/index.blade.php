@extends('layouts.admin')
@section('aditional_styles')
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      padding: 20px;
      min-height: 100vh;
      color: #333;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
    }

    header {
      text-align: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid #4a6fa5;
    }

    h1 {
      color: #2c3e50;
      margin-bottom: 10px;
      font-size: 2.2rem;
    }

    .subtitle {
      color: #7f8c8d;
      font-size: 1rem;
    }

    .main-card {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    @media (max-width: 768px) {
      .form-grid {
        grid-template-columns: 1fr;
      }
    }

    .form-group {
      margin-bottom: 18px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #2c3e50;
    }

    input, select {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 16px;
      transition: border 0.3s;
    }

    input:focus, select:focus {
      outline: none;
      border-color: #4a6fa5;
      box-shadow: 0 0 0 2px rgba(74, 111, 165, 0.2);
    }

    input[disabled] {
      background-color: #f5f5f5;
      cursor: not-allowed;
    }

    .personas-input {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-top: 10px;
    }

    .personas-boton {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #4a6fa5;
      color: white;
      border: none;
      font-size: 20px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .personas-boton:hover {
      background: #2c3e50;
    }

    .personas-boton:disabled {
      background: #cccccc;
      cursor: not-allowed;
    }

    .personas-valor {
      font-size: 24px;
      font-weight: bold;
      min-width: 40px;
      text-align: center;
    }

    .cupos-disponibles {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px;
      background: #e8f4fc;
      border-radius: 8px;
      margin-top: 10px;
    }

    .cupos-text {
      font-size: 1.1rem;
      font-weight: 600;
    }

    .cupos-badge {
      background: #2c3e50;
      color: white;
      padding: 8px 15px;
      border-radius: 20px;
      font-weight: bold;
    }

    .btn-reservar {
      background: linear-gradient(to right, #4a6fa5, #2c3e50);
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 18px;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      font-weight: 600;
      transition: transform 0.2s, box-shadow 0.2s;
      margin-top: 20px;
    }

    .btn-reservar:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(44, 62, 80, 0.2);
    }

    .btn-reservar:disabled {
      background: #cccccc;
      cursor: not-allowed;
      opacity: 0.6;
    }

    .btn-reservar:active:not(:disabled) {
      transform: translateY(0);
    }

    .msg {
      margin-top: 20px;
      padding: 15px;
      border-radius: 6px;
      font-weight: bold;
      text-align: center;
      display: none;
    }

    .msg.success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      display: block;
    }

    .msg.error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
      display: block;
    }

    .msg.warning {
      background-color: #fff3cd;
      color: #856404;
      border: 1px solid #ffeaa7;
      display: block;
    }

    .zonas-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 15px;
      margin-top: 15px;
    }

    .zona-card {
      background: white;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
      border: 2px solid transparent;
      transition: all 0.3s;
      cursor: pointer;
    }

    .zona-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      border-color: #4a6fa5;
    }

    .zona-card.selected {
      border-color: #4a6fa5;
      background-color: #f0f7ff;
    }

    .zona-titulo {
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 8px;
    }

    .zona-cupos {
      font-size: 0.9rem;
      color: #7f8c8d;
    }

    .zona-tipo {
      display: inline-block;
      padding: 3px 8px;
      border-radius: 12px;
      font-size: 0.8rem;
      margin-top: 8px;
    }

    .tipo-general { background-color: #e8f5e9; color: #2e7d32; }
    .tipo-piscina { background-color: #e3f2fd; color: #1565c0; }
    .tipo-gimnasio { background-color: #fff3e0; color: #ef6c00; }

    .horario-info {
      font-size: 0.9rem;
      color: #666;
      margin-top: 8px;
      font-style: italic;
    }

    footer {
      text-align: center;
      margin-top: 30px;
      color: #7f8c8d;
      font-size: 0.9rem;
    }
    
    .no-disponible {
      color: #e74c3c;
      font-weight: bold;
      margin-top: 10px;
    }
    
    .hora-option.disabled {
      color: #999;
      background-color: #f5f5f5;
    }
    
    .personas-label {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .personas-label span {
      font-size: 0.9rem;
      color: #7f8c8d;
      font-weight: normal;
    }
    
    .warning-text {
      color: #e74c3c;
      font-weight: bold;
      margin-top: 5px;
    }
    
    .fecha-info {
      background: #fff3cd;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
      border-left: 4px solid #ffc107;
      display: none;
    }
    
    /* Estilos para el selector de fecha personalizado */
    .datepicker-container {
      position: relative;
    }
    
    .datepicker-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      font-size: 18px;
      color: #4a6fa5;
    }
    
    .calendar-popup {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      width: 300px;
      background: white;
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 15px;
      z-index: 1000;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    
    .calendar-weekdays {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      text-align: center;
      font-weight: bold;
      margin-bottom: 5px;
      font-size: 0.9rem;
    }
    
    .calendar-days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 2px;
    }
    
    .calendar-day {
      padding: 8px;
      text-align: center;
      cursor: pointer;
      border-radius: 4px;
      font-size: 0.9rem;
    }
    
    .calendar-day:hover:not(.disabled):not(.monday) {
      background-color: #e8f4fc;
    }
    
    .calendar-day.selected {
      background-color: #4a6fa5;
      color: white;
    }
    
    .calendar-day.disabled {
      color: #ccc;
      cursor: not-allowed;
      background-color: #f5f5f5;
    }
    
    .calendar-day.monday {
      background-color: #ffebee;
      color: #e74c3c;
      cursor: not-allowed;
    }
    
    .calendar-day.festivo {
      background-color: #e8f5e9;
      color: #2e7d32;
      font-weight: bold;
    }
    
    .calendar-day.other-month {
      color: #ccc;
    }
    
    .calendar-day.pasada {
      background-color: #f5f5f5;
      color: #ccc;
      cursor: not-allowed;
    }
    
    .calendar-nav {
      background: none;
      border: none;
      font-size: 16px;
      cursor: pointer;
      padding: 5px 10px;
      border-radius: 4px;
      color: #4a6fa5;
    }
    
    .calendar-nav:hover {
      background-color: #f0f0f0;
    }
    
    .festivo-indicator {
      display: inline-block;
      width: 6px;
      height: 6px;
      background-color: #2e7d32;
      border-radius: 50%;
      margin-left: 2px;
    }
    
    .hora-pasada {
      text-decoration: line-through;
      color: #999;
    }

    /* Estilos para el modal/popup de confirmación */
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 2000;
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      width: 90%;
      max-width: 500px;
      position: relative;
      animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid #4a6fa5;
    }

    .modal-title {
      color: #2c3e50;
      font-size: 1.5rem;
      margin: 0;
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #7f8c8d;
      transition: color 0.3s;
    }

    .modal-close:hover {
      color: #e74c3c;
    }

    .reserva-info {
      margin: 20px 0;
    }

    .info-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      padding-bottom: 8px;
      border-bottom: 1px solid #eee;
    }

    .info-label {
      font-weight: 600;
      color: #2c3e50;
      flex: 1;
    }

    .info-value {
      flex: 1;
      text-align: right;
      color: #333;
      font-weight: 500;
    }

    .modal-footer {
      margin-top: 25px;
      text-align: center;
    }

    .btn-cerrar-modal {
      background: #4a6fa5;
      color: white;
      border: none;
      padding: 12px 25px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s;
    }

    .btn-cerrar-modal:hover {
      background: #2c3e50;
    }

    .reserva-id {
      text-align: center;
      font-size: 0.9rem;
      color: #7f8c8d;
      margin-top: 10px;
      font-style: italic;
    }

    .icono-reserva {
      font-size: 40px;
      text-align: center;
      margin-bottom: 15px;
    }
  
    .modal-overlay{
      position:fixed;
      inset:0;
      background:rgba(0,0,0,.6);
      display:flex;
      align-items:center;
      justify-content:center;
      z-index:9999;
    }
    .modal-box{
      background:#fff;
      padding:20px;
      border-radius:8px;
      width:100%;
      max-width:420px;
    }
    .modal-close{
      float:right;
      background:none;
      border:none;
      font-size:18px;
      cursor:pointer;
    }
    .btn-ok{
      margin-top:15px;
      padding:8px 15px;
      border:none;
      background:#2c3e50;
      color:#fff;
      border-radius:5px;
      cursor:pointer;
    }
  </style>
@endsection
@section('content')
  <title>Reserva de Zonas Comunes</title>
    <header>
      <div class="card mb-3">
          <strong>
              <h2 style="text-align:center;">NOTA IMPORTANTE</h2>
          </strong>
          <h5 style="text-align:justify;">El primer dia habil de la semana no habra servicio en las zonas comunes debido a labores de mantenimiento general. Usualmente corresponde al dia lunes; sin embargo, si es festivo, el mantenimiento se realizará el dia martes.</h5>
          <h5 style="text-align:justify;">Apreciamos su colaboración en el proceso de reserva. Para garantizar una experiencia óptima, le solicitamos amablemente que incluya a todos los residentes e invitados que lo acompañarán en su reservación. Esto nos permitirá ofrecer un servicio personalizado y eficiente para todos los involucrados.</h5>
      </div>
      <h2 class="text-center mb-4">Formulario de Reserva de Zonas Comunes</h2>
    </header>
    <div>
      <main>
        <div class="main-card">
          <h2>Nueva Reserva</h2>
          <form id="formReserva">
            @csrf
            <div class="form-grid">
              <div class="form-group">
                <label for="nombre_completo">Nombre Completo *</label>
                <input type="text" name="nombre_completo" id="nombre_completo" placeholder="Ingrese su nombre completo" required>
              </div>

              <div class="form-group">
                <label for="identificacion">Identificación *</label>
                <input type="text" name="identificacion" id="identificacion" placeholder="Número de cédula" required>
              </div>
              
              <div class="form-group">
                <label for="email">Correo *</label>
                <input type="text" name="email" id="email" placeholder="Correo Electronico" required>
              </div>
              
              <div class="form-group">
                <label for="celular">Celular *</label>
                <input type="text" name="celular" id="celular" placeholder="Numero Celular" required>
              </div>

              <div class="form-group">
                <label for="interior">Torre/Interior *</label>
                <input type="text" name="interior" id="interior" placeholder="Ej: Torre 1, Interior 2..." required>
              </div>

              <div class="form-group">
                <label for="apartamento">Apartamento *</label>
                <input type="text" name="apartamento" id="apartamento" placeholder="Número de apartamento" required>
              </div>
            </div>
            <div class="form-group">
              <label>Seleccione una zona común:</label>
              <div class="zonas-grid" id="zonas-container">
                <!-- Las zonas se generarán con JavaScript -->
              </div>
            </div>
            <div class="form-grid">
              <div class="form-group">
                <label for="fecha">Fecha *</label>
                <div class="datepicker-container">
                  <input type="text" name="fecha" id="fecha" required readonly placeholder="Haga clic para seleccionar fecha">
                  <button class="datepicker-toggle" onclick="toggleCalendar()">📅</button>
                  <div class="calendar-popup" id="calendar-popup">
                    <!-- Calendario personalizado se generará aquí -->
                  </div>
                </div>
                <!-- <div class="warning-text">¡ATENCIÓN! Los lunes no hay reservas disponibles</div> -->
              </div>

              <div class="form-group">
                <label for="hora">Hora *</label>
                <select name="hora" id="hora" required>
                  <option value="">Seleccione primero una fecha y zona</option>
                </select>
              </div>
            </div>
            <div class="cupos-disponibles" id="cupos-disponibles" style="display: none;">
              <span class="cupos-text">Cupos disponibles:</span>
              <span class="cupos-badge" id="cupos-badge">0/0</span>
            </div>
            <div id="mensaje-no-disponible" class="no-disponible" style="display: none;">
              No hay reservas disponibles para esta fecha
            </div>
            <button class="btn-reservar" id="btn-reservar" disabled>Confirmar Reserva</button>
          </form>
          <div class="msg" id="mensaje"></div>
        </div>
        {{-- Modal para ver la imagen --}}
        <div class="modal fade" id="modalImagen" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img id="imagenModal" src="" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
      </main>
    </div>
  <div id="modalReserva" class="modal-overlay" style="display:none;">
    <div class="modal-box">
      <button class="modal-close" onclick="cerrarModal()">✖</button>
      <h3>✅ Reserva confirmada</h3>
      <div id="reserva-detalles"></div>
      <button class="btn-ok" onclick="cerrarModal()">Cerrar</button>
    </div>
  </div>

  @endsection
  @section('javascripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script>
    const reglasPorZona = @json($reglasPorZona);

    let zonas = {};
    let horariosZonaActual = [];
    let zonaSeleccionada = null;

    /* =====================================================
      MOSTRAR MODAL CON DATOS DE LA RESERVA
    ===================================================== */
    function mostrarModalReserva(reserva) {

        const modal = document.getElementById('modalReserva');
        const detalles = document.getElementById('reserva-detalles');

        if (!modal || !detalles) return;

        detalles.innerHTML = `
            <p><strong>ID:</strong> ${reserva.id ?? 'N/A'}</p>
            <p><strong>Zona:</strong> ${reserva.zona ?? 'N/A'}</p>
            <p><strong>Fecha:</strong> ${reserva.fecha ?? 'N/A'}</p>
            <p><strong>Hora:</strong> ${reserva.hora ?? 'N/A'}</p>
            <p><strong>Personas:</strong> ${reserva.personas ?? 'N/A'}</p>
            <p><strong>Registrado:</strong> ${reserva.created_at ?? new Date().toLocaleString()}</p>
        `;

        modal.style.display = 'flex';
    }

    function obtenerHorarioSemana(zona) {
        if (!reglasPorZona[zona]) return [];

        return reglasPorZona[zona].semana || [];
    }

    function obtenerHorarioFinSemana(zona) {
        if (!reglasPorZona[zona]) return [];

        return reglasPorZona[zona].finde || [];
    }



    /* =====================================================
      CERRAR MODAL
    ===================================================== */
    function cerrarModal(){
        const modal = document.getElementById('modalReserva');
        if (modal) modal.style.display = 'none';
    }

    /* =====================================================
      VARIABLES SEGURAS
    ===================================================== */
    const btnReservar = document.getElementById('btn-reservar');
    const horaSelect = document.getElementById('hora');
    const fechaInput = document.getElementById('fecha');

    /* =====================================================
      HABILITAR BOTÓN AL SELECCIONAR HORA
    ===================================================== */
    if (horaSelect && btnReservar) {
      horaSelect.addEventListener('change', () => {
        btnReservar.disabled = !horaSelect.value;
      });
    }

    function cargarHorariosZona(zonaId) {

      return $.get(`/zonas/${zonaId}/horarios`)
          .done(function (data) {
              horariosZonaActual = data;
              console.log('✅ Horarios BD cargados:', horariosZonaActual);
          })
          .fail(function () {
              // console.error('❌ Error cargando horarios de la zona');
          });
    }

    function cargarZonasDesdeBD() {
      return fetch('/zonas/comunes/')
        .then(res => res.json())
        .then(data => {
          data.zonas.forEach(zona => {
            let tipo = 'general';
            let icon = '🏢';
            let mostrarCupos = false;
            // console.log(zona);

            const nombre = zona.nombre.toLowerCase();

            if (nombre.includes('piscina')) {
              tipo = 'piscina';
              icon = '🏊‍♂️';
              mostrarCupos = true;
            } else if (nombre.includes('gimnasio')) {
              tipo = 'gimnasio';
              icon = '💪';
              mostrarCupos = true;
            } else if (nombre.includes('ludoteca')) {
              icon = '🧩';
              mostrarCupos = true;
            } else if (nombre.includes('ping')) {
              icon = '🏓';
            } else if (nombre.includes('billar')) {
              icon = '🎱';
            } else if (nombre.includes('bolirrana')) {
              icon = '🎯';
            } else if (nombre.includes('futbol')) {
              icon = '⚽';
            }

            zonas[zona.nombre] = {
              id: zona.id,
              cupos: zona.limite ?? 1,
              tipo,
              icon,
              informacion: zona.descripcion || '',
              // horarioSemana: obtenerHorarioSemana(tipo),
              // horarioFinSemana: obtenerHorarioFinSemana(tipo),
              mostrarCupos
            };
          });
        });
    }

    /* =====================================================
      FESTIVOS
    ===================================================== */
    const festivos = [
      "2024-01-01","2024-01-08","2024-03-25","2024-03-28","2024-03-29",
      "2024-03-31","2024-05-01","2024-05-13","2024-06-03","2024-06-10",
      "2024-07-01","2024-07-20","2024-08-07","2024-08-19","2024-10-14",
      "2024-11-04","2024-11-11","2024-12-08","2024-12-25","2025-01-01",
      "2025-01-06","2025-03-24","2025-04-17","2025-04-18",
      "2025-04-20","2025-05-01","2025-05-02","2025-06-23","2025-06-30",
      "2025-07-20","2025-08-07","2025-08-18","2025-10-13","2025-11-03",
      "2025-11-17","2025-12-08","2025-12-25","2026-01-01","2026-01-12",
      "2026-03-23","2026-04-02","2026-04-03",
      "2026-05-01","2026-05-18","2026-06-08","2026-06-15","2026-06-29",
      "2026-07-20","2026-08-07","2026-08-17","2026-10-12","2026-11-02",
      "2026-11-16","2026-12-08","2026-12-25","2027-01-01","2027-01-11",
      "2027-03-22","2027-03-25","2027-03-26",
      "2027-05-01","2027-05-10","2027-05-31","2027-06-07","2027-07-05",
      "2027-07-20","2027-08-07","2027-08-16","2027-10-18","2027-11-01",
      "2027-11-15","2027-12-08","2027-12-25","2028-01-01","2028-01-10",
      "2028-03-20","2028-04-13","2028-04-14",
      "2028-05-01","2028-05-29","2028-06-19","2028-06-26","2028-07-03",
      "2028-07-20","2028-08-07","2028-08-21","2028-10-16","2028-11-06",
      "2028-11-13","2028-12-08","2028-12-25","2029-01-01","2029-01-08",
      "2029-03-19","2029-03-29","2029-03-30",
      "2029-05-01","2029-05-14","2029-06-04","2029-06-11","2029-07-02",
      "2029-07-20","2029-08-07","2029-08-20","2029-10-15","2029-11-05",
      "2029-11-12","2029-12-08","2029-12-25","2030-01-01","2030-01-07",
      "2030-03-25","2030-04-18","2030-04-19",
      "2030-05-01","2030-06-03","2030-06-24","2030-07-01","2030-07-20",
      "2030-08-07","2030-08-19","2030-10-14","2030-11-04","2030-11-11",
      "2030-12-08","2030-12-25"
    ];

    /* =====================================================
      STORAGE Y VARIABLES (IGUAL)
    ===================================================== */
    let reservas = JSON.parse(localStorage.getItem('reservas')) || {};
    let reservasUsuario = JSON.parse(localStorage.getItem('reservasUsuario')) || [];

    let personasSeleccionadas = 1;
    // let zonaSeleccionada = "";
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let reservaActual = null;

    /* =====================================================
      INIT (ESPERA ZONAS BD)
    ===================================================== */
    document.addEventListener('DOMContentLoaded', async function () {
      await cargarZonasDesdeBD();

      const popup = new bootstrap.Modal(
          document.getElementById('popupModal')
      );
      popup.show();

      const zonasContainer = document.getElementById('zonas-container');

      zonasContainer.innerHTML = '';

      Object.keys(zonas).forEach(zona => {
        const zonaInfo = zonas[zona];
        const zonaCard = document.createElement('div');
        zonaCard.className = 'zona-card';
        zonaCard.setAttribute('data-zona-id', zonaInfo.id);

        let cuposHTML = '';
        if (zonaInfo.mostrarCupos) {
          cuposHTML = `<div class="zona-cupos">Cupos máx: ${zonaInfo.cupos} persona(s)</div>`;
        }

        zonaCard.innerHTML = `
          <div class="zona-titulo">${zonaInfo.icon} ${zona}</div>
          ${cuposHTML}
          <div class="zona-tipo tipo-${zonaInfo.tipo}">
            ${zonaInfo.tipo.charAt(0).toUpperCase() + zonaInfo.tipo.slice(1)}
          </div>
          <div class="horario-info">
            <br>${zonaInfo.informacion}<br>
          </div>
          `;

        zonaCard.addEventListener('click', async function () {
            document.querySelectorAll('.zona-card').forEach(card => card.classList.remove('selected'));
            this.classList.add('selected');

            zonaSeleccionada = zona;

            // 🔥 CARGAR HORARIOS DESDE BD
            await cargarHorariosZona(zonaInfo.id ?? zona);

            actualizarMaximoPersonas();
            actualizarInfo();
        });

        zonasContainer.appendChild(zonaCard);
      });

      initCalendar();

      const hoy = new Date();
      document.getElementById('fecha').value = formatDateForInput(hoy);

      actualizarMaximoPersonas();
      deshabilitarFormulario();

    });

    // Elementos del DOM
    const cuposDiv = document.getElementById('cupos-disponibles');
    const cuposBadge = document.getElementById('cupos-badge');
    const mensajeNoDisponible = document.getElementById('mensaje-no-disponible');
    const personasValor = document.getElementById('personas-valor');
    const personasInput = document.getElementById('personas');
    // const maxPersonasSpan = document.getElementById('max-personas');
    const modalReserva = document.getElementById('modalReserva');
    const modalDetalles = document.getElementById('reserva-detalles');
    const modalIcono = document.getElementById('modal-icono');
    const modalId = document.getElementById('modal-id');

    // Función para formatear fecha para input (YYYY-MM-DD) sin problemas de huso horario
    function formatDateForInput(date) {
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');
      return `${year}-${month}-${day}`;
    }

    // Función para parsear fecha desde string YYYY-MM-DD evitando problemas de huso horario
    function parseDateFromString(dateStr) {
      const [year, month, day] = dateStr.split('-').map(Number);
      // Crear fecha en hora local
      return new Date(year, month - 1, day);
    }

    // Función para obtener nombre del día en español
    function obtenerNombreDia(fecha) {
      const dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
      return dias[fecha.getDay()];
    }

    // Función para obtener nombre del mes en español
    function obtenerNombreMes(fecha) {
      const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      return meses[fecha.getMonth()];
    }

    // Cerrar modal
    function cerrarModal() {
      modalReserva.style.display = 'none';
    }

    // Limpiar formulario después de reserva exitosa
    function limpiarFormulario() {
      // Limpiar campos del formulario
      document.getElementById('conjunto').value = '';
      document.getElementById('nombre_completo').value = '';
      document.getElementById('identificacion').value = '';
      document.getElementById('interior').value = '';
      document.getElementById('apartamento').value = '';
      
      // Resetear número de personas
      personasSeleccionadas = 1;
      personasValor.textContent = '1';
      personasInput.value = '1';
      // maxPersonasSpan.textContent = '(Máximo: 1 persona)';
      
      // Deseleccionar zona
      document.querySelectorAll('.zona-card').forEach(card => {
        card.classList.remove('selected');
      });
      zonaSeleccionada = '';
      
      // Resetear fecha (poner hoy) - CORREGIDO
      const hoy = new Date();
      const hoyStr = formatDateForInput(hoy);
      fechaInput.value = hoyStr;
      
      // Resetear hora
      horaSelect.innerHTML = '<option value="">Seleccione primero una fecha y zona</option>';
      // Ocultar elementos
      cuposDiv.style.display = 'none';
      mensajeNoDisponible.style.display = 'none';
      // btnReservar.disabled = true;
      
      // Actualizar calendario
      generarCalendario(currentMonth, currentYear);
    }

    // Obtener la hora actual
    function obtenerHoraActual() {
      const ahora = new Date();
      return {
        horas: ahora.getHours(),
        minutos: ahora.getMinutes(),
        horaStr: `${ahora.getHours().toString().padStart(2, '0')}:${ahora.getMinutes().toString().padStart(2, '0')}`
      };
    }


    function obtenerHoraString(horaData) {
        if (!horaData) return null;

        if (typeof horaData === 'string') {
            return horaData;
        }

        if (typeof horaData === 'object' && horaData.hora) {
            return horaData.hora;
        }

        return null;
    }

    function horaYaPaso(horaData, fechaSeleccionada) {

        const hora24 = obtenerHoraString(horaData);
        if (!hora24) return false;

        const hoy = new Date();
        const fechaHoyStr = formatDateForInput(hoy);

        if (fechaSeleccionada === fechaHoyStr) {

            const horaActual = obtenerHoraActual();
            const [h, m] = hora24.split(':').map(Number);

            if (h < horaActual.horas) return true;
            if (h === horaActual.horas && m < horaActual.minutos) return true;
        }

        return false;
    }

    // Inicializar calendario
    function initCalendar() {
      generarCalendario(currentMonth, currentYear);
      
      document.addEventListener('click', function(event) {
        const calendar = document.getElementById('calendar-popup');
        const datepicker = document.querySelector('.datepicker-toggle');
        const fechaField = document.getElementById('fecha');
        
        if (!calendar.contains(event.target) && 
            event.target !== datepicker && 
            event.target !== fechaField) {
          calendar.style.display = 'none';
        }
      });
    }

    // Generar calendario
    function generarCalendario(month, year) {
      const calendar = document.getElementById('calendar-popup');
      const firstDay = new Date(year, month, 1);
      const lastDay = new Date(year, month + 1, 0);
      const startingDay = firstDay.getDay();
      const monthLength = lastDay.getDate();
      
      const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                         "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
      
      const dayNames = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];
      
      let calendarHTML = `
        <div class="calendar-header">
          <button class="calendar-nav" onclick="cambiarMes(-1)">◀️</button>
          <h3 style="margin: 0; font-size: 1rem;">${monthNames[month]} ${year}</h3>
          <button class="calendar-nav" onclick="cambiarMes(1)">▶️</button>
        </div>
        <div class="calendar-weekdays">
      `;
      
      for (let i = 0; i < 7; i++) {
        calendarHTML += `<div>${dayNames[i]}</div>`;
      }
      
      calendarHTML += `</div><div class="calendar-days">`;
      
      for (let i = 0; i < startingDay; i++) {
        calendarHTML += `<div class="calendar-day other-month"></div>`;
      }
      
      const hoy = new Date();
      const hoyDate = hoy.getDate();
      const hoyMonth = hoy.getMonth();
      const hoyYear = hoy.getFullYear();
      
      for (let day = 1; day <= monthLength; day++) {
        const dayOfWeek = new Date(year, month, day).getDay();
        const dateStr = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
        const fechaSeleccionada = new Date(year, month, day);
        const esHoy = day === hoyDate && month === hoyMonth && year === hoyYear;
        const esPasado = fechaSeleccionada < new Date(hoyYear, hoyMonth, hoyDate);
        // const esMonday = dayOfWeek === 1;
        const esFestivo = festivos.includes(dateStr);
        let className = 'calendar-day';
        
        if (esHoy) className += ' selected';
        if (esPasado) className += ' pasada disabled';
        // if (esMonday) className += ' monday disabled';
        // if (esFestivo && !esMonday && !esPasado) className += ' festivo';
        if (esFestivo && !esPasado) className += ' festivo';
        
        const esSeleccionable = !esPasado;
        
        calendarHTML += `<div class="${className}" data-date="${dateStr}" ${esSeleccionable ? `onclick="seleccionarFecha('${dateStr}')"` : ''}>
          ${day}
          ${esFestivo ? '<span class="festivo-indicator" title="Festivo"></span>' : ''}
        </div>`;
      }
      
      calendarHTML += `</div>`;
      calendar.innerHTML = calendarHTML;
    }

    // Cambiar mes en el calendario
    function cambiarMes(direction) {
      currentMonth += direction;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      } else if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      generarCalendario(currentMonth, currentYear);
    }

    // Mostrar/ocultar calendario
    function toggleCalendar() {
      const calendar = document.getElementById('calendar-popup');
      calendar.style.display = calendar.style.display === 'block' ? 'none' : 'block';
    }

    function seleccionarFecha(fecha) {
        fechaInput.value = fecha;

        // ⚠️ Debe existir zona seleccionada
        if (!zonaSeleccionada) {
            // console.warn('⚠️ Seleccione una zona antes de la fecha');
            return;
        }

        // ⚠️ Deben existir horarios cargados desde BD
        if (!horariosZonaActual.length) {
            console.warn('⚠️ No hay horarios cargados para la zona');
            return;
        }

        // 🔥 RECALCULAR HORAS AL CAMBIAR FECHA
        actualizarInfo();
    }

    // Función para cambiar número de personas
    function cambiarPersonas(cambio) {}

    // Actualizar máximo de personas según zona seleccionada
    function actualizarMaximoPersonas() {
      if (zonaSeleccionada && zonas[zonaSeleccionada]) {
        let maxCupos = 30;
        
        if (zonaSeleccionada === "Ludoteca" || zonaSeleccionada === "Piscina" || zonaSeleccionada === "Piscina de Niños" || zonaSeleccionada === "Gimnasio") {
          maxCupos = zonas[zonaSeleccionada].cupos;
        }
        
        // maxPersonasSpan.textContent = `(Máximo: ${maxCupos} persona${maxCupos > 1 ? 's' : ''})`;
        
        if (personasSeleccionadas > maxCupos) {
          personasSeleccionadas = maxCupos;
          personasValor.textContent = maxCupos;
          personasInput.value = maxCupos;
        }
        
        const botonesPersonas = document.querySelectorAll('.personas-boton');
        if (botonesPersonas.length > 0) {
          botonesPersonas[0].disabled = personasSeleccionadas <= 1;
          botonesPersonas[1].disabled = personasSeleccionadas >= maxCupos;
        }
      }
    }

    // Determinar si es día laboral (martes a viernes) - CORREGIDO
    function esDiaLaboral(fecha) {
      const fechaObj = parseDateFromString(fecha);
      const d = fechaObj.getDay();
      return d >= 2 && d <= 5;
    }

    // Determinar si es festivo
    function esFestivo(fecha) {
      return festivos.includes(fecha);
    }

    function obtenerTipoDia(fecha) {
        // 1️⃣ Verificar si es festivo
        if (esFestivo(fecha)) {
            return 'Festivo';
        }

        // 2️⃣ Obtener día de la semana
        const fechaObj = parseDateFromString(fecha);
        const diaSemana = fechaObj.getDay(); 
        // 0 = Domingo, 1 = Lunes, 2 = Martes, 3 = Miércoles,
        // 4 = Jueves, 5 = Viernes, 6 = Sábado

        // 3️⃣ Clasificar según el día
        switch (diaSemana) {
            case 1:
                return 'Lunes';
            case 2:
                return 'Martes';
            case 3:
                return 'Miércoles';
            case 4:
                return 'Jueves';
            case 5:
                return 'Viernes';
            case 6:
                return 'Sábado';
            case 0:
                return 'Domingo';
            default:
                return 'No disponible';
        }
    }

    function convertirHora12(horaData) {

        const hora24 = obtenerHoraString(horaData);
        if (!hora24) return '';

        const partes = hora24.split(':');
        if (partes.length !== 2) return '';

        let horas = Number(partes[0]);
        const minutos = partes[1];
        const ampm = horas >= 12 ? 'PM' : 'AM';

        horas = horas % 12;
        horas = horas ? horas : 12; // 0 → 12

        return `${horas}:${minutos} ${ampm}`;
    }

    $('#zona_id').on('change', function () {
        const zonaId = $(this).val();
        zonaSeleccionada = this.value;

        inicioPicker.clear();
        finPicker.clear();

        horariosZonaActual = [];
        $('#hora').html('<option value="">Seleccione una fecha</option>');

        if (!zonaId) return;

        $.get(`/zonas/${zonaId}/horarios`, function (data) {

            horariosZonaActual = data.sort((a, b) =>
                b.hora_fin.localeCompare(a.hora_fin)
            );

            console.log('Horarios ordenados por hora_fin:', horariosZonaActual);
        });
    });

    function horasPermitidas(zona, fecha) {
      if (!fecha || !zona) return [];

      const tipoDia = obtenerTipoDia(fecha);
      let horas = [];

      const horariosOrdenados = horariosZonaActual
          .filter(h => h.tipo_dia === tipoDia)
          .sort((a, b) => a.hora_inicio.localeCompare(b.hora_inicio));

      horariosOrdenados.forEach(h => {

          let inicio = moment(h.hora_inicio, 'HH:mm:ss');
          let fin = moment(h.hora_fin, 'HH:mm:ss');
          let intervalo = h.intervalo || 60;

          while (inicio < fin) {
              horas.push({
                  hora: inicio.format('HH:mm'),
                  horario_id: h.id
              });
              inicio.add(intervalo, 'minutes');
          }
      });

      return horas;
    }

    function deshabilitarFormulario() {
      const cuposDiv = document.getElementById('cuposDiv');
      const mensajeNoDisponible = document.getElementById('mensajeNoDisponible');

      if (btnReservar) btnReservar.disabled = true;

      if (horaSelect) {
        horaSelect.innerHTML = '<option value="">Seleccione primero una fecha y zona</option>';
      }

      if (cuposDiv) cuposDiv.style.display = 'none';
      if (mensajeNoDisponible) mensajeNoDisponible.style.display = 'none';
    }

    // Mostrar mensaje
    function mostrarMensaje(tipo, texto) {
      const msg = document.getElementById('mensaje');
      msg.textContent = texto;
      msg.className = `msg ${tipo}`;
      
      setTimeout(() => {
        msg.className = 'msg';
        msg.textContent = '';
      }, 5000);
    }

    function actualizarInfo() {
      const personasInput = document.getElementById('personas');
      const cuposDiv = document.getElementById('cupos-disponibles');
      const mensajeNoDisponible = document.getElementById('mensaje-no-disponible');

      const fecha = fechaInput ? fechaInput.value : '';
      const personas = personasInput ? personasInput.value : '';

      if (!zonaSeleccionada || !fecha) {
        deshabilitarFormulario();
        return;
      }

      horaSelect.innerHTML = '<option value="">Seleccione una hora</option>';
      
      cuposDiv.style.display = 'none';
      mensajeNoDisponible.style.display = 'none';

      const horasDisponibles = horasPermitidas(zonaSeleccionada, fecha);


      if (horasDisponibles.length === 0) {
        mensajeNoDisponible.textContent = 'No hay horarios disponibles para esta fecha';
        mensajeNoDisponible.style.display = 'block';
        return;
      }

      const horasConDisponibilidad = [];
      const hoy = new Date();
      const fechaHoyStr = formatDateForInput(hoy);
      const esHoy = fecha === fechaHoyStr;

      horasDisponibles.forEach(hora => {

        const key = `${zonaSeleccionada}_${fecha}_${hora}`;
        const reservasActuales = reservas[key] || 0;

        let cuposDisponibles;
        let hora_id = hora.horario_id || null;
        let disponible;

        if (
          zonaSeleccionada === "Ludoteca" ||
          zonaSeleccionada === "Piscina" ||
          zonaSeleccionada === "Bolirrana" ||
          zonaSeleccionada === "Piscina de Niños" ||
          zonaSeleccionada === "Gimnasio"
        ) {
          cuposDisponibles = zonas[zonaSeleccionada].cupos - reservasActuales;
          disponible = cuposDisponibles >= personas && !(esHoy && horaYaPaso(hora, fecha));
        } else {
          cuposDisponibles = 1 - reservasActuales;
          disponible = reservasActuales === 0 && !(esHoy && horaYaPaso(hora, fecha));
        }

        horasConDisponibilidad.push({
          hora,
          disponible,
          cuposDisponibles,
          yaPaso: esHoy && horaYaPaso(hora, fecha)
        });
      });

      // console.log( horasConDisponibilidad );

      horasConDisponibilidad.forEach(item => {
        const opt = document.createElement('option');
        opt.value = item.hora.horario_id;
        const hora12 = convertirHora12(item.hora.hora);

        if (item.yaPaso) {
          opt.textContent = `${hora12} (${item.hora.hora}) - HORA YA PASÓ`;
          opt.disabled = true;
        } else if (item.disponible) {
          opt.textContent = `${hora12} (${item.hora.hora}) - Disponible`;
        } else {
          opt.textContent = `${hora12} (${item.hora.hora}) - AGOTADO`;
          opt.disabled = true;
        }

        opt.dataset.id = item.hora.horario_id;
        opt.dataset.hora24 = item.hora.hora;
        opt.dataset.disponible = item.disponible;
        opt.dataset.yaPaso = item.yaPaso;

        horaSelect.appendChild(opt);
        // console.log(horaSelect);
      });

      const primeraDisponible = horasConDisponibilidad.find(h => h.disponible && !h.yaPaso);
      if (primeraDisponible) {
        horaSelect.value = primeraDisponible.hora;
        btnReservar.disabled = false;
        mostrarCupos();
      } else {
        mensajeNoDisponible.textContent = 'No hay horas disponibles';
        mensajeNoDisponible.style.display = 'block';
      }
    }

    function mostrarCupos() {
      // const fechaInput = document.getElementById('fecha');
      const horaSelect = document.getElementById('hora');
      const cuposDiv = document.getElementById('cupos-disponibles');
      const cuposBadge = document.getElementById('cupos-badge');
      // const btnReservar = document.getElementById('btn-reservar');

      const fecha = fechaInput ? fechaInput.value : '';
      const hora = horaSelect ? horaSelect.value : '';

      if (!zonaSeleccionada || !fecha || !hora) return;

      const opcionSeleccionada = horaSelect.options[horaSelect.selectedIndex];
      const hora24 = opcionSeleccionada.dataset.hora24 || hora;

      const key = `${zonaSeleccionada}_${fecha}_${hora24}`;
      const usados = reservas[key] || 0;

      let disponibles;

      if (
        zonaSeleccionada === "Ludoteca" ||
        zonaSeleccionada === "Piscina" ||
        zonaSeleccionada === "Piscina de Niños" ||
        zonaSeleccionada === "Gimnasio"
      ) {
        disponibles = zonas[zonaSeleccionada].cupos - usados;
        cuposBadge.textContent = `${disponibles} / ${zonas[zonaSeleccionada].cupos}`;
      } else {
        disponibles = 1 - usados;
        cuposBadge.textContent = `${disponibles} / 1`;
      }

      // cuposDiv.style.display = 'flex';

      const disponible = opcionSeleccionada.dataset.disponible === 'true';
      const yaPaso = opcionSeleccionada.dataset.yaPaso === 'true';

      cuposBadge.style.background = disponible ? '#2c3e50' : '#e74c3c';
      btnReservar.disabled = !disponible || yaPaso;
    }


    // Event listeners
    // horaSelect.addEventListener('change', mostrarCupos);
    if (!horaSelect) {
      console.warn('Select #hora no existe todavía');
    } else {
      horaSelect.addEventListener('change', mostrarCupos);
    }

    // Función para realizar reserva - CORREGIDO
    function reservar() {
      if (btnReservar.disabled) {
        mostrarMensaje('error', 'No se puede realizar la reserva. Verifique la disponibilidad.');
        return;
      }
      
      const conjunto = document.getElementById('conjunto_id').value;
      const tipo_residente = document.getElementById('tipo_residente').value;
      const nombre = document.getElementById('nombre_completo').value;
      const identificacion = document.getElementById('identificacion').value;
      const interior = document.getElementById('interior').value;
      const apartamento = document.getElementById('apartamento').value;
      const fecha = fechaInput.value;
      const hora = horaSelect.value;
      const personas = personasSeleccionadas;

      if (!conjunto || !nombre || !identificacion || !interior || !apartamento || !zonaSeleccionada || !fecha || !hora || !tipo_residente) {
        mostrarMensaje('error', 'Por favor, complete todos los campos obligatorios (*)');
        return;
      }

      if (!zonaSeleccionada) {
        mostrarMensaje('error', 'Por favor, seleccione una zona común');
        return;
      }

      // if (!fechaDisponible(fecha)) {
      //   mostrarMensaje('error', 'No se pueden hacer reservas los lunes');
      //   return;
      // }

      const hoy = new Date();
      const fechaHoyStr = formatDateForInput(hoy);
      if (fecha === fechaHoyStr) {
        const hora24 = horaSelect.options[horaSelect.selectedIndex].dataset.hora24 || hora;
        if (horaYaPaso(hora24, fecha)) {
          mostrarMensaje('error', 'No se puede reservar una hora que ya pasó');
          return;
        }
      }

      const hora24 = horaSelect.options[horaSelect.selectedIndex].dataset.hora24 || hora;
      const key = `${zonaSeleccionada}_${fecha}_${hora24}`;
      
      if (!reservas[key]) {
        reservas[key] = 0;
      }

      if (zonaSeleccionada === "Ludoteca" || zonaSeleccionada === "Piscina" || zonaSeleccionada === "Piscina de Niños" || zonaSeleccionada === "Gimnasio") {
        const cuposDisponibles = zonas[zonaSeleccionada].cupos - reservas[key];
        const cuposNecesarios = personas;
        
        if (cuposNecesarios > cuposDisponibles) {
          mostrarMensaje('error', `Lo sentimos, solo hay ${cuposDisponibles} cupo(s) disponible(s) para esta hora`);
          return;
        }
        
        reservas[key] += cuposNecesarios;
      } else {
        if (reservas[key] > 0) {
          mostrarMensaje('error', 'Esta hora ya está reservada');
          return;
        }
        
        reservas[key] = 1;
      }
      
      const reservaUsuario = {
        id: Date.now(),
        conjunto,
        nombre,
        identificacion,
        interior,
        apartamento,
        zona: zonaSeleccionada,
        fecha: fecha, // Usar la fecha tal como está en formato YYYY-MM-DD
        hora: hora24,
        personas,
        fechaReserva: new Date().toLocaleString('es-ES', {
          day: '2-digit',
          month: '2-digit',
          year: 'numeric',
          hour: '2-digit',
          minute: '2-digit'
        })
      };
      
      // Ocultar mensaje anterior
      document.getElementById('mensaje').style.display = 'none';
      
      // Mostrar modal con detalles de la reserva
      mostrarModalReserva(reservaUsuario);
    }

    function obtenerZonaSeleccionada() {
        const card = document.querySelector('.zona-card.selected');
        return card ? card.dataset.zonaId : null;
    }

    $('#formReserva').on('submit', function (e) {
        e.preventDefault();

        const zonaId = obtenerZonaSeleccionada();

        if (!zonaId) {
            alert('Debes seleccionar una zona');
            return;
        }

        const formData = new FormData(this);
        formData.append('zona_id', zonaId);

        $.ajax({
            url: '/reservas/store',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {
                mostrarModalReserva(res.data || res);
            },

            error: function (xhr) {
                alert(xhr.responseJSON?.message || 'Error al guardar');
            }
        });
    });

  </script>
  @endsection