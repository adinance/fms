<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ระบบจองห้องประชุม</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Flatpickr -->
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #eef2f3, #dfe9f3);
      min-height: 100vh;
      font-family: "Prompt", sans-serif;
    }

    .calendar-container {
      max-width: 1200px;
      margin: 40px auto;
    }

    .card-calendar {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .card-header {
      border-bottom: none;
      background: linear-gradient(90deg, #4f46e5, #3b82f6);
      color: white;
      border-radius: 1rem 1rem 0 0;
    }

    #calendar {
      padding: 20px;
      border-radius: 0 0 1rem 1rem;
    }

    /* ปรับปุ่ม FullCalendar */
    .fc-button {
      border-radius: 0.5rem !important;
      text-transform: none !important;
      background-color: #6366f1 !important;
      border: none !important;
    }

    .fc-button:hover {
      background-color: #4f46e5 !important;
    }

    .fc-toolbar-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #374151;
    }

    /* สี event ตามห้อง */
    .fc-event.RoomA { background-color: #60a5fa !important; border: none; color: white; }
    .fc-event.RoomB { background-color: #34d399 !important; border: none; color: white; }
    .fc-event.RoomC { background-color: #f87171 !important; border: none; color: white; }

    /* Modal สวยขึ้น */
    .modal-content {
      border-radius: 1rem;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }
    .modal-header {
      background: linear-gradient(90deg, #3b82f6, #6366f1);
      color: white;
      border-radius: 1rem 1rem 0 0;
    }

  </style>
</head>
<body>

<div class="container calendar-container">
  <div class="card card-calendar">
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

<!-- Modal ฟอร์มจอง -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
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

<!-- Scripts -->
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
    height: 'auto',
  });
  calendar.render();

  // บันทึกข้อมูลจอง
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
