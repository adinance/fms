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

        /* กำหนดให้ HTML และ Body ใช้พื้นที่ 100% ของ Viewport */
        html, body {
            height: 100%;
        }
        
        body {
            font-family: var(--font-main);
            transition: background-color 0.3s, color 0.3s;
            display: flex; /* ใช้ flex จัดวาง Navbar และ Main Layout */
            flex-direction: column; 
        }

        a { text-decoration: none !important; }
        
        /* Main Layout: ใช้พื้นที่ที่เหลือทั้งหมด และจัดวาง Sidebar/Content แบบ Row */
        #mainLayout {
            flex-grow: 1;
            overflow: hidden; 
        }

        /* --- Sidebar Styles --- */
        #sidebarMenu {
            width: 280px; /* ความกว้างเริ่มต้น */
            transition: width 0.3s ease, margin 0.3s ease;
            overflow-x: hidden; /* ซ่อนเนื้อหาที่เกินมาเมื่อย่อ */
            flex-shrink: 0; 
            overflow-y: auto; /* ให้เลื่อนได้เฉพาะ Sidebar ถ้าเมนูเยอะ */
        }
        
        #sidebarMenu .nav-link {
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
            padding-left: 0.5rem;
        }
        
        #sidebarMenu .nav-link i {
            margin-right: 8px;
            width: 20px; 
            text-align: center;
        }

        /* สไตล์สำหรับปุ่มหัวข้อ Collapse */
        #sidebarMenu .collapsed-toggle {
            cursor: pointer;
            font-size: 1rem; 
            font-weight: 600; /* ทำให้หัวข้อดูหนาขึ้น */
            color: var(--text-light);
            border-bottom: 1px solid #ccc; 
            padding-top: 5px;
            padding-bottom: 5px;
            margin-top: 5px;
        }
        
        /* หมุนไอคอน Chevron เมื่อเมนูยุบ */
        #sidebarMenu .collapsed-toggle .toggle-icon {
            transition: transform 0.3s ease;
        }

        #sidebarMenu .collapsed-toggle.collapsed .toggle-icon {
            transform: rotate(-90deg);
        }

        /* Sidebar Collapsed State (สำหรับเมนูหลัก) */
        #sidebarMenu.collapsed {
            width: 60px !important; /* ความกว้างเมื่อย่อ */
        }

        #sidebarMenu.collapsed .nav-link {
            padding: 0.5rem 0.5rem;
        }
        
        #sidebarMenu.collapsed .nav-link i {
             margin-right: 0;
        }
        
        /* ซ่อนข้อความ, Label และเส้นคั่นใน Sidebar เมื่อย่อหลัก */
        #sidebarMenu.collapsed .nav-link span,
        #sidebarMenu.collapsed .collapsed-toggle span, /* ซ่อนข้อความหัวข้อ */
        #sidebarMenu.collapsed .collapsed-toggle .toggle-icon, /* ซ่อนไอคอน Chevron */
        #sidebarMenu.collapsed .sidebar-label,
        #sidebarMenu.collapsed hr {
            display: none;
        }

        /* ปรับปุ่ม Toggle เมื่อย่อ */
        #sidebarMenu.collapsed #sidebarToggle i {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
        #sidebarMenu #sidebarToggle i {
            transition: transform 0.3s ease;
        }
        
        /* Main Content */
        #mainContent {
             overflow-y: auto; /* ให้เนื้อหาหลักเลื่อนได้ */
        }

        /* CSS สำหรับ Dropdown ซ้อน Dropdown (Sub-Dropdown) */
        .dropdown-menu .dropend .dropdown-toggle {
            padding-right: 1.5rem; 
        }

        .dropdown-menu .dropend .dropdown-menu {
            position: absolute;
            left: 100%; 
            top: 0;
            margin-left: 0.1rem;
            margin-right: 0.1rem;
        }
        
        /* ... (Mini Calendar specific styles - kept for layout) ... */
        #miniCalendar { max-width: 100%; margin: 20px auto; font-size: 12px !important; }
        #miniCalendar .fc-scroller { overflow: visible !important; }
        #miniCalendar .fc-daygrid-body { max-height: none !important; }
        #miniCalendar .fc-daygrid-body-unbalanced .fc-daygrid-day-events { min-height: 0 !important; }
        #miniCalendar .fc-daygrid-day-frame { padding: 3px !important; }
        #miniCalendar .fc-toolbar-title { font-size: 15px !important; font-weight: 600; }

        /* --- FAB Button styles --- */
        .fab {
            position: fixed;
            right: 30px;
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
            z-index: 1000;
        }

        .fab-add { 
            bottom: 30px; 
            background-color: #0d6efd;
            font-size: 30px;
        }
        .fab-add:hover { background-color: #0b5ed7; }
        
        #themeToggle {
            background-color: #6c757d;
            font-size: 20px;
            bottom: 100px;
        }
        #themeToggle:hover { background-color: #495057; }
        
        #toggleTable {
            background-color: #007bff; 
            font-size: 20px;
            bottom: 170px; 
        }
        #toggleTable:hover { background-color: #0056b3; }


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
        
        body.light-mode .nav-link { color: #000; }
        body.light-mode #sidebarMenu { background-color: #f8f9fa !important; }
        body.light-mode .navbar { background-color: #f8f9fa !important; }
        body.light-mode #sidebarMenu .collapsed-toggle { color: #000; border-bottom-color: #ccc; }

        /* Light Mode: เน้นพื้นหลัง Navbar Active Menu */
        body.light-mode .navbar-nav .nav-link.active {
            background-color: #e9ecef !important; 
            color: #0d6efd !important; 
            border-radius: 6px; 
        }

        /* Light Mode: เน้นพื้นหลัง Sidebar Active Menu */
        body.light-mode #sidebarMenu .nav-link.active {
            background-color: #0d6efd !important; /* สีน้ำเงินหลัก */
            color: #fff !important; 
            border-radius: 6px;
        }
        
        /* Light Mode Dropdown Item Styles */
        body.light-mode .dropdown-menu .dropdown-item.active {
            background-color: #0d6efd !important; /* สีน้ำเงินหลัก */
            color: #fff !important;
        }


        body.light-mode .fc-day-today { background-color: #e9ecef !important; border-radius: 50%; }
        body.light-mode .fc-col-header-cell { background-color: #f8f9fa !important; color: #000 !important; }

        /* --- Dark Mode Styles --- */
        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }
        
        /* Dark Mode for Navbar and Sidebar */
        body.dark-mode .navbar,
        body.dark-mode #sidebarMenu {
            background-color: var(--card-dark) !important;
            border-color: var(--border-dark) !important;
        }
        
        body.dark-mode .navbar-brand,
        body.dark-mode .nav-link {
            color: var(--text-dark) !important;
        }
        
        body.dark-mode #sidebarMenu .collapsed-toggle {
            color: var(--text-dark);
            border-bottom-color: var(--border-dark);
        }

        /* MODIFIED: เน้นพื้นหลัง Navbar Active Menu ใน Dark Mode */
        body.dark-mode .navbar-nav .nav-link.active {
            background-color: #444 !important; 
            color: #fff !important; 
            border-radius: 6px; 
        }
        
        /* MODIFIED: เน้นพื้นหลัง Sidebar Active Menu ใน Dark Mode */
        body.dark-mode #sidebarMenu .nav-link.active {
            background-color: #2a2a2a !important; 
            color: #fff !important; 
            border-radius: 6px;
        }

        /* 🔥 NEW FIX: Dropdown Menu Item Styles ใน Dark Mode (ครอบคลุมที่สุด) */
        
        /* 1. สีพื้นหลังเมนูและเส้นขอบ */
        body.dark-mode .dropdown-menu {
            background-color: var(--card-dark) !important;
            border-color: var(--border-dark) !important;
        }

        /* 2. สีข้อความของรายการเมนูทั้งหมด */
        body.dark-mode .dropdown-menu .dropdown-item {
            color: var(--text-dark) !important;
        }

        /* 3. สไตล์เมื่อชี้ (Hover) และ Active */
        body.dark-mode .dropdown-menu .dropdown-item:hover,
        body.dark-mode .dropdown-menu .dropdown-item:focus,
        body.dark-mode .dropdown-menu .dropend > .dropdown-toggle:hover,
        body.dark-mode .dropdown-menu .dropdown-item.active,
        body.dark-mode .dropdown-menu .dropdown-item:active {
            background-color: var(--card-dark) !important; 
            color: #fff !important;
            background-image: none !important; /* 🔥 สำคัญ: ยกเลิกสีพื้นหลังแบบไล่เฉดของ Bootstrap */
        }
        
        /* 4. สีข้อความของตัว Toggle (เช่น Year) เมื่อ Active/Hover */
        body.dark-mode .dropdown-menu .dropdown-item.dropdown-toggle {
            color: var(--text-dark) !important;
        }
        body.dark-mode .dropdown-menu .dropdown-item.dropdown-toggle:hover,
        body.dark-mode .dropdown-menu .dropdown-item.dropdown-toggle.active {
            color: #fff !important; /* ข้อความขาวเมื่อ Active/Hover */
        }
        
        /* 🔥 NEW FIX: เปลี่ยนสีพื้นหลังของ Dropdown Toggle (Year) เมื่อ Active ให้เป็นสีเทาเข้ม */
        /* ถ้าต้องการให้ Year เป็นสีน้ำเงินหลักเมื่อ Active, ลบกฎนี้ออก */
        /* แต่ถ้าต้องการให้ Year เป็นสีเทาเข้มเมื่อ Active และสีน้ำเงินเฉพาะเมื่อ Hover หรือเมนูย่อย Active ให้คงไว้ */
        /* ปัจจุบันเรากำหนดให้ Year เป็นสีน้ำเงินเมื่อ Active/Hover/เลือกแล้ว ตามกฎข้างบน */

        body.dark-mode .card {
            background-color: var(--card-dark) !important;
            border-color: var(--border-dark) !important;
            color: var(--text-dark) !important;
        }
        
        /* ... (Dark Mode CSS สำหรับ FullCalendar และ Datatables อื่น ๆ เหมือนเดิม) ... */

        body.dark-mode #calendar { background: var(--card-dark); border-color: var(--border-dark); }
        body.dark-mode .fc-multimonth-month,
        body.dark-mode .fc-multimonth-header-table thead th,
        body.dark-mode .fc-multimonth-daygrid-table,
        body.dark-mode .fc-multimonth-daygrid-table td,
        body.dark-mode .fc-multimonth-daygrid-table .fc-daygrid-day {
            background-color: var(--card-dark) !important;
            border-color: var(--border-dark) !important;
            color: var(--text-dark) !important;
        }
        body.dark-mode #calendar table, body.dark-mode #calendar th, body.dark-mode #calendar td,
        body.dark-mode .fc-view-harness table, body.dark-mode .fc-scrollgrid table, body.dark-mode .fc-daygrid-body table,
        body.dark-mode .fc-scrollgrid-section, body.dark-mode .fc-daygrid-body, body.dark-mode .fc-col-header {
            border-color: var(--border-dark) !important;
        }
        body.dark-mode #miniCalendar table, body.dark-mode #miniCalendar th, body.dark-mode #miniCalendar td,
        body.dark-mode #miniCalendar .fc-col-header, body.dark-mode #miniCalendar .fc-scrollgrid-table,
        body.dark-mode #miniCalendar .fc-daygrid-day {
            border-color: var(--border-dark) !important;
        }
        body.dark-mode #miniCalendar .fc-scrollgrid-table { border-right-width: 0px !important; }
        body.dark-mode #miniCalendar .fc-col-header-cell:last-child,
        body.dark-mode .fc-daygrid-day:last-child { border-right-width: 0px !important; }
        body.dark-mode .fc-col-header, body.dark-mode .fc-event, body.dark-mode .fc-daygrid-day-number { color: #fff !important; }
        body.dark-mode .fc-day-today { background-color: var(--card-dark) !important; border-radius: 50%; }
        body.dark-mode .fc-col-header-cell { background-color: var(--card-dark) !important; color: #fff !important; }
        body.dark-mode table.dataTable { background-color: #1e1e1e; color: #e5e5e5; }
        body.dark-mode table.dataTable, body.dark-mode table.dataTable thead th, body.dark-mode table.dataTable tbody td { border-color: var(--border-dark) !important; }
        body.dark-mode table.dataTable thead th { background-color: #2a2a2a !important; color: #f1f1f1 !important; }
        body.dark-mode table.dataTable tbody td { background-color: #1e1e1e !important; color: #e5e5e5 !important; }
        body.dark-mode table.dataTable.stripe tbody tr.odd,
        body.dark-mode table.dataTable.display tbody tr.odd { background-color: #242424 !important; }
        body.dark-mode table.dataTable.stripe tbody tr.even,
        body.dark-mode table.dataTable.display tbody tr.even { background-color: #1c1c1c !important; }
        body.dark-mode .dataTables_wrapper .dataTables_filter input,
        body.dark-mode .dataTables_wrapper .dataTables_length select { background: #2a2a2a; color: #fff; border: 1px solid #555; }
        body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button { color: #ddd !important; }
        body.dark-mode .dataTables_wrapper .dataTables_paginate .paginate_button.current { background: #444 !important; color: #fff !important; }
        body.dark-mode .dataTables_wrapper .dataTables_info { color: #ccc !important; }
        body.dark-mode .form-check-label { color: var(--text-dark); }
    </style>
</head>
<body class="p-0 light-mode">
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-0 border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand py-2 me-4 d-flex align-items-center" href="#">
                <img src="https://via.placeholder.com/35x35?text=CMO" alt="CMO Logo" class="me-2 rounded">
                <span style="font-size:1.2rem; font-weight:600;">CMO PUBLIC COMPANY LIMITED</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-primary" href="#">FM Services</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="reportingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bar-chart-line-fill"></i> Reporting
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="reportingDropdown">
                            <li class="nav-item dropend">
                                <a class="dropdown-item dropdown-toggle" href="#" id="nav-report-year" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Year
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="yearDropdown">
                                    <li><a class="dropdown-item" id="nav-report-current-year" href="#">Current Year</a></li>
                                    <li><a class="dropdown-item" id="nav-report-2024" href="#">2024</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-gear-fill"></i> Settings
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
                            <li><a class="dropdown-item" id="nav-settings-users" href="#">Users</a></li>
                            <li><a class="dropdown-item" id="nav-settings-roles" href="#">Roles</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <span class="d-lg-none d-xl-inline">User A</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="mainLayout" class="d-flex flex-fill"> 
        
        <div id="sidebarMenu" class="d-flex flex-column flex-shrink-0 bg-light border-end p-2 collapsed">
            
            <a class="h6 mt-2 mb-1 pb-1 collapsed-toggle" 
               data-bs-toggle="collapse" href="#carMenu" role="button" aria-expanded="true" aria-controls="carMenu">
                <i class="bi bi-chevron-down toggle-icon me-1"></i>
                <span>Car Center</span>
            </a>
            
            <ul id="carMenu" class="nav nav-pills flex-column mb-auto collapse show">
                <li class="nav-item"><a id="menu-car-center" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Car Center</span></a></li>
                <li class="nav-item"><a id="menu-car-calendar" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Car Center Calendar</span></a></li>
                <li class="nav-item"><a id="menu-car-reserve" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Car Center Reserve</span></a></li>
            </ul>

            <a class="h6 mt-3 mb-1 pb-1 collapsed-toggle"
               data-bs-toggle="collapse" href="#meetingMenu" role="button" aria-expanded="true" aria-controls="meetingMenu">
                   <i class="bi bi-chevron-down toggle-icon me-1"></i>
                 <span>Meeting Room</span>
            </a>
            
            <ul id="meetingMenu" class="nav nav-pills flex-column mb-auto collapse show">
                <li class="nav-item"><a id="menu-meeting-room" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Meeting Room</span></a></li>
                <li class="nav-item"><a id="menu-meeting-calendar" href="#" class="nav-link active" aria-current="page"><i class="bi bi-dot"></i> <span>Meeting Room Calendar</span></a></li>
                <li class="nav-item"><a id="menu-meeting-reserve" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Meeting Room Reserve</span></a></li>
            </ul>
            
            <hr>
            <button id="sidebarToggle" class="btn btn-sm btn-outline-secondary d-flex justify-content-center align-items-center">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </button>
        </div>

        <div id="mainContent" class="flex-grow-1 p-3">
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
                            <label>เลือกห้องที่ต้องการแสดง</label>
                            <hr class="my-1">
                            <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room A" checked> Room A</label>
                            <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room B" checked> Room B</label>
                            <label><input type="checkbox" class="room-filter ms-2 me-1" value="Room C" checked> Room C</label>
                        </div>
                    </div>
                </div>

                <div class="card p-3 mt-5 shadow" id="tableWrapper"> 
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5>📋 ตารางการจองทั้งหมด</h5>
                    </div>
                    
                    <div> 
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
            
            <button class="fab fab-add" data-bs-toggle="modal" data-bs-target="#bookingModal"><i class="bi bi-plus"></i></button>
            <button id="themeToggle" class="fab"><i class="bi bi-moon"></i></button>
            <button id="toggleTable" class="fab"><i class="bi bi-table"></i></button>

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
                    <div class="mb-2"><b>หัวข้อ:</b> <span id="d_subject"></span></div>
                    <div class="mb-2"><b>วันที่:</b> <span id="d_date"></span></div>
                    <div class="mb-2"><b>เวลา:</b> <span id="d_time_range"></span></div>
                    <div class="mb-2"><b>ผู้จอง:</b> <span id="d_booked"></span></div>
                    <div class="mb-2"><b>เวลาที่จองระบบ:</b> <span id="d_booked_time"></span></div>
                    <div class="mb-2"><b>หมายเหตุ:</b> <span id="d_note"></span></div>
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
    let isTableVisible = localStorage.getItem("isTableVisible") !== "false"; 
    let isSidebarCollapsed = localStorage.getItem("isSidebarCollapsed") === "true"; 
    
    // Keys สำหรับบันทึกสถานะ
    const ACTIVE_MENU_KEY = 'activeMenuId';
    const NAVBAR_ACTIVE_KEY = 'navbarActiveId'; 
    const CAR_MENU_STATE = 'carMenuState';
    const MEETING_MENU_STATE = 'meetingMenuState';
    
    let calendar, miniCal, table;
    
    // (สมมติว่าคุณมีไฟล์ data.json อยู่ใน Root Directory ที่มีข้อมูลการจองล่าสุด)
    const DATA_URL = "data.json"; 

    initTheme();
    initSidebar(); 
    loadCollapseMenuState(); 
    initActiveMenu(); 
    initNavbarActiveMenu();
    initPickers();
    initCalendars();
    initTable();
    loadRoomFilterState(); 
    initEventHandlers();
    
    // ----------------------------------------------------------------------
    // 🔥 NEW/MODIFIED: ฟังก์ชันจัดการ Active Menu, Sidebar, Theme, Table (เหมือนเดิม)
    // ----------------------------------------------------------------------

    function initNavbarActiveMenu() {
        const defaultNavbarId = 'nav-report-current-year';
        let activeNavbarId = localStorage.getItem(NAVBAR_ACTIVE_KEY) || defaultNavbarId;
        $('.navbar-nav .nav-link, .navbar-nav .dropdown-item').removeClass('active');
        if (activeNavbarId) {
            const activeLink = $(`#${activeNavbarId}`);
            if (activeLink.length) {
                activeLink.addClass('active');
                const parentDropdownToggle = activeLink.closest('.dropdown').find('.dropdown-toggle').first();
                if (parentDropdownToggle.length) {
                    parentDropdownToggle.addClass('active');
                }
                const dropendToggle = activeLink.closest('.dropend').find('.dropdown-item.dropdown-toggle');
                if (dropendToggle.length) {
                    dropendToggle.addClass('active');
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
        $("#sidebarMenu .nav-link").each(function() {
            if ($(this).children("i").length > 0) {
                $(this).contents().filter(function() {
                    return this.nodeType === 3 && $.trim(this.nodeValue).length > 0;
                }).each(function() {
                    $(this).replaceWith('<span>' + this.nodeValue + '</span>');
                });
            }
        });
    }

    function applySidebarState(isCollapsed) {
        const sidebar = document.getElementById("sidebarMenu");
        const toggleIcon = document.querySelector("#sidebarToggle i");
        
        if (isCollapsed) {
            sidebar.classList.add("collapsed");
            toggleIcon.classList.remove("bi-arrow-left-circle-fill");
            toggleIcon.classList.add("bi-arrow-right-circle-fill");
        } else {
            sidebar.classList.remove("collapsed");
            toggleIcon.classList.remove("bi-arrow-right-circle-fill");
            toggleIcon.classList.add("bi-arrow-left-circle-fill");
        }
    }
    
    function loadCollapseMenuState() {
        const carState = localStorage.getItem(CAR_MENU_STATE);
        const meetingState = localStorage.getItem(MEETING_MENU_STATE);
        
        const setMenuState = (menuId, savedState) => {
            const menu = $(`#${menuId}`);
            const toggle = $(`a[href="#${menuId}"]`);
            
            if (savedState === 'false') { 
                menu.removeClass('show');
                toggle.addClass('collapsed');
                toggle.attr('aria-expanded', 'false');
            } else if (savedState === 'true') { 
                menu.addClass('show');
                toggle.removeClass('collapsed');
                toggle.attr('aria-expanded', 'true');
            } else {
                menu.addClass('show');
                toggle.removeClass('collapsed');
                toggle.attr('aria-expanded', 'true');
            }
        };

        setMenuState('carMenu', carState);
        setMenuState('meetingMenu', meetingState);
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
        if (savedRoomStates) { 
            try {
                const roomStates = JSON.parse(savedRoomStates);
                $(".room-filter").each(function() {
                    const roomName = $(this).val();
                    if (roomStates.hasOwnProperty(roomName)) {
                        $(this).prop("checked", roomStates[roomName]);
                    }
                });
            } catch (e) {
                console.error("Error parsing room filter states from Local Storage:", e);
                localStorage.removeItem("roomFilterStates"); 
            }
        }
        applyRoomFilter(true); 
    }

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
        const toggleBtn = document.getElementById("themeToggle");

        if (isDark) {
            body.classList.add("dark-mode");
            body.classList.remove("light-mode");
            toggleBtn.innerHTML = '<i class="bi bi-sun"></i>';
        } else {
            body.classList.add("light-mode");
            body.classList.remove("dark-mode");
            toggleBtn.innerHTML = '<i class="bi bi-moon"></i>';
        }
    }

    function applyTableVisibility(isVisible) {
        const tableWrapper = $("#tableWrapper");
        const icon = $('#toggleTable i');
        
        if (isVisible) {
            tableWrapper.show();
            icon.removeClass("bi-eye-slash").addClass("bi-table");
        } else {
            tableWrapper.hide();
            icon.removeClass("bi-table").addClass("bi-eye-slash");
        }
    }
    
    function initPickers() {
        flatpickr("#meeting_date", { dateFormat: "Y-m-d" });
        // ใช้ "H:i:s" เพื่อรองรับ Time Format ที่มีใน JSON
        flatpickr("#start_time", { enableTime: true, noCalendar: true, dateFormat: "H:i:s" }); 
        flatpickr("#end_time", { enableTime: true, noCalendar: true, dateFormat: "H:i:s" });
    }

    // ----------------------------------------------------------------------
    // 🔥 MODIFIED: ฟังก์ชัน Map Event Data (รองรับ 3 วัน)
    // ----------------------------------------------------------------------
    function mapEventData(e) {
        let eventStart, eventEnd;
        let isMultiDay = false;
        
        // ตรวจสอบ Event ID 6 หรือ Event ที่มีการจองข้ามวัน (จากฟิลด์ time ที่มีทั้งวันที่และเวลา)
        if (e.id === "6" || (e.time && e.time.includes('2025-'))) {
            // สำหรับ Event 3 วันเต็ม (id: "6")
            const timeParts = e.time.split(' - ');
            if (timeParts.length === 2 && timeParts[0].includes('2025') && timeParts[1].includes('2025')) {
                // แปลงเป็น ISO 8601 Format (YYYY-MM-DDTHH:MM:SS)
                eventStart = timeParts[0].trim().replace(/\s/g, 'T');
                eventEnd = timeParts[1].trim().replace(/\s/g, 'T');
                isMultiDay = true;
            } else {
                // กรณีข้ามคืน (ถ้ามี)
                eventStart = e.meeting_date + "T" + e.start_time;
                // ในโค้ดนี้ FullCalendar จะคำนวณการข้ามคืนให้เองหาก end_time น้อยกว่า start_time
                eventEnd = e.meeting_date + "T" + e.end_time;
            }
        } else {
            // Event ปกติ
            eventStart = e.meeting_date + "T" + e.start_time;
            eventEnd = e.meeting_date + "T" + e.end_time;
        }

        return {
            id: e.id,
            title: e.title + " (" + e.room + ")",
            start: eventStart, 
            end: eventEnd, 
            extendedProps: e,
            color: roomColors[e.room],
            
            // ตั้งค่า allDay เป็น true หากเป็น Event หลายวัน (เพื่อให้แสดงเต็มวันใน DayGrid)
            allDay: isMultiDay,
            display: isMultiDay ? 'block' : 'auto', 
            
            // ปิดการแก้ไขบนปฏิทินสำหรับ Event หลายวัน
            startEditable: !isMultiDay,
            durationEditable: !isMultiDay 
        };
    }

    // ----------------------------------------------------------------------
    // 🔥 MODIFIED: ฟังก์ชัน Show Event Details (แสดงข้อมูลใหม่และจัดการ id 6)
    // ----------------------------------------------------------------------
    function showEventDetails(info) {
        let data = info.event.extendedProps;
        
        // กำหนดการแสดงวันที่และเวลา
        let dateDisplay = data.meeting_date || "-";
        let timeDisplay = data.time || (data.start_time + " - " + data.end_time) || "-";
        
        if (data.id === "6") {
            // กรณี ID 6 จอง 3 วัน
            dateDisplay = "2025-12-20 ถึง 2025-12-22"; 
            timeDisplay = data.time; // ใช้ฟิลด์ time ที่ระบุช่วงวันที่ชัดเจน
        }
        
        // สร้าง Modal Body ใหม่เพื่อแสดงข้อมูลทั้งหมด
        const modalBody = document.querySelector("#detailModal .modal-body");
        modalBody.innerHTML = `
            <div class="mb-2"><b>ห้อง:</b> <span id="d_room">${data.room || "-"}</span></div>
            <div class="mb-2"><b>ชื่อการประชุม:</b> <span id="d_title">${data.title || "-"}</span></div>
            <div class="mb-2"><b>หัวข้อ:</b> <span id="d_subject">${data.subject || "-"}</span></div>
            <div class="mb-2"><b>วันที่:</b> <span id="d_date">${dateDisplay}</span></div>
            <div class="mb-2"><b>เวลา:</b> <span id="d_time_range">${timeDisplay}</span></div>
            <div class="mb-2"><b>ผู้จอง:</b> <span id="d_booked">${data.booked_by || "-"}</span></div>
            <div class="mb-2"><b>เวลาที่จองระบบ:</b> <span id="d_booked_time">${data.booked_time || "-"}</span></div>
            <div class="mb-2"><b>หมายเหตุ:</b> <span id="d_note">${data.note || "-"}</span></div>
        `;

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
            timeZone: 'local',
            // โหลดข้อมูลจาก data.json
            events: (info, success) => $.getJSON(DATA_URL, res => success(res.data.map(mapEventData))),
            eventClick: showEventDetails
        });

        miniCal = new FullCalendar.Calendar(document.getElementById("miniCalendar"), {
            initialView: "dayGridMonth",
            height: "auto",
            contentHeight: "auto",
            expandRows: true,
            headerToolbar: { left: "", center: "title", right: "prev,next" },
            // โหลดข้อมูลจาก data.json
            events: (info, success) => $.getJSON(DATA_URL, res => success(res.data.map(mapEventData))),
            eventClick: showEventDetails,
            selectable: true,
            dateClick: info => calendar.gotoDate(info.dateStr)
        });

        calendar.render();
        miniCal.render();
    }

    function initTable() {
        table = $("#bookingTable").DataTable({
            ajax: DATA_URL,
            columns: [
                { data: "room" }, 
                { data: "title" }, 
                { data: "start" },
                { data: "end" }, 
                { data: "booked_by" }
            ]
        });
        applyTableVisibility(isTableVisible);
    }

//     function initTable() {
//     table = $("#bookingTable").DataTable({
//         ajax: {
//             url: DATA_URL,
//             dataSrc: "data" // บอกให้ Datatables อ่าน Array ข้อมูลจาก obj.data
//         },
//         // 2. ตรวจสอบ Columns ให้แน่ใจว่าตรงกับ Key ใน JSON
//         columns: [
//             { data: "room" }, 
//             { data: "title" }, 
//             { data: "start" },
//             { data: "end" },
//             { data: "booked_by" }
//         ],
//         language: { url: "//cdn.datatables.net/plug-ins/2.0.0/i18n/th.json" } // ภาษาไทย
//     });
//     applyTableVisibility(isTableVisible);
// }

    function initEventHandlers() {
        // Sidebar Toggle Handler (หลัก)
        $("#sidebarToggle").on("click", function() {
            isSidebarCollapsed = !isSidebarCollapsed;
            localStorage.setItem("isSidebarCollapsed", isSidebarCollapsed);
            applySidebarState(isSidebarCollapsed);
            setTimeout(() => {
                calendar.updateSize();
                miniCal.updateSize();
            }, 300); 
        });
        
        // Handler สำหรับจดจำสถานะการยุบ/ขยายของเมนูย่อย
        $('#carMenu').on('hidden.bs.collapse', function () {
            localStorage.setItem(CAR_MENU_STATE, 'false');
        });
        $('#carMenu').on('shown.bs.collapse', function () {
            localStorage.setItem(CAR_MENU_STATE, 'true');
        });
        
        $('#meetingMenu').on('hidden.bs.collapse', function () {
            localStorage.setItem(MEETING_MENU_STATE, 'false');
        });
        $('#meetingMenu').on('shown.bs.collapse', function () {
            localStorage.setItem(MEETING_MENU_STATE, 'true');
        });
        
        // Handler สำหรับการคลิกเมนูย่อยทั้งหมด (Active Menu)
        $("#sidebarMenu .nav-link").on("click", function(e) {
            e.preventDefault(); 
            $("#sidebarMenu .nav-link").removeClass("active").removeAttr("aria-current");
            $(this).addClass("active").attr("aria-current", "page");
            localStorage.setItem(ACTIVE_MENU_KEY, this.id);
        });
        
        // 🔥 NEW: Handler สำหรับการคลิกเมนูใน Navbar Dropdown
        $('.navbar-nav .dropdown-item').on('click', function(e) {
            e.preventDefault();
            const clickedId = $(this).attr('id');
            $('.navbar-nav .nav-link, .navbar-nav .dropdown-item').removeClass('active');
            $(this).addClass('active');
            const parentDropdownToggle = $(this).closest('.dropdown').find('.dropdown-toggle').first();
            parentDropdownToggle.addClass('active');
            const dropendToggle = $(this).closest('.dropend').find('.dropdown-item.dropdown-toggle');
            dropendToggle.addClass('active');
            localStorage.setItem(NAVBAR_ACTIVE_KEY, clickedId);
        });
        
        // 🔥 NEW: Handler สำหรับ Nested Dropdown (Reporting > Year)
        $('.dropend').on('mouseenter', function() {
            var $el = $(this);
            var $menu = $el.find('.dropdown-menu');
            $menu.addClass('show'); 
            if ($menu.offset().left + $menu.width() > $(window).width()) {
                $menu.removeClass('dropdown-menu-end').addClass('dropdown-menu-start');
            }
        }).on('mouseleave', function() {
            var $el = $(this);
            var $menu = $el.find('.dropdown-menu');
            $menu.removeClass('show');
            $menu.removeClass('dropdown-menu-start').addClass('dropdown-menu-end');
        });

        
        // MODIFIED: Room Filter Handlers
        $("#checkAllRooms").on("change", function() {
            $(".room-filter").prop("checked", $(this).is(":checked"));
            applyRoomFilter(false);
            filterDataTableByRooms();
            saveRoomFilterState(); 
        });

        $(".room-filter").on("change", function() {
            $("#checkAllRooms").prop("checked", $(".room-filter").length === $(".room-filter:checked").length);
            applyRoomFilter(false);
            filterDataTableByRooms();
            saveRoomFilterState();
        });

        $("#bookingTable").on("search.dt", function() {
            syncCalendarWithDataTable();
            updateRoomFilterByTable();
        });

        $("#bookingForm").on("submit", handleBookingSubmit);

        $("#toggleTable").on("click", function() {
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
    }

    function handleBookingSubmit(e) {
        e.preventDefault();
        // ในสถานการณ์จริง: ส่งข้อมูลไปที่ Backend และรอการตอบกลับ
        // $.post("add_booking.php", $(this).serialize(), function() {
            bootstrap.Modal.getInstance(document.getElementById("bookingModal")).hide();
            $("#bookingForm")[0].reset();
            
            // เนื่องจากไม่มี Backend จริง, เราจึงจำลองการ Reload ข้อมูล
            // ในสถานการณ์จริง ควรใช้ table.ajax.reload()
            console.log("Booking simulated. Please refresh manually if using static data.json.");
            
            // Force reload data for demonstration purposes (ถ้าข้อมูลถูกอัพเดตใน data.json)
            table.ajax.reload(null, false); // Reload data, keep current page
            
            // ต้องดึงข้อมูลใหม่ทั้งหมดและอัปเดตปฏิทินด้วย
            // Note: FullCalendar Events source ถูกตั้งค่าเป็น AJAX, 
            // การเรียก .refetchEvents() น่าจะทำงาน แต่ในโค้ดนี้เราจะใช้การ Remove/Add Event ตาม Datatable
            
            // เนื่องจากเราไม่มี Backend จริงที่จะอัปเดต data.json ให้
            // เราจะข้ามส่วนนี้ไปก่อนและสันนิษฐานว่าการกด Submit จะเพิ่มข้อมูลใหม่ให้ Datatable และ Calendar
            
        // });
    }
});
</script>
</body>
</html>