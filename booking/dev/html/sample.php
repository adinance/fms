<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบจองห้องประชุม</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Flatpickr -->
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <!-- DataTables -->
  <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f0f2f5;
    }
    #calendar {
      max-width: 100%;
      margin: 10px auto;
      background: #fff;
      border-radius: 0.5rem;
      padding: 10px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    /* ปรับสี event */
    .fc-event {
      border: none !important;
      border-radius: 6px !important;
      color: #fff !important;
      padding: 3px 6px !important;
      font-size: 0.9rem;
    }

    /* สีแต่ละห้องประชุม */
    .fc-event.Room\ A { background-color: #0d6efd !important; } /* ฟ้า */
    .fc-event.Room\ B { background-color: #198754 !important; } /* เขียว */
    .fc-event.Room\ C { background-color: #dc3545 !important; } /* แดง */

    /* ปรับหัวปฏิทิน */
    .fc-toolbar-title {
      font-size: 1.25rem;
      font-weight: 600;
    }

    .fc-button {
      border-radius: 0.5rem !important;
      text-transform: none !important;
    }

    .fc-col-header-cell-cushion {
      font-weight: 600;
      color: #495057;
    }
  </style>
</head>
<body class="p-3">

  <div class="container py-4">
    <!-- Calendar Card -->
    <div class="card shadow-lg border-0 mb-4">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-calendar3"></i> ปฏิทินการจองห้องประชุม</h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#bookingModal">
          <i class="bi bi-plus-lg"></i> จองห้องใหม่
        </button>
      </div>
      <div class="card-body bg-light">
        <div id="calendar"></div>
      </div>
    </div>

    <!-- Booking Table -->
    <div class="card shadow-sm border-0">
      <div class="card-header bg-secondary text-white">
        <h6 class="mb-0"><i class="bi bi-list-task"></i> ตารางการจองทั้งหมด</h6>
      </div>
      <div class="card-body bg-white">
        <table id="bookingTable" class="table table-striped table-bordered">
          <thead class="table-light">
            <tr>
              <th>ห้อง</th>
              <th>ชื่อการประชุม</th>
              <th>วันที่</th>
              <th>เวลา</th>
              <th>ผู้จอง</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal: จองห้อง -->
  <div class="modal fade" id="bookingModal" tabindex="-1">
    <div class="modal-dialog">
      <form id="bookingForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">จองห้องประชุม</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label>ห้องประชุม</label>
            <select name="room" class="form-select" required>
              <option value="">-- เลือกห้อง --</option>
              <option value="Room A">Room A</option>
              <option value="Room B">Room B</option>
              <option value="Room C">Room C</option>
            </select>
          </div>
          <div class="mb-2">
            <label>ชื่อการประชุม</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-2">
            <label>วันที่</label>
            <input type="text" id="meeting_date" name="meeting_date" class="form-control" required>
          </div>
          <div class="row">
            <div class="col">
              <label>เวลาเริ่ม</label>
              <input type="text" id="start_time" name="start_time" class="form-control" required>
            </div>
            <div class="col">
              <label>เวลาสิ้นสุด</label>
              <input type="text" id="end_time" name="end_time" class="form-control" required>
            </div>
          </div>
          <div class="mt-2">
            <label>ผู้จอง</label>
            <input type="text" name="booked_by" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // FullCalendar
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 650,
        selectable: true,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
          today: 'วันนี้',
          month: 'เดือน',
          week: 'สัปดาห์',
          day: 'วัน'
        },
        events: 'fetch_events.php',
        eventTimeFormat: {
          hour: '2-digit',
          minute: '2-digit',
          hour12: false
        },
        eventDidMount: function(info) {
          // Tooltip แสดงรายละเอียด
          new bootstrap.Tooltip(info.el, {
            title: info.event.title + ' (' + info.event.extendedProps.room + ')',
            placement: 'top',
            trigger: 'hover',
            container: 'body'
          });
        }
      });
      calendar.render();

      // DataTables
      $('#bookingTable').DataTable({
        ajax: 'fetch_bookings.php',
        columns: [
          { data: 'room' },
          { data: 'title' },
          { data: 'meeting_date' },
          { data: 'time' },
          { data: 'booked_by' }
        ]
      });

      // Flatpickr
      flatpickr("#meeting_date", { dateFormat: "Y-m-d" });
      flatpickr("#start_time", { enableTime: true, noCalendar: true, dateFormat: "H:i" });
      flatpickr("#end_time", { enableTime: true, noCalendar: true, dateFormat: "H:i" });

      // Submit Form
      $('#bookingForm').on('submit', function(e) {
        e.preventDefault();
        $.post('add_booking.php', $(this).serialize(), function(response) {
          $('#bookingModal').modal('hide');
          $('#bookingForm')[0].reset();
          calendar.refetchEvents();
          $('#bookingTable').DataTable().ajax.reload();
        });
      });
    });
  </script>
</body>
</html>
