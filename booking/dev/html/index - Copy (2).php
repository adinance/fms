<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meeting Room Booking</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

  <style>
    @import 'https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@7/fonts/LINESeedSansTH/LINESeedSansTH.css';
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Quicksand:wght@300..700&display=swap');

    :root {
      --font-main: "Quicksand", "LINE Seed Sans TH", sans-serif;
      --bg-light: #fff;
      --text-light: #000;
      --bg-dark: #121212;
      --text-dark: #fff;
      --card-dark: #1f1f1f;
      --border-dark: #333;
    }

    body {
      font-family: var(--font-main);
      transition: background-color 0.3s, color 0.3s;
    }

    a { text-decoration: none !important; }

    /* ... (Mini Calendar specific styles - kept for layout) ... */

    #miniCalendar {
      max-width: 100%;
      margin: 20px auto;
      font-size: 12px !important;
    }

    #miniCalendar .fc-scroller { overflow: visible !important; }
    #miniCalendar .fc-daygrid-body { max-height: none !important; }
    #miniCalendar .fc-daygrid-body-unbalanced .fc-daygrid-day-events { min-height: 0 !important; }
    #miniCalendar .fc-daygrid-day-frame { padding: 3px !important; }
    #miniCalendar .fc-toolbar-title { font-size: 15px !important; font-weight: 600; }

    /* ... (FAB Button styles - kept for functionality) ... */

    .fab {
      position: fixed;
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
      z-index: 1000;
    }

    .fab:hover { background-color: #0b5ed7; }

    /* Light Mode Styles (Standard) */
    body.light-mode {
      background-color: var(--bg-light);
      color: var(--text-light);
    }

    body.light-mode .fc-col-header,
    body.light-mode .fc-event,
    body.light-mode .fc-daygrid-day-number {
      color: #000 !important;
    }

    body.light-mode .fc-day-today {
      background-color: #e9ecef !important;
      border-radius: 50%;
    }

    body.light-mode .fc-col-header-cell {
      background-color: #f8f9fa !important;
      color: #000 !important;
    }

    /* --- Dark Mode Styles --- */
    body.dark-mode {
      background-color: var(--bg-dark);
      color: var(--text-dark);
    }

    body.dark-mode .card {
      background-color: var(--card-dark) !important;
      border-color: var(--border-dark) !important;
      color: var(--text-dark) !important;
    }

    body.dark-mode #calendar {
      background: var(--card-dark);
      border-color: var(--border-dark);
    }

    /* CSS สำหรับ Multi Month (12 เดือน) */
    body.dark-mode .fc-multimonth-month {
      background-color: var(--card-dark) !important;
      color: var(--text-dark) !important;
    }
    
    body.dark-mode .fc-multimonth-header-table thead th {
      background-color: var(--card-dark) !important;
      color: var(--text-dark) !important;
    }

    /* FIX: แก้พื้นหลังเซลล์ในมุมมอง 12 เดือนที่เป็นสีขาว */
    body.dark-mode .fc-multimonth-daygrid-table,
    body.dark-mode .fc-multimonth-daygrid-table td {
        background-color: var(--card-dark) !important;
        border-color: var(--border-dark) !important;
    }
    
    /* FIX: แก้ปัญหาพื้นหลังและเส้นขอบเซลล์วันในมุมมอง 12 เดือนที่เป็นสีขาว/สว่าง */
    body.dark-mode .fc-multimonth-daygrid-table td,
    body.dark-mode .fc-multimonth-daygrid-table .fc-daygrid-day {
        background-color: var(--card-dark) !important;
        border-color: var(--border-dark) !important;
    }
    
    /* *** AGGRESSIVE FIX: กำหนดเส้นขอบของทุกส่วนใน FullCalendar ให้เป็นสีเข้มทั้งหมด *** */
    body.dark-mode #calendar table,
    body.dark-mode #calendar th,
    body.dark-mode #calendar td,
    body.dark-mode .fc-view-harness table,
    body.dark-mode .fc-scrollgrid table,
    body.dark-mode .fc-daygrid-body table,
    body.dark-mode .fc-scrollgrid-section,
    body.dark-mode .fc-daygrid-body,
    body.dark-mode .fc-col-header {
        border-color: var(--border-dark) !important;
    }

    /* *** ULTIMATE FIX V3: แก้ปัญหาเส้นขอบขาวขวาและล่าง Mini Calendar *** */

    /* 1. กำหนดให้เส้นขอบขององค์ประกอบตารางทั้งหมดใน MiniCalendar เป็นสี Dark Border */
    body.dark-mode #miniCalendar table,
    body.dark-mode #miniCalendar th,
    body.dark-mode #miniCalendar td,
    body.dark-mode #miniCalendar .fc-col-header,
    body.dark-mode #miniCalendar .fc-scrollgrid-table,
    body.dark-mode #miniCalendar .fc-daygrid-day {
        border-color: var(--border-dark) !important;
    }
    
    /* 2. บังคับให้เส้นขอบด้านขวาของตารางและคอลัมน์ขวาสุดมีความกว้าง 0px */
    body.dark-mode #miniCalendar .fc-scrollgrid-table {
        border-right-width: 0px !important;
    }
    
    body.dark-mode #miniCalendar .fc-col-header-cell:last-child,
    body.dark-mode #miniCalendar .fc-daygrid-day:last-child {
        border-right-width: 0px !important;
    }
    /* --------------------------------------------------------------------- */


    /* General Dark Mode FullCalendar Elements (color/background) */
    body.dark-mode .fc-col-header,
    body.dark-mode .fc-event,
    body.dark-mode .fc-daygrid-day-number {
      color: #fff !important;
    }

    body.dark-mode .fc-day-today {
      background-color: var(--card-dark) !important;
      border-radius: 50%;
    }

    body.dark-mode .fc-col-header-cell {
      background-color: var(--card-dark) !important;
      color: #fff !important;
    }
    
    /* --- Datatables Dark Mode styles --- */
    
    body.dark-mode table.dataTable {
      background-color: #1e1e1e;
      color: #e5e5e5;
    }

    /* FIX: กำหนดเส้นขอบของตาราง Datatable ให้เป็นสีเข้มทั้งหมด */
    body.dark-mode table.dataTable,
    body.dark-mode table.dataTable thead th,
    body.dark-mode table.dataTable tbody td {
        border-color: var(--border-dark) !important;
    }

    body.dark-mode table.dataTable thead th {
      background-color: #2a2a2a !important;
      color: #f1f1f1 !important;
      /* border-color ถูกกำหนดข้างบนแล้ว */
    }

    body.dark-mode table.dataTable tbody td {
      background-color: #1e1e1e !important;
      color: #e5e5e5 !important;
      /* border-color ถูกกำหนดข้างบนแล้ว */
    }

    body.dark-mode table.dataTable.stripe tbody tr.odd,
    body.dark-mode table.dataTable.display tbody tr.odd {
      background-color: #242424 !important;
    }

    body.dark-mode table.dataTable.stripe tbody tr.even,
    body.dark-mode table.dataTable.display tbody tr.even {
      background-color: #1c1c1c !important;
    }

    body.dark-mode .dataTables_wrapper .dataTables_filter input,
    body.dark-mode .dataTables_wrapper .dataTables_length select {
      background: #2a2a2a;
      color: #fff;
      border: 1px solid #555;
    }

    body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button {
      color: #ddd !important;
    }

    body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      background: #444 !important;
      color: #fff !important;
    }

    body.dark-mode .dataTables_wrapper .dataTables_info {
      color: #ccc !important;
    }
    
    /* Dark Mode style for Bootstrap Switch Label */
    body.dark-mode .form-check-label {
        color: var(--text-dark); 
    }

    #themeToggle {
      background-color: #6c757d;
      font-size: 20px;
      bottom: 100px;
    }
    #themeToggle:hover { background-color: #495057; }
    .fab-add { bottom: 30px; }
  </style>
