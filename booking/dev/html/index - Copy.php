<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meeting Room Booking</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Flatpickr -->
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

  <!-- DataTables -->
  <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

  <style>
/* --------------------------------------------------
 * FONT IMPORTS
 * -------------------------------------------------- */
@import 'https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@7/fonts/LINESeedSansTH/LINESeedSansTH.css';
@import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&display=swap');

body, table, input, select, button {
    font-family: "Quicksand", "LINE Seed Sans TH", sans-serif;
}


/* --------------------------------------------------
 * LIGHT MODE
 * -------------------------------------------------- */
body.light-mode {
    background-color: #fff;
    color: #000;
}

/* Calendar text colors */
body.light-mode .fc-col-header,
body.light-mode .fc-event,
body.light-mode .fc-daygrid-day-number {
    color: #000 !important;
}

/* Today highlight */
body.light-mode .fc-day-today {
    background-color: #e9ecef !important;
    border-radius: 50%;
}

/* Calendar header cell */
body.light-mode .fc-col-header-cell {
    background-color: #f8f9fa !important;
    color: #000 !important;
}


/* --------------------------------------------------
 * DARK MODE
 * -------------------------------------------------- */
body.dark-mode {
    background-color: #121212;
    color: #fff;
}

body.dark-mode .fc-col-header,
body.dark-mode .fc-event,
body.dark-mode .fc-daygrid-day-number {
    color: #fff !important;
}

body.dark-mode .fc-day-today {
    background-color: #1f1f1f !important;
    border-radius: 50%;
}

body.dark-mode .fc-col-header-cell {
    background-color: #1f1f1f !important;
    color: #fff !important;
}


/* --------------------------------------------------
 * GENERAL ELEMENTS
 * -------------------------------------------------- */
a {
    text-decoration: none !important;
}

/* Dark/Light mode toggle button */
#themeToggle {
    background-color: #6c757d;
    font-size: 20px;
}
#themeToggle:hover {
    background-color: #495057;
}


/* --------------------------------------------------
 * MAIN CALENDAR
 * -------------------------------------------------- */
#calendar {
    max-width: 100%;
    margin: 20px auto;
    font-size: 16px !important;
}


/* --------------------------------------------------
 * MINI CALENDAR
 * -------------------------------------------------- */
#miniCalendar {
    max-width: 100%;
    margin: 20px auto;
    font-size: 12px !important;
}

/* Remove scroll, compact view */
#miniCalendar .fc-scroller {
    overflow: visible !important;
}

#miniCalendar .fc-daygrid-body {
    max-height: none !important;
}

#miniCalendar .fc-daygrid-body-unbalanced .fc-daygrid-day-events {
    min-height: 0 !important;
}

#miniCalendar .fc-daygrid-day-frame {
    padding: 3px !important;
}

#miniCalendar .fc-toolbar-title {
    font-size: 15px !important;
    font-weight: 600;
}


/* --------------------------------------------------
 * FLOATING ACTION BUTTON (FAB)
 * -------------------------------------------------- */
.fab {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #0d6efd;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.fab:hover {
    background-color: #0b5ed7;
}

  </style>
</head>

<body class="p-3 light-mode">

  <button class="fab" data-bs-toggle="modal" data-bs-target="#bookingModal">
    <i class="bi bi-plus"></i>
  </button>

  <!-- ปุ่ม Dark/Light Mode -->
<button id="themeToggle" class="fab" style="bottom: 100px; right: 30px;" title="Toggle Dark/Light Mode">
  <i class="bi bi-moon"></i>
