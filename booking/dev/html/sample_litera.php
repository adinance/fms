<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ระบบจองห้องประชุม</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootswatch Litera Theme -->
  <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/litera/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Flatpickr -->
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: "Prompt", sans-serif;
    }

    .calendar-container {
      max-width: 1200px;
      margin: 40px auto;
    }

    .card {
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
      border: none;
      border-radius: 1rem;
    }

    .card-header {
      background-color: #0d6efd;
      color: white;
      border-radius: 1rem 1rem 0 0;
    }

    #calendar {
      padding: 15px;
    }

    /* ปรับปุ่ม FullCalendar ให้เข้ากับ Bootstrap */
    .fc-button {
      border-radius: 0.4rem !important;
      border: none !important;
    }

    .fc-button-primary {
      background-color: #0d6efd !important;
    }

    .fc-toolbar-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #212529;
    }

    /* สี event ตามห้อง */
    .fc-event.RoomA { background-color: #0d6efd !important; border: none; }
    .fc-event.RoomB { background-color: #198754 !important; border: none; }
    .fc-event.RoomC { background-color: #dc3545 !important; border: none; }
  </style>
</head>

<body>
  <div class="container calendar-container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-calendar3"></i> ระบบจองห้องประชุม</h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#bookingModal">
          <i class="bi bi-plus-lg"></i> จองห้องใหม่
        </button>
      </div>
      <div class="card-body">
        <div id="calendar"></div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="bookingModalLabel"><i class="bi bi-pencil-square"></i> จองห้องประชุม</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="bookingForm">
            <div class="mb-3">
              <label class="form-label">หัวข้อการประชุม</label>
              <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
              <label class="form-label">เลือกห้องประชุม</label>
              <select class="form-select" name="room" required>
                <option value="">-- กรุณาเลือก --</option>
                <option value="RoomA">ห้อง A</option>
                <option value="RoomB">ห้อง B</option>
                <option value="RoomC">ห้อง C</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">วันที่</label>
              <input type="text" id="meeting_date" name="meeting_date" class="form-control" required>
            </div>
            <div class="row">
              <div class="col">
                <label class="form-label">เริ่มเวลา</label>
                <input type="text" id="start_time" name="start_time" class="form-control" required>
              </div>
              <div class="col">
                <label class="form-label">สิ้นสุดเวลา</label>
                <input type="text" id="end_time" name="end_time" class="form-control" required>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button class="btn btn-primary" id="saveBooking">บันทึก</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Flatpickr
    flatpickr("#meeting_date", { dateFormat: "Y-m-d" });
    flatpickr("#start_time", { enableTime: true, noCalendar: true, dateFormat: "H:i" });
    flatpickr("#end_time", { enableTime: true, noCalendar: true, dateFormat: "H:i" });

    // FullCalendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: 'fetch_bookings.php',
      eventDisplay: 'block',
      height: 'auto'
    });
    calendar.render();

    // Save booking
    document.getElementById('saveBooking').addEventListener('click', function() {
      var form = document.getElementById('bookingForm');
      var formData = new FormData(form);
      fetch('save_booking.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
          if (data.status === 'success') {
            calendar.refetchEvents();
            bootstrap.Modal.getInstance(document.getElementById('bookingModal')).hide();
            form.reset();
          } else {
            alert('เกิดข้อผิดพลาด: ' + data.message);
          }
        });
    });
  });
  </script>
</body>
</html>
