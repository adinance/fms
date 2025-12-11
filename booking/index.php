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

        html, body {
            height: 100%;
        }
        
        body {
            font-family: var(--font-main);
            transition: background-color 0.3s, color 0.3s;
            display: flex;
            flex-direction: column; 
        }

        a { text-decoration: none !important; }
        
        #mainLayout {
            flex-grow: 1;
            overflow: hidden; 
        }

        #sidebarMenu {
            width: 280px;
            transition: width 0.3s ease, margin 0.3s ease;
            overflow-x: hidden;
            flex-shrink: 0; 
            overflow-y: auto; 
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

        /* ปรับ Transition สำหรับ Collapse/Show ให้สมูทขึ้น */
        .collapse {
            transition: height 0.4s ease-in-out !important; 
        }
        
        .collapsing {
            transition: height 0.4s ease-in-out !important;
        }
        /* สิ้นสุดการปรับ Transition */


        #sidebarMenu .collapsed-toggle {
            cursor: pointer;
            font-size: 1.1rem; /* ปรับขนาดหัวข้อ/ไอคอนหลักให้ใหญ่ขึ้นเล็กน้อย */
            font-weight: 600;
            color: var(--text-light);
            padding-top: 5px;
            padding-bottom: 5px;
            margin-top: 5px;
            transition: background-color 0.2s, color 0.2s; /* เพิ่ม color transition */
        }

        #sidebarMenu .collapsed-toggle:hover {
            background-color: #e9ecef; 
        }
        
        #sidebarMenu .collapsed-toggle .toggle-icon {
            transition: transform 0.3s ease;
        }
        
        /* สไตล์ของ Icon ในโหมดขยาย */
        #sidebarMenu .collapsed-toggle i:not(.toggle-icon) {
            margin-right: 8px;
            width: 20px; 
            text-align: center;
        }

        #sidebarMenu .collapsed-toggle.collapsed .toggle-icon {
            transform: rotate(-90deg);
        }

        #sidebarMenu.collapsed {
            width: 60px !important;
        }
        
        /* 1. จัดวางองค์ประกอบในโหมดยุบให้อยู่ตรงกลาง */
        #sidebarMenu.collapsed .collapsed-toggle {
            text-align: center; /* จัดเนื้อหาให้อยู่ตรงกลาง */
            padding: 0.5rem 0.5rem !important; /* จัด Padding ให้สมมาตร */
        }
        
        /* 2. ปรับขนาดและจัดวางไอคอนหลักในโหมด collapsed */
        #sidebarMenu.collapsed .collapsed-toggle i {
            font-size: 1.2rem; /* ทำให้ไอคอนใหญ่ขึ้นเล็กน้อย */
            margin-right: 0; /* ลบ margin ด้านขวาออก */
            width: 30px; /* เพิ่มความกว้างเพื่อช่วยในการจัดวาง */
            display: inline-block;
        }

        #sidebarMenu.collapsed .nav-link {
            padding: 0.5rem 0.5rem;
        }
        
        /* 3. ปรับขนาดไอคอนเมนูย่อยในโหมด collapsed */
        #sidebarMenu.collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.1rem; /* ทำให้ไอคอน nav-link ใหญ่ขึ้นตามหัวข้อเล็กน้อย */
            width: 30px; /* ปรับให้กว้างขึ้นเพื่อการจัดวางที่ดีขึ้น */
        }
        
        #sidebarMenu.collapsed .nav-link span,
        #sidebarMenu.collapsed .collapsed-toggle span,
        #sidebarMenu.collapsed .collapsed-toggle .toggle-icon,
        #sidebarMenu.collapsed .sidebar-label,
        #sidebarMenu.collapsed hr {
            display: none;
        }
        
        /* ปรับปรุงการแสดงผลของปุ่มในโหมด collapsed */
        #sidebarMenu.collapsed .border-top {
            padding: 0.5rem !important; 
        }
        #sidebarMenu.collapsed .border-top .w-100 {
            width: auto !important;
        }

        #sidebarMenu.collapsed #sidebarToggle i {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
        #sidebarMenu #sidebarToggle i {
            transition: transform 0.3s ease;
        }
        
        #mainContent {
            overflow-y: auto;
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

        /* FAB Sidebar Toggle (ใหม่) */
        .fab-toggle { 
            bottom: 30px; 
            background-color: #6c757d; 
            font-size: 20px;
        }
        .fab-toggle:hover { background-color: #495057; }

        /* FAB Add (เลื่อนตำแหน่ง) */
        .fab-add { 
            bottom: 100px; 
            background-color: #0d6efd;
            font-size: 30px;
        }
        .fab-add:hover { background-color: #0b5ed7; }
        
        /* Theme Toggle (เลื่อนตำแหน่ง) */
        #themeToggle {
            background-color: #6c757d;
            font-size: 20px;
            bottom: 170px; 
        }
        #themeToggle:hover { background-color: #495057; }
        
        /* Toggle Table (เลื่อนตำแหน่ง) */
        #toggleTable {
            background-color: #007bff; 
            font-size: 20px;
            bottom: 240px; 
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
        body.light-mode #sidebarMenu .collapsed-toggle { 
            color: #000; 
        }
        body.light-mode #sidebarMenu .border-top { border-color: #e9ecef !important; }


        body.light-mode .navbar-nav .nav-link.active {
            background-color: #e9ecef !important; 
            color: #0d6efd !important; 
            border-radius: 6px; 
        }

        body.light-mode #sidebarMenu .nav-link.active {
            background-color: #0d6efd !important;
            color: #fff !important; 
            border-radius: 6px;
        }
        
        body.light-mode .dropdown-menu .dropdown-item.active {
            background-color: #0d6efd !important;
            color: #fff !important;
        }

        body.light-mode .fc-day-today { background-color: #e9ecef !important; border-radius: 50%; }
        body.light-mode .fc-col-header-cell { background-color: #f8f9fa !important; color: #000 !important; }

        /* --- Dark Mode Styles --- */
        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }
        
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
        }
        body.dark-mode #sidebarMenu .border-top { border-color: var(--border-dark) !important; }

        body.dark-mode #sidebarMenu .collapsed-toggle:hover {
            background-color: #2a2a2a; 
        }

        body.dark-mode .navbar-nav .nav-link.active {
            background-color: #444 !important; 
            color: #fff !important; 
            border-radius: 6px; 
        }
        
        body.dark-mode #sidebarMenu .nav-link.active {
            background-color: #2a2a2a !important; 
            color: #fff !important; 
            border-radius: 6px;
        }

        body.dark-mode .dropdown-menu {
            background-color: var(--card-dark) !important;
            border-color: var(--border-dark) !important;
        }

        body.dark-mode .dropdown-menu .dropdown-item {
            color: var(--text-dark) !important;
        }

        body.dark-mode .dropdown-menu .dropdown-item:hover,
        body.dark-mode .dropdown-menu .dropdown-item:focus,
        body.dark-mode .dropdown-menu .dropend > .dropdown-toggle:hover,
        body.dark-mode .dropdown-menu .dropdown-item.active,
        body.dark-mode .dropdown-menu .dropdown-item:active {
            background-color: var(--card-dark) !important; 
            color: #fff !important;
            background-image: none !important;
        }
        
        body.dark-mode .dropdown-menu .dropdown-item.dropdown-toggle {
            color: var(--text-dark) !important;
        }
        body.dark-mode .dropdown-menu .dropdown-item.dropdown-toggle:hover,
        body.dark-mode .dropdown-menu .dropdown-item.dropdown-toggle.active {
            color: #fff !important;
        }
        
        body.dark-mode .card {
            background-color: var(--card-dark) !important;
            border-color: var(--border-dark) !important;
            color: var(--text-dark) !important;
        }
        
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
                <img src="images/logo-white.png" alt="CMO Logo" class="me-2 rounded" width="45px">
                <img src="images/logo-black.png" alt="CMO Logo" class="me-2 rounded" width="45px">
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
                <i class="bi bi-car-front-fill me-1"></i>
                <span>Car Center</span>
            </a>
            
            <ul id="carMenu" class="nav nav-pills flex-column collapse show">
                <li class="nav-item"><a id="menu-car-center" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Car Center</span></a></li>
                <li class="nav-item"><a id="menu-car-calendar" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Car Center Calendar</span></a></li>
                <li class="nav-item"><a id="menu-car-reserve" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Car Center Reserve</span></a></li>
            </ul>

            <a class="h6 mt-1 mb-1 pb-1 collapsed-toggle"
                data-bs-toggle="collapse" href="#meetingMenu" role="button" aria-expanded="true" aria-controls="meetingMenu">
                    <i class="bi bi-easel-fill me-1"></i>
                    <span>Meeting Room</span>
            </a>
            
            <ul id="meetingMenu" class="nav nav-pills flex-column mb-auto collapse show">
                <li class="nav-item"><a id="menu-meeting-room" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Meeting Room</span></a></li>
                <li class="nav-item"><a id="menu-meeting-calendar" href="#" class="nav-link active" aria-current="page"><i class="bi bi-dot"></i> <span>Meeting Room Calendar</span></a></li>
                <li class="nav-item"><a id="menu-meeting-reserve" href="#" class="nav-link"><i class="bi bi-dot"></i> <span>Meeting Room Reserve</span></a></li>
            </ul>
            
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
            
            <button id="toggleTable" class="fab"><i class="bi bi-table"></i></button>
            <button id="themeToggle" class="fab"><i class="bi bi-moon"></i></button>
            <button class="fab fab-add" data-bs-toggle="modal" data-bs-target="#bookingModal"><i class="bi bi-plus"></i></button>
            <button id="sidebarToggle" class="fab fab-toggle"><i class="bi bi-arrow-left-circle-fill"></i></button>

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
    
    const ACTIVE_MENU_KEY = 'activeMenuId';
    const NAVBAR_ACTIVE_KEY = 'navbarActiveId'; 
    const CAR_MENU_STATE = 'carMenuState';
    const MEETING_MENU_STATE = 'meetingMenuState';
    
    let calendar, miniCal, table;
    
    const DATA_URL = "data.json"; 

    initTheme();
    initSidebar(); 
    loadCollapseMenuState(); 
    initActiveMenu(); 
    initNavbarActiveMenu();
    initPickers();
    initCalendars();
    initTable(); 
    initEventHandlers();
    
    const getStartDay = (datetime) => datetime ? datetime.substring(0, 10) : "";

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

    function loadRoomFilterState(applyFilterToTable = false) {
        const savedRoomStates = localStorage.getItem("roomFilterStates");
        let selectedRooms = [];
        
        if (savedRoomStates) { 
            try {
                const roomStates = JSON.parse(savedRoomStates);
                $(".room-filter").each(function() {
                    const roomName = $(this).val();
                    if (roomStates.hasOwnProperty(roomName)) {
                        $(this).prop("checked", roomStates[roomName]);
                        if (roomStates[roomName]) {
                            selectedRooms.push(roomName);
                        }
                    }
                });
            } catch (e) {
                console.error("Error parsing room filter states from Local Storage:", e);
                localStorage.removeItem("roomFilterStates"); 
            }
        }
        
        applyRoomFilter(false); 

        if (applyFilterToTable && table) {
            let searchVal = selectedRooms.length === 0 ? "^$" : selectedRooms.join("|");
            table.column(0).search(searchVal, true, false).draw();
        }
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
        flatpickr("#start_time", { enableTime: true, noCalendar: true, dateFormat: "H:i:s" }); 
        flatpickr("#end_time", { enableTime: true, noCalendar: true, dateFormat: "H:i:s" });
    }

    function mapEventData(e) {
        const isMultiDay = (e.start && e.end) && (getStartDay(e.start) !== getStartDay(e.end)); 

        return {
            id: e.id,
            title: e.title + " (" + e.room + ")",
            start: e.start, 
            end: e.end, 
            extendedProps: e,
            color: roomColors[e.room],
            
            allDay: isMultiDay,
            display: 'auto', 
            
            startEditable: !isMultiDay,
            durationEditable: !isMultiDay 
        };
    }

    function showEventDetails(info) {
        let data = info.event.extendedProps;
        
        const formatTime = (datetime) => datetime ? datetime.substring(11) : "-";
        
        const startDate = getStartDay(data.start);
        const startTime = formatTime(data.start);
        const endDate = getStartDay(data.end);
        const endTime = formatTime(data.end);
        
        const isMultiDay = (startDate !== endDate);
        
        let dateDisplay, timeDisplay;
        
        if (isMultiDay) {
            dateDisplay = `${startDate} ถึง ${endDate}`;
            timeDisplay = `${startTime} - ${endTime}`;
        } else {
            dateDisplay = startDate;
            timeDisplay = `${startTime} - ${endTime}`;
        }
        
        const modalBody = document.querySelector("#detailModal .modal-body");
        modalBody.innerHTML = `
            <div class="mb-2"><b>ห้อง:</b> <span id="d_room">${data.room || "-"}</span></div>
            <div class="mb-2"><b>ชื่อการประชุม:</b> <span id="d_title">${data.title.replace(` (${data.room})`, '') || "-"}</span></div>
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
            events: (info, success) => $.getJSON(DATA_URL, res => success(res.map(mapEventData))),
            eventClick: showEventDetails
        });

        miniCal = new FullCalendar.Calendar(document.getElementById("miniCalendar"), {
            initialView: "dayGridMonth",
            height: "auto",
            contentHeight: "auto",
            expandRows: true,
            headerToolbar: { left: "", center: "title", right: "prev,next" },
            events: (info, success) => $.getJSON(DATA_URL, res => success(res.map(mapEventData))),
            eventClick: showEventDetails,
            selectable: true,
            dateClick: info => calendar.gotoDate(info.dateStr)
        });

        calendar.render();
        miniCal.render();
    }

    function initTable() {
        table = $("#bookingTable").DataTable({
            ajax: {
                url: DATA_URL,
                dataSrc: "" 
            },
            columns: [
                { data: "room" }, 
                { data: "title" }, 
                { data: "start" },
                { data: "end" }, 
                { data: "booked_by" }
            ],
            // เปิดใช้งานการจดจำสถานะ
            stateSave: true 
        });
        
        applyTableVisibility(isTableVisible);

        // เมื่อ Datatable โหลดเสร็จแล้ว ให้โหลดและกรองตามสถานะ Checkbox ที่จำไว้
        table.on('init', function() {
            loadRoomFilterState(true); 
        });
    }

    function initEventHandlers() {
        $("#sidebarToggle").on("click", function() {
            isSidebarCollapsed = !isSidebarCollapsed;
            localStorage.setItem("isSidebarCollapsed", isSidebarCollapsed);
            applySidebarState(isSidebarCollapsed);
            setTimeout(() => {
                calendar.updateSize();
                miniCal.updateSize();
            }, 300); 
        });
        
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
        
        $("#sidebarMenu .nav-link").on("click", function(e) {
            e.preventDefault(); 
            $("#sidebarMenu .nav-link").removeClass("active").removeAttr("aria-current");
            $(this).addClass("active").attr("aria-current", "page");
            localStorage.setItem(ACTIVE_MENU_KEY, this.id);
        });
        
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

        
        $(".room-filter").on("change", function() {
            $("#checkAllRooms").prop("checked", $(".room-filter").length === $(".room-filter:checked").length);
            
            applyRoomFilter(false);
            filterDataTableByRooms();
            saveRoomFilterState();
        });
        
        // เมื่อมีการวาดตาราง (Search, Paging, Sort) ให้ซิงค์กับ Calendar
        table.on("draw.dt", function() {
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
    }

    function applyRoomFilter(updateTable = true) {
        let selectedRooms = $(".room-filter:checked").map(function() { return this.value; }).get();
        const filterFunc = evt => selectedRooms.includes(evt.extendedProps.room) ? "auto" : "none";
        
        calendar.getEvents().forEach(evt => evt.setProp("display", filterFunc(evt)));
        miniCal.getEvents().forEach(evt => evt.setProp("display", filterFunc(evt)));

        if (updateTable) {
            filterDataTableByRooms();
        }
    }

    function syncCalendarWithDataTable() {
        let visibleIds = table.rows({ search: "applied" }).data().toArray().map(item => String(item.id));
        const syncFunc = evt => visibleIds.includes(String(evt.id)) ? "auto" : "none";

        calendar.getEvents().forEach(evt => evt.setProp("display", syncFunc(evt)));
        miniCal.getEvents().forEach(evt => evt.setProp("display", syncFunc(evt)));
    }

    let isTableSyncing = false;
    function updateRoomFilterByTable() {
        if (isTableSyncing) return; 
        
        let visibleData = table.rows({ search: "applied" }).data().toArray();
        let rooms = [...new Set(visibleData.map(item => item.room))];
        
        if (table.search() === '' && table.column(0).search() === '') {
             
        } else {
            isTableSyncing = true;
            $(".room-filter").each(function() { 
                this.checked = rooms.includes(this.value); 
            });
            isTableSyncing = false;
        }
    }

    function handleBookingSubmit(e) {
        e.preventDefault();
        
        bootstrap.Modal.getInstance(document.getElementById("bookingModal")).hide();
        $("#bookingForm")[0].reset();
        
        console.log("Booking simulated. Please refresh manually if using static data.json.");
        
        table.ajax.reload(null, false);
    }
});
</script>
</body>
</html>