</button>


  <div class="container">
    <h2 class="mb-4">📅 ระบบจองห้องประชุม</h2>

    <div class="row">
      <div class="col-md-8">
        <div id="calendar" ></div>
      </div>

      <div class="col-md-4">
        <div class="card p-2 shadow-sm mb-3">
          <h6 class="text-center mt-2">📌 ปฏิทินด่วน</h6>
          <div id="miniCalendar"></div>
        </div>

        <div class="card p-2 mb-3 shadow-sm">
          <strong>แสดงเฉพาะห้อง:</strong><br>
          <label><input type="checkbox" id="checkAllRooms" class="me-1" checked> เลือกทั้งหมด</label>
          <hr class="my-1">
          <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room A" checked> Room A</label>
          <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room B" checked> Room B</label>
          <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room C" checked> Room C</label>
        </div>
      </div>
    </div>

    <div class="mt-5">
      <h5>📋 ตารางการจองทั้งหมด</h5>
      <table id="bookingTable" class="table table-bordered table-striped">
        <thead>
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
              <option value="Room A">Room A</option>
              <option value="Room B">Room B</option>
              <option value="Room C">Room C</option>
            </select>
          </div>
          <div class="mb-2">
            <label>ชื่อการประชุม</label>
            <input type="text" name="title" class="form-control" required />
          </div>
          <div class="mb-2">
            <label>วันที่</label>
            <input type="text" id="meeting_date" name="meeting_date" class="form-control" required />
          </div>
          <div class="row">
            <div class="col">
              <label>เวลาเริ่ม</label>
              <input type="text" id="start_time" name="start_time" class="form-control" required />
            </div>
            <div class="col">
              <label>เวลาสิ้นสุด</label>
              <input type="text" id="end_time" name="end_time" class="form-control" required />
            </div>
          </div>
          <div class="mt-2">
            <label>ผู้จอง</label>
            <input type="text" name="booked_by" class="form-control" required />
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-success">บันทึก</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: รายละเอียดการจอง -->
  <div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">รายละเอียดการจอง</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2"><b>ห้อง:</b> <span id="d_room"></span></div>
          <div class="mb-2"><b>ชื่อการประชุม:</b> <span id="d_title"></span></div>
          <div class="mb-2"><b>วันที่:</b> <span id="d_date"></span></div>
          <div class="mb-2"><b>เวลาเริ่ม:</b> <span id="d_start"></span></div>
          <div class="mb-2"><b>เวลาสิ้นสุด:</b> <span id="d_end"></span></div>
          <div class="mb-2"><b>ผู้จอง:</b> <span id="d_booked"></span></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
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
    document.addEventListener("DOMContentLoaded", function() {

      // สร้างตัวแปรเก็บโหมด
let darkMode = localStorage.getItem("darkMode") === "true";

if(darkMode){
        document.body.classList.add("dark-mode");
        document.body.classList.remove("light-mode");
        document.querySelectorAll(".card").forEach(c => c.classList.add("bg-secondary","text-white"));
        document.getElementById("themeToggle").innerHTML = '<i class="bi bi-sun"></i>';
    }else{
        document.body.classList.add("light-mode");
        document.body.classList.remove("dark-mode");
        document.querySelectorAll(".card").forEach(c => c.classList.remove("bg-secondary","text-white"));
        document.getElementById("themeToggle").innerHTML = '<i class="bi bi-moon"></i>';
    }

document.getElementById("themeToggle").addEventListener("click", function() {
    // darkMode = !darkMode;

    // if(darkMode){
    //     document.body.classList.add("bg-dark", "text-white");
    //     document.querySelectorAll(".card").forEach(c => c.classList.add("bg-secondary", "text-white"));
    //     this.innerHTML = '<i class="bi bi-sun"></i>'; // เปลี่ยน icon เป็นดวงอาทิตย์
    // } else {
    //     document.body.classList.remove("bg-dark", "text-white");
    //     document.querySelectorAll(".card").forEach(c => c.classList.remove("bg-secondary", "text-white"));
    //     this.innerHTML = '<i class="bi bi-moon"></i>'; // เปลี่ยนกลับเป็นดวงจันทร์
    // }

    darkMode = !darkMode;

    if(darkMode){
        document.body.classList.add("dark-mode");
        document.body.classList.remove("light-mode");
        document.querySelectorAll(".card").forEach(c => c.classList.add("bg-secondary","text-white"));
        this.innerHTML = '<i class="bi bi-sun"></i>';
    } else {
        document.body.classList.add("light-mode");
        document.body.classList.remove("dark-mode");
        document.querySelectorAll(".card").forEach(c => c.classList.remove("bg-secondary","text-white"));
        this.innerHTML = '<i class="bi bi-moon"></i>';
    }

    localStorage.setItem("darkMode", darkMode);


});


      /** ---------------- Flatpickr ---------------- */
      flatpickr("#meeting_date", { dateFormat: "Y-m-d" });
      flatpickr("#start_time", { enableTime: true, noCalendar: true, dateFormat: "H:i" });
      flatpickr("#end_time", { enableTime: true, noCalendar: true, dateFormat: "H:i" });

      const roomColors = {
    "Room A": "#0d6efd", // น้ำเงิน
    "Room B": "#198754", // เขียว
    "Room C": "#fd7e14"  // ส้ม
};


      /** ---------------- FullCalendar ---------------- */
      const calendarEl = document.getElementById("calendar");
      const miniEl = document.getElementById("miniCalendar");

      const calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        initialView: "dayGridMonth",
        height: "auto",
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth,multiMonthYear",
        },
        buttonText: {
          today: "วันนี้",
          month: "เดือน",
          week: "สัปดาห์",
          day: "วัน",
          listMonth: 'ทั้งเดือน',
          multiMonthYear: '12 เดือน'
        },
        
        events: function(info, success) {
          $.getJSON("data.json", function(res) {
            const events = res.data.map(e => ({
              id: e.id,
              title: e.title + " (" + e.room + ")",
              start: e.meeting_date + "T" + e.start_time,
              end: e.meeting_date + "T" + e.end_time,
              extendedProps: e,
              color: roomColors[e.room] // กำหนดสีตามห้อง
            
            }));

             

            success(events);
          });
        },
        eventClick: function(info) {
          let data = info.event.extendedProps;
          document.getElementById("d_room").innerText = data.room;
          document.getElementById("d_title").innerText = info.event.title;
          document.getElementById("d_date").innerText = data.meeting_date;
          document.getElementById("d_start").innerText = data.start_time;
          document.getElementById("d_end").innerText = data.end_time;
          document.getElementById("d_booked").innerText = data.booked_by;
          new bootstrap.Modal(document.getElementById("detailModal")).show();
        },
        
      });
      calendar.render();

      const miniCal = new FullCalendar.Calendar(miniEl, {
        initialView: "dayGridMonth",
        height: "auto",
        contentHeight: "auto",
        expandRows: true,
        headerToolbar: { left: "", center: "title", right: "prev,next" },
        events: function(info, success) {
          $.getJSON("data.json", function(res) {
            const events = res.data.map(e => ({
              id: e.id,
              // title: e.title + " (" + e.room + ")",
              start: e.meeting_date + "T" + e.start_time,
              // end: e.meeting_date + "T" + e.end_time,
              extendedProps: e,
              color: roomColors[e.room]
            }));
            success(events);
          });
        },
        eventClick: function(info) {
          let data = info.event.extendedProps;
          document.getElementById("d_room").innerText = data.room;
          document.getElementById("d_title").innerText = info.event.title;
          document.getElementById("d_date").innerText = data.meeting_date;
          document.getElementById("d_start").innerText = data.start_time;
          document.getElementById("d_end").innerText = data.end_time;
          document.getElementById("d_booked").innerText = data.booked_by;
          new bootstrap.Modal(document.getElementById("detailModal")).show();
        },
        selectable: true,
        dateClick: function(info) {
          calendar.gotoDate(info.dateStr);
        }
      });
      miniCal.render();

      /** ---------------- DataTables ---------------- */
      let table = $("#bookingTable").DataTable({
        ajax: "data.json",
        columns: [
          { data: "room" },
          { data: "title" },
          { data: "meeting_date" },
          { data: "time" },
          { data: "booked_by" }
        ],
      });

      /** ---------------- Room Filter ---------------- */
      $("#checkAllRooms").on("change", function() {
        let checked = $(this).is(":checked");
        $(".room-filter").prop("checked", checked);
        applyRoomFilter(false); // ไม่ trigger DataTable search ซ้ำ
        filterDataTableByRooms(); // ฟังก์ชันแยก
      });

      $(".room-filter").on("change", function() {
        let allChecked = $(".room-filter").length === $(".room-filter:checked").length;
        $("#checkAllRooms").prop("checked", allChecked);
        applyRoomFilter(false); // ไม่ trigger DataTable search ซ้ำ
        filterDataTableByRooms(); // ฟังก์ชันแยก
      });

      function filterDataTableByRooms() {
          let selectedRooms = $(".room-filter:checked").map(function(){ return this.value; }).get();

          // filter DataTable column 0 ด้วย regex
          let table = $("#bookingTable").DataTable();
          if(selectedRooms.length === 0){
              table.column(0).search("^$", true, false).draw(); // ซ่อนทั้งหมด
          } else {
              let regex = selectedRooms.join("|"); // Room A|Room B|Room C
              table.column(0).search(regex, true, false).draw();
          }

          // sync Calendar หลัง DataTable filter
          syncCalendarWithDataTable();
      }


      function applyRoomFilter(updateTable = true) {
        let selectedRooms = $(".room-filter:checked").map(function () { return this.value; }).get();

        calendar.getEvents().forEach(evt => evt.setProp("display", selectedRooms.includes(evt.extendedProps.room) ? "auto" : "none"));
        miniCal.getEvents().forEach(evt => evt.setProp("display", selectedRooms.includes(evt.extendedProps.room) ? "auto" : "none"));

        if(updateTable){
          let tableFilter = selectedRooms.join("|");
          $("#bookingTable").DataTable().column(0).search(tableFilter, true, false).draw();
        }
      }

      /** ---------------- Sync DataTable Search ---------------- */
      $("#bookingTable").on("search.dt", function () {
        syncCalendarWithDataTable();
        updateRoomFilterByTable();
      });

      function syncCalendarWithDataTable() {
        let visibleData = table.rows({ search: "applied" }).data().toArray();
        let visibleIds = visibleData.map(item => String(item.id));

        calendar.getEvents().forEach(evt => evt.setProp("display", visibleIds.includes(String(evt.id)) ? "auto" : "none"));
        miniCal.getEvents().forEach(evt => evt.setProp("display", visibleIds.includes(String(evt.id)) ? "auto" : "none"));
      }

      // function syncCalendarWithDataTable() {
      //     let table = $("#bookingTable").DataTable();
      //     let visibleData = table.rows({search: "applied"}).data().toArray();
      //     let visibleIds = visibleData.map(item => String(item.id));

      //     calendar.getEvents().forEach(evt => evt.setProp("display", visibleIds.includes(String(evt.id)) ? "auto" : "none"));
      //     miniCal.getEvents().forEach(evt => evt.setProp("display", visibleIds.includes(String(evt.id)) ? "auto" : "none"));
      // }

      function updateRoomFilterByTable() {
        let visibleData = table.rows({ search: "applied" }).data().toArray();
        let rooms = [...new Set(visibleData.map(item => item.room))];

        $(".room-filter").each(function () { this.checked = rooms.includes(this.value); });
        let allChecked = $(".room-filter").length === $(".room-filter:checked").length;
        $("#checkAllRooms").prop("checked", allChecked);
      }

      /** ---------------- Submit Booking ---------------- */
      $("#bookingForm").on("submit", function(e) {
        e.preventDefault();
        $.post("add_booking.php", $(this).serialize(), function() {
          bootstrap.Modal.getInstance(document.getElementById("bookingModal")).hide();
          $("#bookingForm")[0].reset();
          table.ajax.reload(function() {
            calendar.getEvents().forEach(e => e.remove());
            table.rows().data().toArray().forEach(item => {
              calendar.addEvent({ id:item.id, title:item.title + " ("+item.room+")", start:item.meeting_date+"T"+item.start_time, end:item.meeting_date+"T"+item.end_time, extendedProps:item });
            });
          });
        });
      });

    });
  </script>
</body>
</html>
