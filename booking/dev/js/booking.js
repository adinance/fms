document.addEventListener("DOMContentLoaded", function () {
  const roomColors = {
    "Meeting 1": "#0d6efd",
    "Meeting 2": "#198754",
    "Meeting 3": "#fd7e14",
    "Training Room 1 (Floor 3)": "#6f42c1",
    "Training Room 3 (Floor 1)": "#dc3545",
    "ห้องปูน (Floor 3)": "#20c997",
  };
  let darkMode = localStorage.getItem("darkMode") === "true";
  let isTableVisible = localStorage.getItem("isTableVisible") !== "false";
  let isSidebarCollapsed =
    localStorage.getItem("isSidebarCollapsed") === "true";
  const ACTIVE_MENU_KEY = "activeMenuId";
  const NAVBAR_ACTIVE_KEY = "navbarActiveId";
  const CAR_MENU_STATE = "carMenuState";
  const MEETING_MENU_STATE = "meetingMenuState";
  let calendar, miniCal, table;
  const DATA_URL = "data.json";

  // 🚩 Initializations
  initTheme();
  initSidebar();
  loadCollapseMenuState();
  initActiveMenu();
  initNavbarActiveMenu();
  initPickers();
  initCalendars();
  initTable();
  initEventHandlers();
  const getStartDay = (datetime) => (datetime ? datetime.substring(0, 10) : "");

  function initNavbarActiveMenu() {
    const defaultNavbarId = "nav-report-current-year";
    let activeNavbarId =
      localStorage.getItem(NAVBAR_ACTIVE_KEY) || defaultNavbarId;
    $(".navbar-nav .nav-link, .navbar-nav .dropdown-item").removeClass(
      "active"
    );
    if (activeNavbarId) {
      const activeLink = $(`#${activeNavbarId}`);
      if (activeLink.length) {
        activeLink.addClass("active");
        const parentDropdownToggle = activeLink
          .closest(".dropdown")
          .find(".dropdown-toggle")
          .first();
        if (parentDropdownToggle.length) {
          parentDropdownToggle.addClass("active");
        }
        const dropendToggle = activeLink
          .closest(".dropend")
          .find(".dropdown-item.dropdown-toggle");
        if (dropendToggle.length) {
          dropendToggle.addClass("active");
        }
      }
    }
  }

  function initActiveMenu() {
    const defaultMenuId = "menu-meeting-calendar";
    let activeMenuId = localStorage.getItem(ACTIVE_MENU_KEY) || defaultMenuId;
    $("#sidebarMenu .nav-link")
      .removeClass("active")
      .removeAttr("aria-current");
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
      } else if (savedState === "true") {
        menu.addClass("show");
        toggle.removeClass("collapsed");
        toggle.attr("aria-expanded", "true");
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
    $(".room-filter").each(function () {
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
        $(".room-filter").each(function () {
          const roomName = $(this).val();
          const isChecked = roomStates.hasOwnProperty(roomName)
            ? roomStates[roomName]
            : true;
          $(this).prop("checked", isChecked);
          if (isChecked) {
            selectedRooms.push(roomName);
          }
        });
      } catch (e) {
        console.error(
          "Error parsing room filter states from Local Storage:",
          e
        );
        localStorage.removeItem("roomFilterStates");
        shouldSaveDefaultState = true;
      }
    }
    if (!savedRoomStates || shouldSaveDefaultState) {
      $(".room-filter").prop("checked", true);
      selectedRooms = $(".room-filter")
        .map(function () {
          return this.value;
        })
        .get();
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
      if (profileThemeText)
        profileThemeText.textContent = "Switch to Light Mode";
    } else {
      body.classList.add("light-mode");
      body.classList.remove("dark-mode");
      $(".dark-mode-logo").css("display", "none");
      $(".light-mode-logo").css("display", "inline-block");
      if (profileThemeIcon) profileThemeIcon.className = "bi bi-moon me-2";
      if (profileThemeText)
        profileThemeText.textContent = "Switch to Dark Mode";
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
    // ใช้งานสำหรับช่อง 'เวลาเริ่ม' และ 'เวลาสิ้นสุด' แทน
    const flatpickrConfig = {
      enableTime: true,
      // ✅ เปลี่ยนเป็นรูปแบบ YYYY-MM-DD HH:MM:SS
      dateFormat: "Y-m-d H:i",
      // เปิดใช้ปฏิทิน
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
    // ใช้ config เดียวกันสำหรับ Start Time
    flatpickr("#start_time", flatpickrConfig);
    // ใช้ config เดียวกันสำหรับ End Time
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
    
    // จัดรูปแบบวันที่และเวลา: วัน/เดือน/ปี ชม:นาที
    const formatDateTime = (dateTimeStr) => {
        if (!dateTimeStr) return "-";
        const dateObj = new Date(dateTimeStr);
        const d = dateObj.toLocaleDateString('th-TH', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
        const t = dateTimeStr.substring(11, 16); // ดึงเฉพาะ ชม:นาที (HH:mm)
        return `${d} ${t}`;
    };

    const startDisplay = formatDateTime(data.start);
    const endDisplay = formatDateTime(data.end);

    const highlightColor = roomColors[data.room] || "#6c757d";
    const modalBody = document.querySelector("#detailModal .modal-body");
    
    modalBody.innerHTML = `
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-12 border-bottom pb-3 mb-2">
                    <h5 style="color: ${highlightColor};" class="mb-1 fw-bold">
                        <i class="bi bi-bookmark-fill me-2"></i>${data.title.replace(` (${data.room})`, '') || "Untitled Meeting"}
                    </h5>
                    <p class="mb-0 small ${isDarkMode ? 'text-light' : 'text-muted'}">
                        <strong class="${isDarkMode ? 'text-white' : ''}">Subject:</strong> ${data.subject || "No subject provided"}
                    </p>
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
                    <label class="small d-block text-uppercase fw-bold ${isDarkMode ? 'text-white-50' : 'text-muted'}">Booked Timestamp</label>
                    <span class="small ${isDarkMode ? 'text-light' : 'text-secondary'}"><i class="bi bi-cpu me-2"></i>${data.booked_time || "-"}</span>
                </div>

                <div class="col-12 mt-3">
                    <div class="p-3 rounded border shadow-sm" style="background-color: ${isDarkMode ? '#2a2a2a' : 'rgba(0,0,0,0.03)'}; border-left: 5px solid ${highlightColor} !important;">
                        <label class="small d-block text-uppercase fw-bold mb-1 ${isDarkMode ? 'text-white-50' : 'text-muted'}">Note / Description</label>
                        <div class="small ${isDarkMode ? 'text-white' : 'text-dark'}" style="white-space: pre-wrap;">${data.note || "No additional notes."}</div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    new bootstrap.Modal(document.getElementById("detailModal")).show();
}


  function initCalendars() {
    const initialRooms = loadRoomFilterState();
    const eventSourceConfig = {
      url: DATA_URL,
      method: "GET",
      failure: function () {
        console.error("Failed to fetch events from data.json");
      },
      success: function (rawEvents) {
        const events = rawEvents.map(mapEventData);
        const selectedRooms =
          initialRooms.length > 0
            ? initialRooms
            : $(".room-filter:checked")
                .map(function () {
                  return this.value;
                })
                .get();
        return events.map((evt) => {
          const isVisible = selectedRooms.includes(evt.extendedProps.room);
          evt.display = isVisible ? "auto" : "none";
          return evt;
        });
      },
    };
    const isMobile = window.matchMedia("(max-width: 768px)").matches;
    const mainHeaderToolbar = isMobile
      ? {
          left: "prev,next",
          right:
            "dayGridMonth,timeGridWeek,timeGridDay,listMonth,multiMonthYear",
        }
      : {
          left: "prev,next today",
          center: "title",
          right:
            "dayGridMonth,timeGridWeek,timeGridDay,listMonth,multiMonthYear",
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
        multiMonthYear: "Annual",
      },
      timeZone: "local",
      views: {
        dayGridMonth: {
          titleFormat: {
            month: "long",
          },
        },
      },
      events: eventSourceConfig,
      eventClick: showEventDetails,
    });
    const miniHeaderToolbar = isMobile
      ? {
          left: "prev",
          center: "title",
          right: "next",
        }
      : {
          left: "prev",
          center: "title",
          right: "next",
        };
    miniCal = new FullCalendar.Calendar(
      document.getElementById("miniCalendar"),
      {
        initialView: "dayGridMonth",
        height: "auto",
        contentHeight: "auto",
        expandRows: true,
        headerToolbar: miniHeaderToolbar,
        events: eventSourceConfig,
        eventClick: showEventDetails,
        selectable: true,
        dateClick: (info) => calendar.gotoDate(info.dateStr),
      }
    );
    calendar.render();
    miniCal.render();
  }

  function initTable() {
    const initialRooms = loadRoomFilterState();
    applyRoomFilter(false);
    table = $("#bookingTable").DataTable({
      dom:
        '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex align-items-center justify-content-end"fB>>' +
        '<"row spacer-row">' +
        '<"row"<"col-sm-12"t>>' +
        '<"row spacer-row">' +
        '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
      initComplete: function () {
        $(this.api().table().container()).find(".dt-buttons").css({
          "margin-left": "15px",
          "margin-bottom": "0",
        });
        $(this.api().table().container()).find(".dataTables_filter").css({
          "margin-right": "0",
          "margin-bottom": "0",
        });
        updateDatatableButtonTheme(darkMode);
      },
      buttons: [
        {
          extend: "copyHtml5",
          text: '<i class="bi bi-files"></i>',
          className: "btn btn-light btn-sm",
          exportOptions: {
            columns: ":visible",
          },
        },
        {
          extend: "excelHtml5",
          text: '<i class="bi bi-file-earmark-excel"></i>',
          className: "btn btn-light btn-sm",
          exportOptions: {
            columns: ":visible",
          },
        },
        {
          extend: "csvHtml5",
          text: '<i class="bi bi-filetype-csv"></i>',
          className: "btn btn-light btn-sm",
          exportOptions: {
            columns: ":visible",
          },
        },
        {
          extend: "print",
          text: '<i class="bi bi-printer"></i>',
          className: "btn btn-light btn-sm",
          exportOptions: {
            columns: ":visible",
          },
        },
      ],
      ajax: {
        url: DATA_URL,
        dataSrc: "",
      },
      columns: [
        {
          data: "room",
        },
        {
          data: "title",
        },
        {
          data: "start",
          render: function (data, type) {
            if (!data) return "";

            // ให้ DataTables ใช้ค่าเดิมตอน sort / filter
            if (type === "sort" || type === "type") {
              return data;
            }

            const d = new Date(data.replace(" ", "T"));

            const day = String(d.getDate()).padStart(2, "0");
            const month = String(d.getMonth() + 1).padStart(2, "0");
            const year = d.getFullYear();
            const hour = String(d.getHours()).padStart(2, "0");
            const min = String(d.getMinutes()).padStart(2, "0");

            return `${day}/${month}/${year} ${hour}:${min}`;
          },
        },
        {
          data: "end",
          render: function (data, type) {
            if (!data) return "";

            // ให้ DataTables ใช้ค่าเดิมตอน sort / filter
            if (type === "sort" || type === "type") {
              return data;
            }

            const d = new Date(data.replace(" ", "T"));

            const day = String(d.getDate()).padStart(2, "0");
            const month = String(d.getMonth() + 1).padStart(2, "0");
            const year = d.getFullYear();
            const hour = String(d.getHours()).padStart(2, "0");
            const min = String(d.getMinutes()).padStart(2, "0");

            return `${day}/${month}/${year} ${hour}:${min}`;
          },
        },
        {
          data: "booked_by",
        },
        {
          data: "operating_unit",
        },
      ],
      stateSave: true,
    });
    applyTableVisibility(isTableVisible);
    table.on("init", function () {
      let searchVal;
      if (initialRooms.length === 0) {
        searchVal = "^$";
      } else {
        const escapedRooms = initialRooms.map((room) => {
          return room.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
        });
        searchVal = "^(" + escapedRooms.join("|") + ")$";
      }
      table.column(0).search(searchVal, true, false).draw();
    });
    // 🚩 Apply theme on every draw (e.g., page change, sort)
    table.on("draw.dt", function () {
      applyPaginationTheme(darkMode);
    });
  }

  function updateDatatableButtonTheme(isDark) {
    if (!table) return;
    const exportButtons = table.buttons().containers().find(".btn");
    if (isDark) {
      exportButtons.removeClass("btn-light").addClass("btn-dark");
    } else {
      exportButtons.removeClass("btn-dark").addClass("btn-light");
    }
    applyPaginationTheme(isDark);
  }

  function applyPaginationTheme(isDark) {
    if (!table) return;
    const paginateButtons = $(table.table().container()).find(
      ".dataTables_paginate .paginate_button"
    );
    paginateButtons.removeClass("btn-light btn-dark btn-sm");
    paginateButtons.addClass("btn btn-sm");
    if (isDark) {
      paginateButtons.addClass("btn-dark");
      // DataTables Bootstrap CSS handles the .current and .disabled state
    } else {
      paginateButtons.addClass("btn-light");
      // DataTables Bootstrap CSS handles the .current and .disabled state
      // We ensure current button gets the primary look in light mode
      paginateButtons.filter(".current").css({
        "background-color": "#0d6efd",
        "border-color": "#0d6efd",
        color: "#fff",
      });
    }
    // Apply standard non-active styling (mainly for light mode border consistency)
    paginateButtons.not(".current").css({
      "background-color": isDark ? "#2a2a2a" : "transparent",
      "border-color": isDark ? "#555" : "#dee2e6",
      color: isDark ? "#ddd" : "#0d6efd",
    });
    // Handle Disabled buttons (in-line override for better contrast in both themes)
    paginateButtons.filter(".disabled").css({
      "background-color": isDark ? "#1f1f1f" : "#f8f9fa",
      "border-color": isDark ? "#333" : "#dee2e6",
      color: isDark ? "#555" : "#ccc",
    });
  }

  function initEventHandlers() {
    $("#sidebarToggle").on("click", function () {
      isSidebarCollapsed = !isSidebarCollapsed;
      localStorage.setItem("isSidebarCollapsed", isSidebarCollapsed);
      applySidebarState(isSidebarCollapsed);
      setTimeout(() => {
        calendar.updateSize();
        miniCal.updateSize();
      }, 300);
    });
    $("#nav-profile-theme").on("click", function (e) {
      e.preventDefault();
      darkMode = !darkMode;
      localStorage.setItem("darkMode", darkMode);
      applyTheme(darkMode);
      // Update DataTable theme and redraw pagination immediately
      updateDatatableButtonTheme(darkMode);
      if (table) {
        applyPaginationTheme(darkMode);
      }
    });
    $("#carMenu").on("hidden.bs.collapse", function () {
      localStorage.setItem(CAR_MENU_STATE, "false");
    });
    $("#carMenu").on("shown.bs.collapse", function () {
      localStorage.setItem(CAR_MENU_STATE, "true");
    });
    $("#meetingMenu").on("hidden.bs.collapse", function () {
      localStorage.setItem(MEETING_MENU_STATE, "false");
    });
    $("#meetingMenu").on("shown.bs.collapse", function () {
      localStorage.setItem(MEETING_MENU_STATE, "true");
    });
    $("#sidebarMenu .nav-link").on("click", function (e) {
      e.preventDefault();
      $("#sidebarMenu .nav-link")
        .removeClass("active")
        .removeAttr("aria-current");
      $(this).addClass("active").attr("aria-current", "page");
      localStorage.setItem(ACTIVE_MENU_KEY, this.id);
    });
    $(".navbar-nav .dropdown-item").on("click", function (e) {
      e.preventDefault();
      const clickedId = $(this).attr("id");
      $(".navbar-nav .nav-link, .navbar-nav .dropdown-item").removeClass(
        "active"
      );
      $(this).addClass("active");
      const parentDropdownToggle = $(this)
        .closest(".dropdown")
        .find(".dropdown-toggle")
        .first();
      parentDropdownToggle.addClass("active");
      const dropendToggle = $(this)
        .closest(".dropend")
        .find(".dropdown-item.dropdown-toggle");
      dropendToggle.addClass("active");
      localStorage.setItem(NAVBAR_ACTIVE_KEY, clickedId);
    });
    // Dropdown Sub-menu on Hover (for desktop)
    $(".dropend")
      .on("mouseenter", function () {
        var $el = $(this);
        var $menu = $el.find(".dropdown-menu");
        $menu.addClass("show");
        if ($menu.offset().left + $menu.width() > $(window).width()) {
          $menu
            .removeClass("dropdown-menu-end")
            .addClass("dropdown-menu-start");
        }
      })
      .on("mouseleave", function () {
        var $el = $(this);
        var $menu = $el.find(".dropdown-menu");
        $menu.removeClass("show");
        $menu.removeClass("dropdown-menu-start").addClass("dropdown-menu-end");
      });
    $(".room-filter").on("change", function () {
      applyRoomFilter(false);
      filterDataTableByRooms();
      saveRoomFilterState();
    });
    $("#bookingForm").on("submit", handleBookingSubmit);
    $("#toggleTable").on("click", function () {
      const tableWrapper = $("#tableWrapper");
      const newState = !tableWrapper.is(":visible");
      applyTableVisibility(newState);
      localStorage.setItem("isTableVisible", newState);
      if (newState) {
        table.draw(false);
      }
    });
  }

  function filterDataTableByRooms() {
    let selectedRooms = $(".room-filter:checked")
      .map(function () {
        return this.value;
      })
      .get();
    let searchVal;
    if (selectedRooms.length === 0) {
      searchVal = "^$";
    } else {
      const escapedRooms = selectedRooms.map((room) => {
        return room.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&");
      });
      searchVal = "^(" + escapedRooms.join("|") + ")$";
    }
    table.column(0).search("");
    table.column(0).search(searchVal, true, false).draw();
  }

  function applyRoomFilter(updateTable = true) {
    let selectedRooms = $(".room-filter:checked")
      .map(function () {
        return this.value;
      })
      .get();
    const filterFunc = (evt) =>
      selectedRooms.includes(evt.extendedProps.room) ? "auto" : "none";
    calendar
      .getEvents()
      .forEach((evt) => evt.setProp("display", filterFunc(evt)));
    miniCal
      .getEvents()
      .forEach((evt) => evt.setProp("display", filterFunc(evt)));
    if (updateTable) {
      filterDataTableByRooms();
    }
  }

  function handleBookingSubmit(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const bookingData = Object.fromEntries(formData.entries());
    console.log("New Booking Data Submitted (Simulated):", bookingData);
    alert(
      `จองห้อง "${bookingData.room}" สำเร็จ! (Title: ${bookingData.title})`
    );
    bootstrap.Modal.getInstance(document.getElementById("bookingModal")).hide();
    $("#bookingForm")[0].reset();
    table.ajax.reload(function () {
      calendar.refetchEvents();
      miniCal.refetchEvents();
      calendar.gotoDate(bookingData.meeting_date);
      filterDataTableByRooms();
    }, false);
  }
  // ตั้งค่าปีปัจจุบันและเวลาเข้าใช้งานครั้งล่าสุดใน Footer
  document.getElementById("currentYear").textContent = new Date().getFullYear();
  document.getElementById("currentTime").textContent =
    new Date().toLocaleTimeString("th-TH", {
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
    });
});