</head>
<body class="p-3 light-mode">

<button class="fab fab-add" data-bs-toggle="modal" data-bs-target="#bookingModal"><i class="bi bi-plus"></i></button>
<button id="themeToggle" class="fab"><i class="bi bi-moon"></i></button>

<div class="container">
  <div class="card p-3 shadow-sm mb-3">
  <h2 class="mb-0">📅 ระบบจองห้องประชุม</h2>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="card p-3 shadow-lg mb-3">
      <div id="calendar"></div>
       </div>
    </div>

    <div class="col-md-4">
      <div class="card p-3 shadow mb-3">
        <h6 class="text-center mt-2">📌 ปฏิทินด่วน</h6>
        <div id="miniCalendar"></div>
      </div>

      <div class="card p-3 mb-3 shadow">
        <label><input type="checkbox" id="checkAllRooms" class="me-1" checked> เลือกทั้งหมด</label>
        <hr class="my-1">
        <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room A" checked> Room A</label>
        <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room B" checked> Room B</label>
        <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room C" checked> Room C</label>
      </div>
    </div>
  </div>

  <div class="card p-3 mt-5 shadow" >
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5>📋 ตารางการจองทั้งหมด</h5>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="toggleTable" checked>
            <label class="form-check-label" for="toggleTable">แสดงตาราง</label>
        </div>
    </div>
    
    <div id="tableWrapper"> 
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
  </div>

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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const roomColors = { "Room A": "#0d6efd", "Room B": "#198754", "Room C": "#fd7e14" };
  let darkMode = localStorage.getItem("darkMode") === "true";
  let calendar, miniCal, table;

  initTheme();
  initPickers();
  initCalendars();
  initTable();
  initEventHandlers();

  function initTheme() {
    applyTheme(darkMode);
    document.getElementById("themeToggle").addEventListener("click", function() {
      darkMode = !darkMode;
      localStorage.setItem("darkMode", darkMode);
      applyTheme(darkMode);
    });
  }

  function applyTheme(isDark) {
    const body = document.body;
    const cards = document.querySelectorAll(".card");
    const toggleBtn = document.getElementById("themeToggle");

    if (isDark) {
      body.classList.add("dark-mode");
      body.classList.remove("light-mode");
      cards.forEach(c => c.classList.add("bg-secondary", "text-white"));
      toggleBtn.innerHTML = '<i class="bi bi-sun"></i>';
    } else {
      body.classList.add("light-mode");
      body.classList.remove("dark-mode");
      cards.forEach(c => c.classList.remove("bg-secondary", "text-white"));
      toggleBtn.innerHTML = '<i class="bi bi-moon"></i>';
    }
  }

  function initPickers() {
    flatpickr("#meeting_date", { dateFormat: "Y-m-d" });
    flatpickr("#start_time", { enableTime: true, noCalendar: true, dateFormat: "H:i" });
    flatpickr("#end_time", { enableTime: true, noCalendar: true, dateFormat: "H:i" });
  }

  function mapEventData(e) {
    return {
      id: e.id,
      title: e.title + " (" + e.room + ")",
      start: e.meeting_date + "T" + e.start_time,
      end: e.meeting_date + "T" + e.end_time,
      extendedProps: e,
      color: roomColors[e.room]
    };
  }

  function showEventDetails(info) {
    let data = info.event.extendedProps;
    document.getElementById("d_room").innerText = data.room;
    document.getElementById("d_title").innerText = info.event.title;
    document.getElementById("d_date").innerText = data.meeting_date;
    document.getElementById("d_start").innerText = data.start_time;
    document.getElementById("d_end").innerText = data.end_time;
    document.getElementById("d_booked").innerText = data.booked_by;
    new bootstrap.Modal(document.getElementById("detailModal")).show();
  }

  function initCalendars() {
    calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
      themeSystem: 'bootstrap5',
      initialView: "dayGridMonth",
      height: "auto",
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth,multiMonthYear"
      },
      buttonText: {
        today: "วันนี้", month: "เดือน", week: "สัปดาห์", day: "วัน",
        listMonth: 'ทั้งเดือน', multiMonthYear: '12 เดือน'
      },
      events: (info, success) => $.getJSON("data.json", res => success(res.data.map(mapEventData))),
      eventClick: showEventDetails
    });

    miniCal = new FullCalendar.Calendar(document.getElementById("miniCalendar"), {
      initialView: "dayGridMonth",
      height: "auto",
      contentHeight: "auto",
      expandRows: true,
      headerToolbar: { left: "", center: "title", right: "prev,next" },
      events: (info, success) => $.getJSON("data.json", res => success(res.data.map(mapEventData))),
      eventClick: showEventDetails,
      selectable: true,
      dateClick: info => calendar.gotoDate(info.dateStr)
    });

    calendar.render();
    miniCal.render();
  }

  function initTable() {
    table = $("#bookingTable").DataTable({
      ajax: "data.json",
      columns: [
        { data: "room" }, { data: "title" }, { data: "meeting_date" },
        { data: "time" }, { data: "booked_by" }
      ]
    });
  }

  function initEventHandlers() {
    $("#checkAllRooms").on("change", function() {
      $(".room-filter").prop("checked", $(this).is(":checked"));
      applyRoomFilter(false);
      filterDataTableByRooms();
    });

    $(".room-filter").on("change", function() {
      $("#checkAllRooms").prop("checked", $(".room-filter").length === $(".room-filter:checked").length);
      applyRoomFilter(false);
      filterDataTableByRooms();
    });

    $("#bookingTable").on("search.dt", function() {
      syncCalendarWithDataTable();
      updateRoomFilterByTable();
    });

    $("#bookingForm").on("submit", handleBookingSubmit);

    // NEW: Toggle Table Visibility
    $("#toggleTable").on("change", function() {
        const tableWrapper = $("#tableWrapper");
        const label = $('label[for="toggleTable"]');
        
        if ($(this).is(":checked")) {
            tableWrapper.show();
            label.text("แสดงตาราง");
        } else {
            tableWrapper.hide();
            label.text("ซ่อนตาราง");
        }
    });
  }

  function filterDataTableByRooms() {
    let selectedRooms = $(".room-filter:checked").map(function() { return this.value; }).get();
    let searchVal = selectedRooms.length === 0 ? "^$" : selectedRooms.join("|");
    table.column(0).search(searchVal, true, false).draw();
    syncCalendarWithDataTable();
  }

  function applyRoomFilter(updateTable = true) {
    let selectedRooms = $(".room-filter:checked").map(function() { return this.value; }).get();
    const filterFunc = evt => selectedRooms.includes(evt.extendedProps.room) ? "auto" : "none";
    
    calendar.getEvents().forEach(evt => evt.setProp("display", filterFunc(evt)));
    miniCal.getEvents().forEach(evt => evt.setProp("display", filterFunc(evt)));

    if (updateTable) {
      table.column(0).search(selectedRooms.join("|"), true, false).draw();
    }
  }

  function syncCalendarWithDataTable() {
    let visibleIds = table.rows({ search: "applied" }).data().toArray().map(item => String(item.id));
    const syncFunc = evt => visibleIds.includes(String(evt.id)) ? "auto" : "none";

    calendar.getEvents().forEach(evt => evt.setProp("display", syncFunc(evt)));
    miniCal.getEvents().forEach(evt => evt.setProp("display", syncFunc(evt)));
  }

  function updateRoomFilterByTable() {
    let visibleData = table.rows({ search: "applied" }).data().toArray();
    let rooms = [...new Set(visibleData.map(item => item.room))];
    
    $(".room-filter").each(function() { this.checked = rooms.includes(this.value); });
    $("#checkAllRooms").prop("checked", $(".room-filter").length === $(".room-filter:checked").length);
  }

  function handleBookingSubmit(e) {
    e.preventDefault();
    $.post("add_booking.php", $(this).serialize(), function() {
      bootstrap.Modal.getInstance(document.getElementById("bookingModal")).hide();
      $("#bookingForm")[0].reset();
      
      table.ajax.reload(function() {
        calendar.getEvents().forEach(e => e.remove());
        table.rows().data().toArray().forEach(item => calendar.addEvent(mapEventData(item)));
      });
    });
  }
});
</script>
</body>
</html>