<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CMO Booking</title>

  <link rel="icon" type="image/png" href="images/logo-white.png" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="https://apps.cmo-group.com/cdn/booking.css" rel="stylesheet" />

</head>

<body class="p-0 light-mode">

  <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light shadow-sm py-0 border-bottom">
    <div class="container-fluid">
      <a class="navbar-brand py-2 me-4 d-flex align-items-center" href="#">
        <img src="images/logo-black.png" alt="CMO Logo" class="me-1 rounded d-none d-md-block dark-mode-logo"
          width="48px">
        <img src="images/logo-white.png" alt="CMO Logo" class="me-1 rounded light-mode-logo d-none d-md-block"
          width="48px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"></li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown ms-2">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="bi bi-person-circle"></i> <span class="d-lg-none d-xl-inline"> User A</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="#" id="nav-profile-theme">
                  <i class="bi bi-moon me-2" id="profileThemeIcon"></i>
                  <span>Switch to Dark Mode</span>
                </a>
              </li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="mainLayout" class="d-flex flex-fill">
    <div id="sidebarMenu" class="d-flex flex-column flex-shrink-0 bg-light border-end p-2 collapsed">
      <a class="h6 mt-2 mb-1 pb-1 collapsed-toggle" data-bs-toggle="collapse" href="#carMenu" role="button"
        aria-expanded="true" aria-controls="carMenu">
        <i class="bi bi-car-front me-1 "></i>
        <span>Car Center</span>
      </a>
      <ul id="carMenu" class="nav nav-pills flex-column collapse show">
        <li class="nav-item"><a id="menu-car-center" href="#" class="nav-link"><i class="bi bi-ev-front"></i>
            <span>Booking Calendar</span></a></li>
        <li class="nav-item"><a id="menu-car-reserve" href="#" class="nav-link"><i class="bi bi-ev-front-fill"></i>
            <span>Booking Table</span></a></li>
      </ul>
      <a class="h6 mt-1 mb-1 pb-1 collapsed-toggle" data-bs-toggle="collapse" href="#meetingMenu" role="button"
        aria-expanded="true" aria-controls="meetingMenu">
        <i class="bi bi-easel me-1 "></i>
        <span>Meeting Room</span>
      </a>
      <ul id="meetingMenu" class="nav nav-pills flex-column mb-auto collapse show">
        <li class="nav-item"><a id="menu-meeting-room" href="#" class="nav-link">
            <i class="bi bi-calendar-week"></i><span>All Booking</span></a></li>
        <li class="nav-item">
          <a id="menu-meeting-calendar" href="#" class="nav-link active" aria-current="page">
            <i class="bi bi-calendar-check-fill"></i><span>My Booking</span></a>
        </li>
      </ul>
      <div class="mt-auto border-top p-2 text-center">
        <button id="sidebarToggle" class="btn btn-sm w-100 p-0 shadow-none">
          <i class="bi bi-arrow-right-circle-fill"></i>
        </button>
      </div>
    </div>

    <div id="mainContent" class="flex-grow-1 p-3">
      <div class="container" id="contentContainer">
        <div class="row">
          <div class="col-md-8">
            <div class="card shadow-lg mt-4">
              <div class="card-header">Main Calendar</div>
              <div class="card-body pt-4 pb-5 ">
                <div id="calendar"></div>
              </div>
              <div class="card-footer">* คุณสามารถ กดเลือกรายการที่ Hiligh เพื่อดูรายละเอียดการจอง หรือ กดปุ่ม +
                ข้างหน้าจอ เพื่อทำการจอง</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow mt-4">
              <div class="card-header text-end">Mini Calendar</div>
              <div class="card-body pt-0 ">
                <div id="miniCalendar"></div>
              </div>
            </div>
            <div class="card shadow mt-3">
              <div class="card-body py-3">
                <div class="row gx-0">
                  <div class="col-sm-4">
                    <div class="form-check mb-2">
                      <input type="checkbox" class="form-check-input room-filter" id="filter_room_1" value="Meeting 1"
                        checked>
                      <label class="form-check-label" for="filter_room_1" style="white-space: nowrap;"> Meeting
                        1</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" class="form-check-input room-filter" id="filter_room_2" value="Meeting 2"
                        checked>
                      <label class="form-check-label" for="filter_room_2" style="white-space: nowrap;"> Meeting
                        2</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" class="form-check-input room-filter" id="filter_room_3" value="Meeting 3"
                        checked>
                      <label class="form-check-label" for="filter_room_3" style="white-space: nowrap;"> Meeting
                        3</label>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-check mb-2">
                      <input type="checkbox" class="form-check-input room-filter" id="filter_room_4"
                        value="Training Room 1 (Floor 3)" checked>
                      <label class="form-check-label" for="filter_room_4" style="white-space: nowrap;"> Training Room 1
                        (Floor 3)</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" class="form-check-input room-filter" id="filter_room_5"
                        value="Training Room 3 (Floor 1)" checked>
                      <label class="form-check-label" for="filter_room_5" style="white-space: nowrap;"> Training Room 3
                        (Floor 1)</label>
                    </div>
                    <div class="form-check mb-2">
                      <input type="checkbox" class="form-check-input room-filter" id="filter_room_6"
                        value="ห้องปูน (Floor 3)" checked>
                      <label class="form-check-label" for="filter_room_6" style="white-space: nowrap;"> ห้องปูน (Floor
                        3)</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">Select room to display</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card mt-4 shadow" id="tableWrapper">
              <div class="card-header">Booking List</div>
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-12 text-end">
                    <button id="btnResetFilters" class="btn btn-outline-secondary btn-sm">
                      <i class="bi bi-arrow-counterclockwise"></i> Reset All Filters
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label class="fw-bold small text-uppercase text-muted mb-2">Operating Unit</label>
                    <select id="unitFilter" class="form-select">
                      <option value="">All Units</option>
                      <option value="Information Technology">Information Technology</option>
                      <option value="Human Resources">Human Resources</option>
                      <option value="Marketing">Marketing</option>
                      <option value="Operations">Operations</option>
                      <option value="Finance">Finance</option>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label class="fw-bold small text-uppercase text-muted mb-2">Start Range</label>
                    <input type="text" id="tableFilterStart" class="form-control" placeholder="YYYY-MM-DD">
                  </div>

                  <div class="col-md-3">
                    <label class="fw-bold small text-uppercase text-muted mb-2">End Range</label>
                    <input type="text" id="tableFilterEnd" class="form-control" placeholder="YYYY-MM-DD">
                  </div>

                  <div class="col-md-3">
                    <label class="fw-bold small text-uppercase text-muted mb-2">Status</label>
                    <select id="statusFilter" class="form-select">
                      <option value="">All Status</option>
                      <option value="Draft">Draft</option>
                      <option value="Booked">Booked</option>
                      <option value="Cancel">Cancel</option>
                      <!-- <option value="Rejected">Rejected</option> -->
                    </select>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <table id="bookingTable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Room</th>
                          <th>Title</th>
                          <th>Start</th>
                          <th>End</th>
                          <th>Booking Name</th>
                          <th>Operating Unit</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">Select room to display</div>
            </div>
          </div>
        </div>
      </div>
      <button id="toggleTable" class="fab"><i class="bi bi-table"></i></button>
      <button class="fab fab-add-new" data-bs-toggle="modal" data-bs-target="#bookingModal">
        <i class="bi bi-plus"></i>
      </button>
    </div>
  </div>

  <div class="modal fade" id="bookingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form id="bookingForm" class="modal-content border-0 shadow-lg">
        <div class="modal-header text-white" id="modalHeader"
          style="background-color: #6c757d; transition: background-color 0.4s ease;">
          <h5 class="modal-title fw-bold">
            <i class="bi bi-calendar-plus me-2"></i>Booking Form
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4">
          <div class="container-fluid">
            <div class="row g-3">
              <div class="col-12">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-bookmark-fill me-1 theme-icon" style="transition: color 0.4s;"></i>Title
                </label>
                <input type="text" name="title" class="form-control form-control-lg shadow-sm"
                  placeholder="Enter meeting title..." required />
              </div>

              <div class="col-md-12">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-door-open-fill me-1 theme-icon"></i>Meeting Room
                </label>
                <select name="room" id="roomSelector" class="form-select" required>
                  <option value="Meeting 1" selected>Meeting 1</option>
                  <option value="Meeting 2">Meeting 2</option>
                  <option value="Meeting 3">Meeting 3</option>
                  <option value="Training Room 1 (Floor 3)">Training Room 1 (Floor 3)</option>
                  <option value="Training Room 3 (Floor 1)">Training Room 3 (Floor 1)</option>
                  <option value="ห้องปูน (Floor 3)">ห้องปูน (Floor 3)</option>
                </select>
              </div>

              <!-- <div class="col-md-6">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-building me-1 theme-icon"></i>Operating Unit
                </label>
                <select name="operating_unit" class="form-select" required>
                  <option value="Information Technology" disabled selected>Information Technology</option>
                  <option value="Human Resources">Human Resources</option>
                  <option value="Marketing">Marketing</option>
                  <option value="Operations">Operations</option>
                  <option value="Finance">Finance</option>
                </select>
              </div> -->

              <div class="col-md-6">
                <div class="p-3 rounded bg-light border">
                  <label class="small text-uppercase fw-bold text-muted mb-1 d-block">Start Time</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                        class="bi bi-calendar-event theme-icon"></i></span>
                    <input type="text" id="start_time" name="start" class="form-control border-start-0" required />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-3 rounded bg-light border">
                  <label class="small text-uppercase fw-bold text-muted mb-1 d-block">End Time</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                        class="bi bi-calendar-check theme-icon"></i></span>
                    <input type="text" id="end_time" name="end" class="form-control border-start-0" required />
                  </div>
                </div>
              </div>

              <div class="col-12">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-person-badge-fill me-1 theme-icon"></i>Booked By
                </label>
                <input type="text" name="booked_by" class="form-control" required />
              </div>

              <div class="col-12">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-chat-left-dots-fill me-1 theme-icon"></i>Notes
                </label>
                <textarea name="note" class="form-control" rows="2"></textarea>
              </div>

              
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light border-top-0 px-4">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="btnSubmitBooking" class="btn px-5 fw-bold text-white shadow-sm"
            style="background-color: #6c757d;">
            <i class="bi bi-check-circle me-2"></i>Confirm Booking
          </button>
        </div>
      </form>
    </div>
  </div>


  <div class="modal fade" id="viewBookingModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form id="viewBookingForm" class="modal-content border-0 shadow-lg">
        <div class="modal-header text-white" id="modalHeader"
          style="background-color: #6c757d; transition: background-color 0.4s ease;">
          <h5 class="modal-title fw-bold">
            <i class="bi bi-calendar-plus me-2"></i>Booking Detail
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body p-4">
          <div class="container-fluid">
            <div class="row g-3">
              <div class="col-12">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-bookmark-fill me-1 theme-icon" style="transition: color 0.4s;"></i>Meeting Title
                </label>
                <input type="text" name="title" class="form-control form-control-lg shadow-sm"
                  placeholder="Enter meeting title..." required />
              </div>

              <div class="col-md-6">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-door-open-fill me-1 theme-icon"></i>Meeting Room
                </label>
                <select name="room" id="roomSelector" class="form-select" required>
                  <option value="Meeting 1" selected>Meeting 1</option>
                  <option value="Meeting 2">Meeting 2</option>
                  <option value="Meeting 3">Meeting 3</option>
                  <option value="Training Room 1 (Floor 3)">Training Room 1 (Floor 3)</option>
                  <option value="Training Room 3 (Floor 1)">Training Room 3 (Floor 1)</option>
                  <option value="ห้องปูน (Floor 3)">ห้องปูน (Floor 3)</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-building me-1 theme-icon"></i>Operating Unit
                </label>
                <select name="operating_unit" class="form-select" required>
                  <option value="" disabled selected>Select Unit...</option>
                  <option value="Information Technology">Information Technology</option>
                  <option value="Human Resources">Human Resources</option>
                  <option value="Marketing">Marketing</option>
                  <option value="Operations">Operations</option>
                  <option value="Finance">Finance</option>
                </select>
              </div>

              <div class="col-md-6">
                <div class="p-3 rounded bg-light border">
                  <label class="small text-uppercase fw-bold text-muted mb-1 d-block">Start Time</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                        class="bi bi-calendar-event theme-icon"></i></span>
                    <input type="text" id="start_time" name="start" class="form-control border-start-0" required />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="p-3 rounded bg-light border">
                  <label class="small text-uppercase fw-bold text-muted mb-1 d-block">End Time</label>
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i
                        class="bi bi-calendar-check theme-icon"></i></span>
                    <input type="text" id="end_time" name="end" class="form-control border-start-0" required />
                  </div>
                </div>
              </div>

              <div class="col-12">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-person-badge-fill me-1 theme-icon"></i>Booked By
                </label>
                <input type="text" name="booked_by" class="form-control" required />
              </div>

              <div class="col-12">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-chat-left-dots-fill me-1 theme-icon"></i>Notes
                </label>
                <textarea name="note" class="form-control" rows="2"></textarea>
              </div>

              <div class="col-md-12">
                <label class="small text-uppercase fw-bold text-muted mb-1">
                  <i class="bi bi-flag-fill me-1 theme-icon"></i>Status
                </label>
                <select name="status" class="form-select" required>
                  <option value="Pending" selected>Pending</option>
                  <option value="Approved">Approved</option>
                  <option value="Rejected">Rejected</option>
                  <option value="Cancelled">Cancelled</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light border-top-0 px-4">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="btnSubmitBooking" class="btn px-5 fw-bold text-white shadow-sm"
            style="background-color: #6c757d;">
            <i class="bi bi-check-circle me-2"></i>Confirm Booking
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Booking Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2"><b>ห้อง:</b> <span id="d_room"></span></div>
          <div class="mb-2"><b>ชื่อการประชุม:</b> <span id="d_title"></span></div>
          <div class="mb-2"><b>หัวข้อ:</b> <span id="d_subject"></span></div>
          <div class="mb-2"><b>วันที่:</b> <span id="d_date"></span></div>
          <div class="mb-2"><b>เวลา:</b> <span id="d_time_range"></span></div>
          <div class="mb-2"><b>ผู้จอง:</b> <span id="d_booked"></span></div>
          <div class="mb-2"><b>เวลาที่จองระบบ:</b> <span id="d_booked_time"></span></div>
          <div class="mb-2"><b>หมายเหตุ:</b> <span id="d_note"></span></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <footer id="mainFooter" class="border-top py-2 px-3 text-center">
    <div class="container-fluid">
      <span class="text-muted">
        &copy; <span id="currentYear"></span> CMO PUBLIC COMPANY LIMITED. All rights reserved.
        <span class="d-none d-md-inline">| Last access: <span id="currentTime"></span></span>
      </span>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.excelHtml5.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        const min = $('#tableFilterStart').val();
        const max = $('#tableFilterEnd').val();
        const rowDate = data[2].substring(0, 10);
        if (
          (min === "" && max === "") ||
          (min === "" && rowDate <= max) ||
          (min <= rowDate && max === "") ||
          (min <= rowDate && rowDate <= max)
        ) {
          return true;
        }
        return false;
      });
      const roomColors = {
        "Meeting 2": "#0d6efd",
        "Meeting 1": "#6c757d",
        "Meeting 3": "#fd7e14",
        "Training Room 1 (Floor 3)": "#6f42c1",
        "Training Room 3 (Floor 1)": "#dc3545",
        "ห้องปูน (Floor 3)": "#20c997",
      };
      let darkMode = localStorage.getItem("darkMode") === "true";
      let isTableVisible = localStorage.getItem("isTableVisible") !== "false";
      let isSidebarCollapsed = localStorage.getItem("isSidebarCollapsed") === "true";
      const ACTIVE_MENU_KEY = "activeMenuId";
      const NAVBAR_ACTIVE_KEY = "navbarActiveId";
      const CAR_MENU_STATE = "carMenuState";
      const MEETING_MENU_STATE = "meetingMenuState";
      let calendar, miniCal, table;
      const DATA_URL = "data.php";
      restoreOperatingUnitDropdown();
      initTheme();
      initSidebar();
      loadCollapseMenuState();
      initActiveMenu();
      initNavbarActiveMenu();
      initPickers();
      initCalendars();
      initTable();
      initDateRangeFilters();
      initEventHandlers();
      const getStartDay = (datetime) => (datetime ? datetime.substring(0, 10) : "");

      function initNavbarActiveMenu() {
        const defaultNavbarId = "nav-report-current-year";
        let activeNavbarId = localStorage.getItem(NAVBAR_ACTIVE_KEY) || defaultNavbarId;
        $(".navbar-nav .nav-link, .navbar-nav .dropdown-item").removeClass("active");
        if (activeNavbarId) {
          const activeLink = $(`#${activeNavbarId}`);
          if (activeLink.length) {
            activeLink.addClass("active");
            const parentDropdownToggle = activeLink.closest(".dropdown").find(".dropdown-toggle").first();
            if (parentDropdownToggle.length) {
              parentDropdownToggle.addClass("active");
            }
            const dropendToggle = activeLink.closest(".dropend").find(".dropdown-item.dropdown-toggle");
            if (dropendToggle.length) {
              dropendToggle.addClass("active");
            }
          }
        }
      }

      function initActiveMenu() {
        const defaultMenuId = "menu-meeting-calendar";
        let activeMenuId = localStorage.getItem(ACTIVE_MENU_KEY) || defaultMenuId;
        $("#sidebarMenu .nav-link").removeClass("active").removeAttr("aria-current");
        const activeLink = $(`#${activeMenuId}`);
        if (activeLink.length) {
          activeLink.addClass("active").attr("aria-current", "page");
        } else {
          $(`#${defaultMenuId}`).addClass("active").attr("aria-current", "page");
          localStorage.setItem(ACTIVE_MENU_KEY, defaultMenuId);
        }
      }

      function initSidebar() {
        applySidebarState(isSidebarCollapsed);
      }

      function applySidebarState(isCollapsed) {
        const sidebar = document.getElementById("sidebarMenu");
        const toggleIcon = document.querySelector("#sidebarToggle i");
        const contentContainer = document.getElementById("contentContainer");
        if (isCollapsed) {
          sidebar.classList.add("collapsed");
          toggleIcon.classList.remove("bi-arrow-left-circle-fill");
          toggleIcon.classList.add("bi-arrow-right-circle-fill");
          contentContainer.classList.remove("container");
          contentContainer.classList.add("container-fluid");
        } else {
          sidebar.classList.remove("collapsed");
          toggleIcon.classList.remove("bi-arrow-right-circle-fill");
          toggleIcon.classList.add("bi-arrow-left-circle-fill");
          contentContainer.classList.remove("container-fluid");
          contentContainer.classList.add("container");
        }
      }

      function updateLabelColors() {
        $(".room-filter").each(function() {
          const roomName = $(this).val();
          const color = roomColors[roomName];
          const label = $(this).next('label');
          if ($(this).is(':checked')) {
            label.css('color', color).css('font-weight', 'bold');
            $(this).css('--room-color', color);
          } else {
            label.css('color', '').css('font-weight', 'normal');
            $(this).css('--room-color', color);
          }
        });
      }
      // ฟังก์ชันสำหรับเปลี่ยนสี Modal
      function applyModalTheme(roomName) {
        const targetColor = roomColors[roomName] || "#6c757d"; // ถ้าไม่มีห้องให้ใช้สีเทา
        const isDarkMode = $('body').hasClass('dark-mode');
        // เปลี่ยนสีพื้นหลัง Header
        $('#modalHeader').css('background-color', targetColor);
        // เปลี่ยนสีไอคอนต่างๆ ในฟอร์ม
        $('.theme-icon').css('color', targetColor);
        // เปลี่ยนสีปุ่มบันทึก
        $('#btnSubmitBooking').css({
          'background-color': targetColor,
          'border-color': targetColor
        });
        $('.theme-icon').css('color', targetColor);
        if (isDarkMode) {
          $('.bg-light').css('border-color', targetColor + '40'); // 40 คือความโปร่งแสง 25%
        } else {
          $('.bg-light').css('border-color', '');
        }
      }
      // ตรวจจับเมื่อมีการเลือกห้องใน Select
      $('#roomSelector').on('change', function() {
        applyModalTheme($(this).val());
      });
      // รีเซ็ตสีกลับเป็นปกติเมื่อปิด Modal
      $('#bookingModal').on('hidden.bs.modal', function() {
        applyModalTheme(""); // Reset color
        $('#bookingForm')[0].reset();
      });

      function loadCollapseMenuState() {
        const carState = localStorage.getItem(CAR_MENU_STATE);
        const meetingState = localStorage.getItem(MEETING_MENU_STATE);
        const setMenuState = (menuId, savedState) => {
          const menu = $(`#${menuId}`);
          const toggle = $(`a[href="#${menuId}"]`);
          if (savedState === "false") {
            menu.removeClass("show");
            toggle.addClass("collapsed");
            toggle.attr("aria-expanded", "false");
          } else {
            menu.addClass("show");
            toggle.removeClass("collapsed");
            toggle.attr("aria-expanded", "true");
          }
        };
        setMenuState("carMenu", carState);
        setMenuState("meetingMenu", meetingState);
      }

      function saveRoomFilterState() {
        const roomStates = {};
        $(".room-filter").each(function() {
          roomStates[$(this).val()] = $(this).is(":checked");
        });
        localStorage.setItem("roomFilterStates", JSON.stringify(roomStates));
      }

      function loadRoomFilterState() {
        const savedRoomStates = localStorage.getItem("roomFilterStates");
        let selectedRooms = [];
        let shouldSaveDefaultState = false;
        if (savedRoomStates) {
          try {
            const roomStates = JSON.parse(savedRoomStates);
            $(".room-filter").each(function() {
              const roomName = $(this).val();
              const isChecked = roomStates.hasOwnProperty(roomName) ? roomStates[roomName] : true;
              $(this).prop("checked", isChecked);
              if (isChecked) selectedRooms.push(roomName);
            });
          } catch (e) {
            localStorage.removeItem("roomFilterStates");
            shouldSaveDefaultState = true;
          }
        }
        if (!savedRoomStates || shouldSaveDefaultState) {
          $(".room-filter").prop("checked", true);
          selectedRooms = $(".room-filter").map(function() {
            return this.value;
          }).get();
          saveRoomFilterState();
        }
        return selectedRooms;
      }

      function initTheme() {
        applyTheme(darkMode);
      }

      function applyTheme(isDark) {
        const body = document.body;
        const profileThemeIcon = document.getElementById("profileThemeIcon");
        const profileThemeText = document.querySelector("#nav-profile-theme span");
        if (isDark) {
          body.classList.add("dark-mode");
          body.classList.remove("light-mode");
          $(".light-mode-logo").css("display", "none");
          $(".dark-mode-logo").css("display", "inline-block");
          if (profileThemeIcon) profileThemeIcon.className = "bi bi-sun me-2";
          if (profileThemeText) profileThemeText.textContent = "Switch to Light Mode";
          $(".card").addClass("bg-dark text-white border-secondary");
          $(".form-select, .form-control").addClass("bg-dark text-white border-secondary");
        } else {
          body.classList.add("light-mode");
          body.classList.remove("dark-mode");
          $(".dark-mode-logo").css("display", "none");
          $(".light-mode-logo").css("display", "inline-block");
          if (profileThemeIcon) profileThemeIcon.className = "bi bi-moon me-2";
          if (profileThemeText) profileThemeText.textContent = "Switch to Dark Mode";
          $(".card").removeClass("bg-dark text-white border-secondary");
          $(".form-select, .form-control").removeClass("bg-dark text-white border-secondary");
        }
      }

      function applyTableVisibility(isVisible) {
        const tableWrapper = $("#tableWrapper");
        const icon = $("#toggleTable i");
        if (isVisible) {
          tableWrapper.show();
          icon.removeClass("bi-eye-slash").addClass("bi-table");
        } else {
          tableWrapper.hide();
          icon.removeClass("bi-table").addClass("bi-eye-slash");
        }
      }

      function initPickers() {
        const flatpickrConfig = {
          enableTime: true,
          dateFormat: "Y-m-d H:i",
          noCalendar: false,
          time_24hr: true,
          onOpen: (selectedDates, dateStr, instance) => {
            if (document.body.classList.contains("dark-mode")) {
              instance.calendarContainer.classList.add("dark-mode");
            } else {
              instance.calendarContainer.classList.remove("dark-mode");
            }
          },
        };
        flatpickr("#start_time", flatpickrConfig);
        flatpickr("#end_time", flatpickrConfig);
      }

      function mapEventData(e) {
        const isAllDay = !e.start.includes("T") && !e.end.includes("T");
        return {
          id: e.id,
          title: e.title + " (" + e.room + ")",
          start: e.start,
          end: e.end,
          extendedProps: e,
          color: roomColors[e.room],
          allDay: isAllDay,
          display: "auto",
          startEditable: false,
          durationEditable: false,
        };
      }

      function showEventDetails(info) {
        const data = info.event.extendedProps;
        const isDarkMode = document.body.classList.contains('dark-mode');
        let statusBadgeClass = "bg-secondary";
        let statusIconClass = "bi-question-circle";
        const status = data.status || "Draft";
        switch (status) {
          case "Booked":
            statusBadgeClass = "bg-success"; // สีเขียว
            statusIconClass = "bi-check-circle-fill";
            break;
          case "Pending":
            statusBadgeClass = "bg-warning text-dark"; // สีเหลือง ตัวหนังสือดำ
            statusIconClass = "bi-hourglass-split";
            break;
          case "Cancel":
            statusBadgeClass = "bg-danger"; // สีแดง
            statusIconClass = "bi-x-circle-fill";
            break;
          case "Draft":
            statusBadgeClass = "bg-secondary"; // สีเทา
            statusIconClass = "bi-dash-circle-fill";
            break;
        }
        const formatDateTime = (dateTimeStr) => {
          if (!dateTimeStr) return "-";
          const dateObj = new Date(dateTimeStr);
          const d = dateObj.toLocaleDateString('th-TH', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
          });
          const t = dateTimeStr.substring(11, 16);
          return `${d} ${t}`;
        };
        const startDisplay = formatDateTime(data.start);
        const endDisplay = formatDateTime(data.end);
        const highlightColor = roomColors[data.room] || "#6c757d";
        const modalBody = document.querySelector("#detailModal .modal-body");
        // modalBody.innerHTML = `
        //   <div class="container-fluid">
        //     <div class="row g-3">
        //       <div class="col-12 border-bottom pb-3 mb-2">
        //         <h5 style="color: ${highlightColor};" class="mb-1 fw-bold">
        //           <i class="bi bi-bookmark-fill me-2"></i>${data.title.replace(` (${data.room})`, '') || "Untitled Meeting"}
        //         </h5>
        //         <p class="mb-0 small ${isDarkMode ? 'text-light' : 'text-muted'}">
        //           <strong class="${isDarkMode ? 'text-white' : ''}">Subject:</strong> ${data.subject || "No subject provided"}
        //         </p>
        //       </div>
        //       <div class="col-md-6">
        //         <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Meeting Room</label>
        //         <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-door-open me-2" style="color: ${highlightColor};"></i>${data.room || "-"}</span>
        //       </div>
        //       <div class="col-md-6">
        //         <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Operating Unit</label>
        //         <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-building me-2" style="color: ${highlightColor};"></i>${data.operating_unit || "-"}</span>
        //       </div>
        //       <div class="col-md-6">
        //         <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Start</label>
        //         <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-calendar-event me-2" style="color: ${highlightColor};"></i>${startDisplay}</span>
        //       </div>
        //       <div class="col-md-6">
        //         <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">End</label>
        //         <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-calendar-check me-2" style="color: ${highlightColor};"></i>${endDisplay}</span>
        //       </div>
        //       <div class="col-md-6">
        //         <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Booked By</label>
        //         <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-person-badge me-2" style="color: ${highlightColor};"></i>${data.booked_by || "-"}</span>
        //       </div>
        //       <div class="col-md-6">
        //         <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Booked Timestamp</label>
        //         <span class="small ${isDarkMode ? 'text-light' : 'text-secondary'}"><i class="bi bi-cpu me-2"></i>${data.booked_time || "-"}</span>
        //       </div>
        //       <div class="col-12 mt-3">
        //         <div class="p-3 rounded border shadow-sm" style="background-color: ${isDarkMode ? '#2a2a2a' : 'rgba(0,0,0,0.03)'}; border-left: 5px solid ${highlightColor} !important;">
        //           <label class="small d-block text-uppercase fw-bold mb-1 ${isDarkMode ? 'text-white-50' : 'text-muted'}">Note / Description</label>
        //           <div class="small ${isDarkMode ? 'text-white' : 'text-dark'}" style="white-space: pre-wrap;">${data.note || "No additional notes."}</div>
        //         </div>
        //       </div>
        //     </div>
        //   </div>`;
        modalBody.innerHTML = `
      <div class="container-fluid">
        <div class="row g-3">
          <div class="col-12 border-bottom pb-3 mb-2">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 style="color: ${highlightColor};" class="mb-1 fw-bold">
                      <i class="bi bi-bookmark-fill me-2"></i>${data.title.replace(` (${data.room})`, '') || "Untitled Meeting"}
                    </h5>
                    <p class="mb-0 small ${isDarkMode ? 'text-light' : 'text-muted'}">
                      <strong class="${isDarkMode ? 'text-white' : ''}">Subject:</strong> ${data.subject || "No subject provided"}
                    </p>
                </div>
                <span class="badge rounded-pill ${statusBadgeClass} fs-6 px-3 py-2">
                    <i class="bi ${statusIconClass} me-1"></i>${status}
                </span>
            </div>
          </div>

          <div class="col-md-6">
            <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Meeting Room</label>
            <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-door-open me-2" style="color: ${highlightColor};"></i>${data.room || "-"}</span>
          </div>
          <div class="col-md-6">
            <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Operating Unit</label>
            <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-building me-2" style="color: ${highlightColor};"></i>${data.operating_unit || "-"}</span>
          </div>
          <div class="col-md-6">
            <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Start</label>
            <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-calendar-event me-2" style="color: ${highlightColor};"></i>${startDisplay}</span>
          </div>
          <div class="col-md-6">
            <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">End</label>
            <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-calendar-check me-2" style="color: ${highlightColor};"></i>${endDisplay}</span>
          </div>
          <div class="col-md-6">
            <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Booked By</label>
            <span class="fs-6 fw-bold ${isDarkMode ? 'text-white' : ''}"><i class="bi bi-person-badge me-2" style="color: ${highlightColor};"></i>${data.booked_by || "-"}</span>
          </div>
          
          <div class="col-md-6">
             <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Current Status</label>
             <span class="${isDarkMode ? 'text-white' : 'text-dark'} fw-bold">${status}</span>
          </div>

          <div class="col-12 mt-3">
            <div class="p-3 rounded border shadow-sm" style="background-color: ${isDarkMode ? '#2a2a2a' : 'rgba(0,0,0,0.03)'}; border-left: 5px solid ${highlightColor} !important;">
              <label class="small d-block text-uppercase fw-bold mb-1 ${isDarkMode ? 'text-white-50' : 'text-muted'}">Note / Description</label>
              <div class="small ${isDarkMode ? 'text-white' : 'text-dark'}" style="white-space: pre-wrap;">${data.note || "No additional notes."}</div>
            </div>
          </div>
        </div>
      </div>`;
        new bootstrap.Modal(document.getElementById("detailModal")).show();
      }

      function initCalendars() {
        const initialRooms = loadRoomFilterState();
        const savedUnit = localStorage.getItem("selectedOperatingUnit") || "";
        const savedStatus = localStorage.getItem("selectedStatus") || ""; // <--- เพิ่ม: ดึง Status ที่ save ไว้
        const startRange = localStorage.getItem("tableFilterStart") || "";
        const endRange = localStorage.getItem("tableFilterEnd") || "";
        // const selectedRooms = initialRooms.length > 0 ? initialRooms : $(".room-filter:checked").map(
        //       function() {
        //         return this.value;
        //       }).get();
        const eventSourceConfig = {
          url: DATA_URL,
          method: "GET",
          success: function(rawEvents) {
            const events = rawEvents.map(mapEventData);
            return events.map((evt) => {
              // const isVisible = selectedRooms.includes(evt.extendedProps.room);
              // evt.display = isVisible ? "auto" : "none";
              const roomName = evt.extendedProps.room;
              const unitName = evt.extendedProps.operating_unit;
              const statusName = evt.extendedProps.status;
              const eventDate = evt.start.substring(0, 10); // ดึงเฉพาะ YYYY-MM-DD
              const roomMatch = initialRooms.includes(roomName);
              const unitMatch = (savedUnit === "" || unitName === savedUnit);
              const statusMatch = (savedStatus === "" || statusName === savedStatus);
              let dateMatch = true;
              if (startRange && eventDate < startRange) dateMatch = false;
              if (endRange && eventDate > endRange) dateMatch = false;
              // ถ้าผ่านทุกเงื่อนไขให้แสดง (auto) ถ้าไม่ผ่านให้ซ่อน (none)
              evt.display = (roomMatch && unitMatch && statusMatch && dateMatch) ? "auto" : "none";
              return evt;
            });
          },
        };
        const isMobile = window.matchMedia("(max-width: 768px)").matches;
        const mainHeaderToolbar = isMobile ? {
          left: "prev,next",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth,multiMonthYear"
        } : {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth,multiMonthYear"
        };
        calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
          themeSystem: "bootstrap5",
          initialView: "dayGridMonth",
          height: "auto",
          headerToolbar: mainHeaderToolbar,
          buttonText: {
            today: "Today",
            month: "Month",
            week: "Week",
            day: "Day",
            listMonth: "List",
            multiMonthYear: "Annual"
          },
          timeZone: "local",
          views: {
            dayGridMonth: {
              titleFormat: {
                month: "long"
              }
            }
          },
          events: eventSourceConfig,
          eventClick: showEventDetails,
        });
        const miniHeaderToolbar = {
          left: "prev",
          center: "title",
          right: "next"
        };
        miniCal = new FullCalendar.Calendar(document.getElementById("miniCalendar"), {
          initialView: "dayGridMonth",
          height: "auto",
          contentHeight: "auto",
          expandRows: true,
          headerToolbar: miniHeaderToolbar,
          events: eventSourceConfig,
          eventClick: showEventDetails,
          selectable: true,
          dateClick: (info) => calendar.gotoDate(info.dateStr),
        });
        calendar.render();
        miniCal.render();
      }

      function initDateRangeFilters() {
        const startSaved = localStorage.getItem("tableFilterStart");
        const endSaved = localStorage.getItem("tableFilterEnd");
        flatpickr("#tableFilterStart", {
          dateFormat: "Y-m-d",
          defaultDate: startSaved || null,
          onChange: function(selectedDates, dateStr) {
            localStorage.setItem("tableFilterStart", dateStr);
            if (table) table.draw();
          }
        });
        flatpickr("#tableFilterEnd", {
          dateFormat: "Y-m-d",
          defaultDate: endSaved || null,
          onChange: function(selectedDates, dateStr) {
            localStorage.setItem("tableFilterEnd", dateStr);
            if (table) table.draw();
          }
        });
      }

      function initTable() {
        const initialRooms = loadRoomFilterState();
        applyRoomFilter(false);
        table = $("#bookingTable").DataTable({
          dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex align-items-center justify-content-end"fB>>' +
            '<"row spacer-row">' + '<"row"<"col-sm-12"t>>' + '<"row spacer-row">' +
            '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
          initComplete: function() {
            $(this.api().table().container()).find(".dt-buttons").css({
              "margin-left": "15px",
              "margin-bottom": "0"
            });
            $(this.api().table().container()).find(".dataTables_filter").css({
              "margin-right": "0",
              "margin-bottom": "0"
            });
            const savedUnit = localStorage.getItem("selectedOperatingUnit");
            if (savedUnit && savedUnit !== "") {
              this.api().column(5).search('^' + savedUnit + '$', true, false).draw();
            }
            const savedStatus = localStorage.getItem("selectedStatus");
            if (savedStatus && savedStatus !== "") {
              $('#statusFilter').val(savedStatus);
              this.api().column(6).search('^' + savedStatus + '$', true, false).draw();
            }
            const api = this.api();
            if (savedUnit) {
              $('#unitFilter').val(savedUnit);
              api.column(5)
                .search('^' + savedUnit.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&") + '$', true, false)
                .draw();
            }
            const start = localStorage.getItem("tableFilterStart");
            const end = localStorage.getItem("tableFilterEnd");
            if (start || end) {
              api.draw();
            }
            updateDatatableButtonTheme(darkMode);
          },
          buttons: [{
              extend: "copyHtml5",
              text: '<i class="bi bi-files"></i>',
              className: "btn btn-light btn-sm",
              exportOptions: {
                columns: ":visible"
              }
            },
            {
              extend: "excelHtml5",
              text: '<i class="bi bi-file-earmark-excel"></i>',
              className: "btn btn-light btn-sm",
              exportOptions: {
                columns: ":visible"
              }
            },
            {
              extend: "csvHtml5",
              text: '<i class="bi bi-filetype-csv"></i>',
              className: "btn btn-light btn-sm",
              exportOptions: {
                columns: ":visible"
              }
            },
            {
              extend: "print",
              text: '<i class="bi bi-printer"></i>',
              className: "btn btn-light btn-sm",
              exportOptions: {
                columns: ":visible"
              }
            }
          ],
          ajax: {
            url: DATA_URL,
            dataSrc: ""
          },
          columns: [{
              data: "room"
            },
            {
              data: "title"
            },
            {
              data: "start",
              render: function(data, type) {
                if (!data) return "";
                if (type === "filter" || type === "sort") return data;
                const d = new Date(data.replace(" ", "T"));
                return `${String(d.getDate()).padStart(2, "0")}/${String(d.getMonth() + 1).padStart(2, "0")}/${d.getFullYear()} ${String(d.getHours()).padStart(2, "0")}:${String(d.getMinutes()).padStart(2, "0")}`;
              }
            },
            {
              data: "end",
              render: function(data, type) {
                if (!data) return "";
                if (type === "sort" || type === "type") return data;
                const d = new Date(data.replace(" ", "T"));
                return `${String(d.getDate()).padStart(2, "0")}/${String(d.getMonth() + 1).padStart(2, "0")}/${d.getFullYear()} ${String(d.getHours()).padStart(2, "0")}:${String(d.getMinutes()).padStart(2, "0")}`;
              }
            },
            {
              data: "booked_by"
            },
            {
              data: "operating_unit"
            },
            {
              data: "status"
            }
          ],
          stateSave: true,
        });
        applyTableVisibility(isTableVisible);
        table.on("init", function() {
          let searchVal = initialRooms.length === 0 ? "^$" : "^(" + initialRooms.map(r => r.replace(
            /[-\/\\^$*+?.()|[\]{}]/g, "\\$&")).join("|") + ")$";
          table.column(0).search(searchVal, true, false).draw();
        });
        table.on("draw.dt", function() {
          applyPaginationTheme(darkMode);
        });
      }

      function updateDatatableButtonTheme(isDark) {
        if (!table) return;
        const exportButtons = table.buttons().containers().find(".btn");
        if (isDark) exportButtons.removeClass("btn-light").addClass("btn-dark");
        else exportButtons.removeClass("btn-dark").addClass("btn-light");
        applyPaginationTheme(isDark);
      }
      // function applyPaginationTheme(isDark) {
      //   if (!table) return;
      //   const paginateButtons = $(table.table().container()).find(".dataTables_paginate .paginate_button");
      //   paginateButtons.removeClass("btn-light btn-dark btn-sm").addClass("btn btn-sm");
      //   if (isDark) paginateButtons.addClass("btn-dark");
      //   else {
      //     paginateButtons.addClass("btn-light");
      //     paginateButtons.filter(".current").css({
      //       "background-color": "#0d6efd",
      //       "border-color": "#0d6efd",
      //       color: "#fff"
      //     });
      //   }
      //   paginateButtons.not(".current").css({
      //     "background-color": isDark ? "#2a2a2a" : "transparent",
      //     "border-color": isDark ? "#555" : "#dee2e6",
      //     color: isDark ? "#ddd" : "#0d6efd"
      //   });
      //   paginateButtons.filter(".disabled").css({
      //     "background-color": isDark ? "#1f1f1f" : "#f8f9fa",
      //     "border-color": isDark ? "#333" : "#dee2e6",
      //     color: isDark ? "#555" : "#ccc"
      //   });
      // }
      function applyPaginationTheme(isDark) {
        if (!table) return;
        const paginateButtons = $(table.table().container()).find(".dataTables_paginate .paginate_button");
        if (isDark) {
          // ลบ Class ที่เป็นสีสว่างออก และจัดการผ่าน CSS ที่เราเขียนเพิ่ม
          paginateButtons.removeClass("btn-light").css({
            "background-image": "none", // ลบ gradient พื้นฐานของ DataTables
            "box-shadow": "none"
          });
        } else {
          // โหมดปกติ (Light Mode)
          paginateButtons.addClass("btn-light");
          paginateButtons.filter(".current").css({
            "background-color": "#0d6efd",
            "color": "#fff"
          });
        }
      }

      function initEventHandlers() {
        // เรียกใช้เมื่อมีการเปลี่ยนค่า
        $(".room-filter").on("change", updateLabelColors);
        // เรียกใช้ครั้งแรกตอนโหลดหน้า
        updateLabelColors();
        const savedUnit = localStorage.getItem("selectedOperatingUnit");
        if (savedUnit) $('#unitFilter').val(savedUnit);
        $('#unitFilter').on('change', function() {
          const selectedUnit = $(this).val();
          localStorage.setItem("selectedOperatingUnit", selectedUnit);
          if (selectedUnit === "") table.column(5).search("").draw();
          else table.column(5).search('^' + selectedUnit + '$', true, false).draw();
          applyRoomFilter(false);
        });
        $('#statusFilter').on('change', function() {
          const selectedStatus = $(this).val();
          localStorage.setItem("selectedStatus", selectedStatus);
          // Column 6 คือ Status (นับจาก 0)
          if (selectedStatus === "") {
            table.column(6).search("").draw();
          } else {
            // ใช้ Regex เพื่อหาคำที่ตรงกันเป๊ะๆ
            table.column(6).search('^' + selectedStatus + '$', true, false).draw();
          }
        });
        $('#statusFilter').on('change', function() {
          const selectedStatus = $(this).val();
          localStorage.setItem("selectedStatus", selectedStatus);
          // 1. กรองตาราง (Table)
          if (selectedStatus === "") {
            table.column(6).search("").draw();
          } else {
            table.column(6).search('^' + selectedStatus + '$', true, false).draw();
          }
          // 2. กรองปฏิทิน (Calendar) <-- เพิ่มบรรทัดนี้
          applyRoomFilter(false);
        });
        const rangeConfig = {
          dateFormat: "Y-m-d",
          defaultDate: function() {
            return localStorage.getItem(this.element.id) || null;
          },
          onChange: function(selectedDates, dateStr, instance) {
            localStorage.setItem(instance.element.id, dateStr);
            table.draw();
          }
        };
        flatpickr("#tableFilterStart", rangeConfig);
        flatpickr("#tableFilterEnd", rangeConfig);
        $("#sidebarToggle").on("click", function() {
          isSidebarCollapsed = !isSidebarCollapsed;
          localStorage.setItem("isSidebarCollapsed", isSidebarCollapsed);
          applySidebarState(isSidebarCollapsed);
          setTimeout(() => {
            calendar.updateSize();
            miniCal.updateSize();
          }, 300);
        });
        $("#nav-profile-theme").on("click", function(e) {
          e.preventDefault();
          darkMode = !darkMode;
          localStorage.setItem("darkMode", darkMode);
          applyTheme(darkMode);
          updateDatatableButtonTheme(darkMode);
          if (table) applyPaginationTheme(darkMode);
        });
        $("#carMenu").on("hidden.bs.collapse", function() {
          localStorage.setItem(CAR_MENU_STATE, "false");
        });
        $("#carMenu").on("shown.bs.collapse", function() {
          localStorage.setItem(CAR_MENU_STATE, "true");
        });
        $("#meetingMenu").on("hidden.bs.collapse", function() {
          localStorage.setItem(MEETING_MENU_STATE, "false");
        });
        $("#meetingMenu").on("shown.bs.collapse", function() {
          localStorage.setItem(MEETING_MENU_STATE, "true");
        });
        $("#sidebarMenu .nav-link").on("click", function(e) {
          e.preventDefault();
          $("#sidebarMenu .nav-link").removeClass("active").removeAttr("aria-current");
          $(this).addClass("active").attr("aria-current", "page");
          localStorage.setItem(ACTIVE_MENU_KEY, this.id);
        });
        $(".navbar-nav .dropdown-item").on("click", function(e) {
          e.preventDefault();
          const clickedId = $(this).attr("id");
          $(".navbar-nav .nav-link, .navbar-nav .dropdown-item").removeClass("active");
          $(this).addClass("active");
          $(this).closest(".dropdown").find(".dropdown-toggle").first().addClass("active");
          $(this).closest(".dropend").find(".dropdown-item.dropdown-toggle").addClass("active");
          localStorage.setItem(NAVBAR_ACTIVE_KEY, clickedId);
        });
        $(".dropend").on("mouseenter", function() {
          var $menu = $(this).find(".dropdown-menu");
          $menu.addClass("show");
          if ($menu.offset().left + $menu.width() > $(window).width()) $menu.removeClass("dropdown-menu-end")
            .addClass("dropdown-menu-start");
        }).on("mouseleave", function() {
          var $menu = $(this).find(".dropdown-menu");
          $menu.removeClass("show").removeClass("dropdown-menu-start").addClass("dropdown-menu-end");
        });
        $(".room-filter").on("change", function() {
          applyRoomFilter(false);
          filterDataTableByRooms();
          saveRoomFilterState();
        });
        $("#bookingForm").on("submit", handleBookingSubmit);
        $("#toggleTable").on("click", function() {
          const tableWrapper = $("#tableWrapper");
          const newState = !tableWrapper.is(":visible");
          applyTableVisibility(newState);
          localStorage.setItem("isTableVisible", newState);
          if (newState) table.draw(false);
        });
        $('#btnResetFilters').on('click', function() {
          localStorage.removeItem("selectedOperatingUnit");
          localStorage.removeItem("roomFilterStates");
          // --- เพิ่มใหม่: ล้างค่า Status ---
          localStorage.removeItem("selectedStatus");
          $('#statusFilter').val("");
          table.column(6).search("");
          // ----------------------------
          $('#unitFilter').val("");
          $(".room-filter").prop("checked", true);
          table.column(5).search("");
          localStorage.removeItem("tableFilterStart");
          localStorage.removeItem("tableFilterEnd");
          $('#tableFilterStart').val('');
          $('#tableFilterEnd').val('');
          applyRoomFilter(true);
          table.draw();
        });
      }

      function filterDataTableByRooms() {
        let selectedRooms = $(".room-filter:checked").map(function() {
          return this.value;
        }).get();
        let searchVal = selectedRooms.length === 0 ? "^$" : "^(" + selectedRooms.map(r => r.replace(
          /[-\/\\^$*+?.()|[\]{}]/g, "\\$&")).join("|") + ")$";
        table.column(0).search(searchVal, true, false).draw();
      }

      function restoreOperatingUnitDropdown() {
        const savedUnit = localStorage.getItem("selectedOperatingUnit");
        if (savedUnit !== null) {
          $('#unitFilter').val(savedUnit);
        }
      }

      function applyRoomFilter(updateTable = true) {
        let selectedRooms = $(".room-filter:checked").map(function() {
          return this.value;
        }).get();
        let selectedUnit = $('#unitFilter').val();
        let selectedStatus = $('#statusFilter').val();
        localStorage.setItem("selectedOperatingUnit", selectedUnit);
        localStorage.setItem("selectedStatus", selectedStatus);
        localStorage.setItem("selectedRoomFilters", JSON.stringify(selectedRooms));
        const filterFunc = (evt) => {
          const eventRoom = evt.extendedProps.room;
          const eventUnit = evt.extendedProps.operating_unit;
          const eventStatus = evt.extendedProps.status;
          // return selectedRooms.includes(eventRoom) && (selectedUnit === "" || eventUnit === selectedUnit) ?
          //   "auto" : "none";
          const isRoomMatch = selectedRooms.includes(eventRoom);
          const isUnitMatch = (selectedUnit === "" || eventUnit === selectedUnit);
          const isStatusMatch = (selectedStatus === "" || eventStatus === selectedStatus); // <--- 4. เทียบ Status
          // ถ้าตรงทุกเงื่อนไขให้แสดง (auto) ถ้าไม่ให้ซ่อน (none)
          return (isRoomMatch && isUnitMatch && isStatusMatch) ? "auto" : "none";
        };
        if (calendar) calendar.getEvents().forEach((evt) => evt.setProp("display", filterFunc(evt)));
        if (miniCal) miniCal.getEvents().forEach((evt) => evt.setProp("display", filterFunc(evt)));
        if (updateTable && table) {
          let roomSearchVal = selectedRooms.length === 0 ? "^$" : "^(" + selectedRooms.map(r => r.replace(
            /[-\/\\^$*+?.()|[\]{}]/g, "\\$&")).join("|") + ")$";
          table.column(0).search(roomSearchVal, true, false);
          if (selectedUnit === "") table.column(5).search("");
          else table.column(5).search('^' + selectedUnit.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&") + '$', true,
            false);
          if (selectedStatus === "") table.column(6).search("");
          else table.column(6).search('^' + selectedStatus.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&") + '$', true,
            false);
          table.draw();
        }
      }

      function restoreCalendarFilters() {
        const selectedUnit = localStorage.getItem("selectedOperatingUnit") || "";
        const startRange = localStorage.getItem("tableFilterStart");
        const endRange = localStorage.getItem("tableFilterEnd");
        const isInRange = (dateStr) => {
          if (!dateStr) return false;
          const d = dateStr.substring(0, 10);
          if (startRange && d < startRange) return false;
          if (endRange && d > endRange) return false;
          return true;
        };
        const applyFilter = (evt) => {
          const unitMatch =
            selectedUnit === "" ||
            evt.extendedProps.operating_unit === selectedUnit;
          const dateMatch =
            isInRange(evt.startStr) || isInRange(evt.endStr);
          return unitMatch && dateMatch ? "auto" : "none";
        };
        if (calendar) {
          calendar.getEvents().forEach(evt => {
            evt.setProp("display", applyFilter(evt));
          });
        }
        if (miniCal) {
          miniCal.getEvents().forEach(evt => {
            evt.setProp("display", applyFilter(evt));
          });
        }
      }

      // ค้นหาฟังก์ชัน handleBookingSubmit เดิม แล้วเปลี่ยนเป็นโค้ดนี้
      function handleBookingSubmit(e) {
          e.preventDefault();
          
          // ดึงข้อมูลทั้งหมดในฟอร์มมาใส่ตัวแปร formData
          const formData = new FormData(e.target);
          const submitBtn = document.getElementById('btnSubmitBooking');
          
          // (Optional) ปิดปุ่มกดกันเบิ้ล
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';

          // ใช้ fetch เพื่อส่งข้อมูลไปที่ save_booking.php
          fetch('save_booking.php', {
              method: 'POST',
              body: formData
          })
          .then(response => response.json())
          .then(data => {
              if (data.success) {
                  // กรณีสำเร็จ
                  alert(data.message); // หรือใช้ SweetAlert แทนจะสวยกว่า
                  
                  // ปิด Modal
                  bootstrap.Modal.getInstance(document.getElementById("bookingModal")).hide();
                  
                  // เคลียร์ค่าในฟอร์ม
                  $("#bookingForm")[0].reset();
                  
                  // รีโหลดข้อมูลในตารางและปฏิทินใหม่ (โดยไม่ต้องรีเฟรชหน้าเว็บ)
                  if(table) table.ajax.reload(null, false);
                  if(calendar) calendar.refetchEvents();
                  if(miniCal) miniCal.refetchEvents();
                  
              } else {
                  // กรณีไม่สำเร็จ (เช่น กรอกไม่ครบ หรือ Database Error)
                  alert('เกิดข้อผิดพลาด: ' + data.message);
              }
          })
          .catch(error => {
              console.error('Error:', error);
              alert('ไม่สามารถเชื่อมต่อกับ Server ได้');
          })
          .finally(() => {
              // เปิดปุ่มให้กดได้เหมือนเดิม
              submitBtn.disabled = false;
              submitBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Confirm Booking';
          });
      }

      // function handleBookingSubmit(e) {
      //   e.preventDefault();
      //   const formData = new FormData(e.target);
      //   const bookingData = Object.fromEntries(formData.entries());
      //   alert(`จองห้อง "${bookingData.room}" สำเร็จ! (Title: ${bookingData.title})`);
      //   bootstrap.Modal.getInstance(document.getElementById("bookingModal")).hide();
      //   $("#bookingForm")[0].reset();
      //   table.ajax.reload(function() {
      //     calendar.refetchEvents();
      //     miniCal.refetchEvents();
      //     filterDataTableByRooms();
      //     applyRoomFilter(false);
      //   }, false);
      //   // เพิ่มโค้ดนี้เพื่อให้สี Modal เปลี่ยนตามค่า Default (Meeting 1) ทันทีที่เปิด
      //   $('#bookingModal').on('shown.bs.modal', function() {
      //     const defaultRoom = $('#roomSelector').val();
      //     if (defaultRoom) {
      //       applyModalTheme(defaultRoom);
      //     }
      //   });
      // }

//       $("#viewBookingForm").on("submit", function(e) {
//     e.preventDefault();
//     // ใส่ Logic การแก้ไขข้อมูลตรงนี้
//     alert("แก้ไขข้อมูลสำเร็จ");
// });
      // document.getElementById("currentYear").textContent = new Date().getFullYear();
      // document.getElementById("currentTime").textContent = new Date().toLocaleTimeString("th-TH", {
      //     hour: "2-digit",
      //     minute: "2-digit",
      //     second: "2-digit"
      //   });
    });
  </script>

</body>

</html>