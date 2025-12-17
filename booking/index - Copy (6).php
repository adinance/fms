<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meeting Room Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.bootstrap5.min.css" rel="stylesheet" />
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

        html,
        body {
            height: 100%;
        }

        body {
            font-family: var(--font-main);
            transition: background-color 0.3s, color 0.3s;
            display: flex;
            flex-direction: column;

        }

        a {
            text-decoration: none !important;
        }

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
            /* margin-right: 8px;
            width: 20px;
            text-align: center; */
            width: 22px;
            margin-right: 8px;
            font-size: 1rem;
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
            font-size: 1.1rem;
            /* ปรับขนาดหัวข้อ/ไอคอนหลักให้ใหญ่ขึ้นเล็กน้อย */
            font-weight: 600;
            color: var(--text-light);
            padding-top: 5px;
            padding-bottom: 5px;
            margin-top: 5px;
            transition: background-color 0.2s, color 0.2s;
            /* เพิ่ม color transition */
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
            text-align: center;
            /* จัดเนื้อหาให้อยู่ตรงกลาง */
            padding: 0.5rem 0.5rem !important;
            /* จัด Padding ให้สมมาตร */
        }

        /* 2. ปรับขนาดและจัดวางไอคอนหลักในโหมด collapsed */
        #sidebarMenu.collapsed .collapsed-toggle i {
            font-size: 1.2rem;
            /* ทำให้ไอคอนใหญ่ขึ้นเล็กน้อย */
            margin-right: 0;
            /* ลบ margin ด้านขวาออก */
            width: 30px;
            /* เพิ่มความกว้างเพื่อช่วยในการจัดวาง */
            display: inline-block;
        }

        #sidebarMenu.collapsed .nav-link {
            padding: 0.5rem 0.5rem;
        }

        /* 3. ปรับขนาดไอคอนเมนูย่อยในโหมด collapsed */
        #sidebarMenu.collapsed .nav-link i {
            margin-right: 0;
            font-size: 1.1rem;
            /* ทำให้ไอคอน nav-link ใหญ่ขึ้นตามหัวข้อเล็กน้อย */
            width: 30px;
            /* ปรับให้กว้างขึ้นเพื่อการจัดวางที่ดีขึ้น */
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

        /* #mainContent {
            overflow-y: auto;
        } */

            #mainContent {
    overflow-y: visible; /* ให้การเลื่อนไปที่ Body/Window แทน */
}

/* และตรวจสอบ #mainLayout */
#mainLayout {
    flex-grow: 1;
    overflow: visible; /* ต้องเป็น visible เช่นกัน */
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

        #miniCalendar {
            max-width: 100%;
            margin: 20px auto;
            /* font-size: 12px !important; */
        }

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
            /* font-size: 15px !important; */
            font-weight: 600;
            /* text-transform: uppercase !important; */
        }


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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 1000;
        }


        /* FAB Sidebar Toggle (ใหม่) */
        .fab-toggle {
            bottom: 30px;
            background-color: #6c757d;
            font-size: 20px;
        }

        .fab-toggle:hover {
            background-color: #495057;
        }

        /* FAB Add (เลื่อนตำแหน่ง) */
        .fab-add {
            bottom: 100px;
            background-color: #0d6efd;
            font-size: 30px;
        }

        .fab-add:hover {
            background-color: #0b5ed7;
        }

        /* Toggle Table (ตำแหน่งใหม่: 170px) */
        #toggleTable {
            background-color: #198754;
            font-size: 20px;
            bottom: 170px; /* <--- UPDATED POSITION */
        }

        #toggleTable:hover {
            background-color: #157347;
        }

        #bookingTable thead th {
            text-align: center !important;
            vertical-align: middle;
            text-transform: uppercase !important;
        }


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

        body.light-mode .nav-link {
            color: #000;
        }

        body.light-mode #sidebarMenu {
            background-color: #f8f9fa !important;
        }

        body.light-mode .navbar {
            background-color: #f8f9fa !important;
        }

        body.light-mode #sidebarMenu .collapsed-toggle {
            color: #000;
        }

        body.light-mode #sidebarMenu .border-top {
            border-color: #e9ecef !important;
        }


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

        body.light-mode .fc-day-today {
            background-color: #e9ecef !important;
            border-radius: 0;
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

        body.dark-mode #sidebarMenu .border-top {
            border-color: var(--border-dark) !important;
        }

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
        body.dark-mode .dropdown-menu .dropend>.dropdown-toggle:hover,
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

        /* --- Dark Mode Styles for Modals & Forms --- */
        body.dark-mode .modal-content {
            background-color: var(--card-dark) !important;
            color: var(--text-dark) !important;
        }

        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            border-color: var(--border-dark) !important;
        }

        body.dark-mode .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
            /* ทำให้ไอคอนปิดเป็นสีขาว */
        }

        /* แก้ไข Input, Select, Textarea ภายใน Modal ให้เป็น Dark Mode ด้วย */
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background-color: #2a2a2a !important;
            /* พื้นหลังมืดกว่าการ์ดเล็กน้อย */
            color: var(--text-dark) !important;
            border-color: #555 !important;
        }

        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background-color: #2a2a2a !important;
            color: var(--text-dark) !important;
            border-color: #0d6efd !important;
            /* ให้มีเส้นขอบสีน้ำเงินเมื่อโฟกัส */
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* แก้ไข Flatpickr Input ใน Dark Mode (ถ้าต้องการ) */
        body.dark-mode .flatpickr-input {
            background-color: #2a2a2a !important;
            color: var(--text-dark) !important;
            border-color: #555 !important;
        }

        /* Flatpickr Calendar Theme (ภายนอก Modal) */
        .flatpickr-calendar.open.dark-mode {
            background: var(--bg-dark);
            border: 1px solid var(--border-dark);
        }

        .flatpickr-calendar.open.dark-mode .flatpickr-day,
        .flatpickr-calendar.open.dark-mode .flatpickr-months .flatpickr-month {
            color: var(--text-dark);
        }

        .flatpickr-calendar.open.dark-mode .flatpickr-day.selected,
        .flatpickr-calendar.open.dark-mode .flatpickr-day.selected:hover {
            background: #0d6efd;
            border-color: #0d6efd;
        }

        .flatpickr-calendar.open.dark-mode .flatpickr-day.today {
            border-color: #0d6efd;
        }

        body.dark-mode #calendar {
            background: var(--card-dark);
            border-color: var(--border-dark);
        }

        body.dark-mode .fc-multimonth-month,
        body.dark-mode .fc-multimonth-header-table thead th,
        body.dark-mode .fc-multimonth-daygrid-table,
        body.dark-mode .fc-multimonth-daygrid-table td,
        body.dark-mode .fc-multimonth-daygrid-table .fc-daygrid-day {
            background-color: var(--card-dark) !important;
            border-color: var(--border-dark) !important;
            color: var(--text-dark) !important;
        }

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

        body.dark-mode #miniCalendar table,
        body.dark-mode #miniCalendar th,
        body.dark-mode #miniCalendar td,
        body.dark-mode #miniCalendar .fc-col-header,
        body.dark-mode #miniCalendar .fc-scrollgrid-table,
        body.dark-mode #miniCalendar .fc-daygrid-day {
            border-color: var(--border-dark) !important;
        }

        body.dark-mode #miniCalendar .fc-scrollgrid-table {
            border-right-width: 0px !important;
        }

        body.dark-mode #miniCalendar .fc-col-header-cell:last-child,
        body.dark-mode .fc-daygrid-day:last-child {
            border-right-width: 0px !important;
        }

        body.dark-mode .fc-col-header,
        body.dark-mode .fc-event,
        body.dark-mode .fc-daygrid-day-number {
            color: #fff !important;
        }

        body.dark-mode .fc-day-today {
            background-color: #2a2a2a !important;
            /* ใช้สีที่เข้มกว่า var(--card-dark) (#1f1f1f) */
            border-radius: 0;
        }

        body.dark-mode .fc-col-header-cell {
            background-color: var(--card-dark) !important;
            color: #fff !important;
        }

        body.dark-mode table.dataTable {
            background-color: #1e1e1e;
            color: #e5e5e5;
        }

        body.dark-mode table.dataTable,
        body.dark-mode table.dataTable thead th,
        body.dark-mode table.dataTable tbody td {
            border-color: var(--border-dark) !important;
        }

        body.dark-mode table.dataTable thead th {
            background-color: #2a2a2a !important;
            color: #f1f1f1 !important;
        }

        body.dark-mode table.dataTable tbody td {
            background-color: #1e1e1e !important;
            color: #e5e5e5 !important;
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

        body.dark-mode .form-check-label {
            color: var(--text-dark);
        }

        /* --- Footer Styles --- */
        #mainFooter {
            flex-shrink: 0;
            /* ป้องกันไม่ให้ Footer ยุบตัว */
            background-color: #f8f9fa;
            /* Light Mode Default */
            transition: background-color 0.3s, border-color 0.3s;
        }

        body.dark-mode #mainFooter {
            background-color: var(--card-dark) !important;
            border-color: var(--border-dark) !important;
        }

        body.dark-mode #mainFooter .text-muted {
            color: #bbb !important;
            /* ปรับสีข้อความใน Dark Mode */
        }

        /* --- Logo Styles --- */
        .dark-mode-logo {
            display: none !important;
            /* ซ่อน Dark Logo ใน Light Mode เริ่มต้น */
        }

        .light-mode-logo {
            display: inline-block !important;
            /* แสดง Light Logo ใน Light Mode เริ่มต้น */
        }

        body.dark-mode .dark-mode-logo {
            display: inline-block !important;
        }

        body.dark-mode .light-mode-logo {
            display: none !important;
        }

        /* .main-calendar-card {
            min-height: 81vh;
        }

        #calendar {
            height: 100%;
        } */

        #calendar .fc-toolbar-chunk:last-child .btn-group {
            flex-wrap: wrap;
            justify-content: flex-end;

        }

        #calendar .fc-toolbar-title {
            text-transform: uppercase !important;
            /* บังคับให้เป็นตัวพิมพ์ใหญ่ทั้งหมด */
        }

        /* พื้นหลังช่อง All-day */
        /* .fc .fc-timegrid-all-day,
.fc .fc-scrollgrid-section-sticky {
	background-color: #1f1f1f;
}

.fc .fc-timegrid-axis,
.fc .fc-timegrid-slot-label {
	background-color: #1a1a1a;
	color: #ccc;
}

.fc .fc-scrollgrid,
.fc .fc-scrollgrid td,
.fc .fc-scrollgrid th {
	// border-color: #333;
} */

        body.dark-mode .fc .fc-timegrid-all-day,
        body.dark-mode .fc .fc-scrollgrid-section-sticky {
            background-color: #1f1f1f;
        }

        body.dark-mode .fc .fc-timegrid-axis,
        body.dark-mode .fc .fc-timegrid-slot-label {
            background-color: #181818;
            color: #bbb;
        }

        /* .fc .fc-timegrid-all-day {
	box-shadow: inset 0 -1px 0 #333;
} */


        /* พื้นหลัง list view */
        body.dark-mode .fc-list {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        /* แถววันที่ (December 16, 2025) */
        body.dark-mode .fc-list-day-cushion {
            background-color: #262626;
            color: #9ecbff;
            border-color: #333;
        }

        /* ชื่อวัน (Tuesday) */
        body.dark-mode .fc-list-day-text,
        body.dark-mode .fc-list-day-side-text {
            color: #9ecbff;
            font-weight: 500;
        }

        /* แถว event */
        body.dark-mode .fc-list-event {
            background-color: #1f1f1f;
            border-color: #333;
        }

        /* hover event */
        body.dark-mode .fc-list-event:hover,
        body.dark-mode .fc-list-event.fc-event-forced-url:hover {
            background-color: inherit !important;
        }

        body.dark-mode .fc-list-event:hover {
            cursor: pointer;
        }

        body.dark-mode .fc-theme-standard .fc-list-event:hover {
            background-color: inherit !important;
        }



        /* คำว่า all-day */
        body.dark-mode .fc-list-event-time {
            color: #9e9e9e;
        }

        /* ชื่อ event */
        body.dark-mode .fc-list-event-title {
            color: #eaeaea;
        }

        /* เส้นคั่น */
        body.dark-mode .fc-list-event td {
            border-color: #333;
        }


        /* เอากรอบนอกสุดออก */
        body.dark-mode .fc-list {
            border: none;
            outline: none;
        }

        /* เอากรอบ table ออก */
        body.dark-mode .fc-list-table,
        body.dark-mode .fc-list-table td,
        body.dark-mode .fc-list-table th {
            border: none;
        }

        /* เอาเส้นขอบ scrollgrid ออก */
        body.dark-mode .fc-scrollgrid,
        body.dark-mode .fc-scrollgrid-section,
        body.dark-mode .fc-scrollgrid-section table {
            border: none;
        }

        /* กันเส้นขาวแฝง */
        body.dark-mode .fc * {
            box-shadow: none;
        }


        /* พื้นหลังรวมของ Annual */
        body.dark-mode .fc-multimonth {
            background-color: transparent;
            border: none;
        }

        /* กล่องแต่ละเดือน */
        body.dark-mode .fc-multimonth-month {
            background-color: #1f1f1f;
            border: none;
            box-shadow: none;
            border-radius: 8px;
        }

        /* หัวเดือน (January, February...) */
        body.dark-mode .fc-multimonth-title {
            color: #9ecbff;
            font-weight: 500;
        }

        /* ตารางวัน */
        body.dark-mode .fc-daygrid {
            background-color: transparent;
        }

        /* ช่องวัน */
        body.dark-mode .fc-daygrid-day-frame {
            background-color: #1f1f1f;
        }

        /* เส้นตาราง (เอาขาวออก) */
        body.dark-mode .fc-scrollgrid,
        body.dark-mode .fc-scrollgrid td,
        body.dark-mode .fc-scrollgrid th {
            border-color: #2f2f2f;
        }

        /* เอากรอบนอกสุดออก */
        body.dark-mode .fc-scrollgrid {
            border: none;
        }

        /* ตัวเลขวัน */
        body.dark-mode .fc-daygrid-day-number {
            color: #cfcfcf;
        }

        /* วันนอกเดือน */
        body.dark-mode .fc-day-other .fc-daygrid-day-number {
            color: #666;
        }


        /* ปิด hover ทั้ง tr และ a ใน List mode */
        body.dark-mode .fc-list-table tr.fc-list-event:hover,
        body.dark-mode .fc-list-table tr.fc-list-event:hover td,
        body.dark-mode .fc-list-table tr.fc-list-event:hover a {
            background-color: transparent !important;
        }

        /* กรณี FullCalendar บังคับสี */
        body.dark-mode .fc-theme-standard .fc-list-event:hover {
            background-color: transparent !important;
        }

        /* ปิด hover จาก Bootstrap link */
        body.dark-mode .fc-list-event a:hover {
            background-color: transparent !important;
        }


        /* ===== Annual / Year View ===== */

        body.dark-mode .fc-multimonth {
            background-color: transparent;
            border: none;
        }

        body.dark-mode .fc-multimonth-title {
            background-color: #1f1f1f;
            color: #e0e0e0;
            padding: 12px 0;
            border: none;
        }

        /* กันพื้นขาวที่ซ่อนอยู่ */
        body.dark-mode .fc-multimonth-header {
            background-color: #1f1f1f;
            border: none;
        }

        /* ตารางเดือน */
        body.dark-mode .fc-multimonth-month {
            background-color: #1e1e1e;
            border: none;
            box-shadow: none;
        }

        /* หัววัน (Sun Mon Tue...) */
        body.dark-mode .fc-col-header-cell {
            background-color: #1e1e1e;
            color: #4dabf7;
            border-color: #2f2f2f;
        }

        /* ช่องวัน */
        body.dark-mode .fc-daygrid-day-frame {
            background-color: #1e1e1e;
        }

        /* ตัวเลขวัน */
        body.dark-mode .fc-daygrid-day-number {
            color: #e0e0e0;
        }

        /* วันนอกเดือน */
        body.dark-mode .fc-day-other .fc-daygrid-day-number {
            color: #666;
        }

        /* เส้นกริด */
        body.dark-mode .fc-scrollgrid,
        body.dark-mode .fc-scrollgrid td,
        body.dark-mode .fc-scrollgrid th {
            border-color: #2f2f2f;
        }

        /* เอากรอบนอกสุดออก */
        body.dark-mode .fc-scrollgrid {
            border: none;
        }

        body.dark-mode .fc-multimonth .fc-col-header-cell-cushion {
            color: #e6e6e6;
        }

        /* Month / Week / Day */
        body.dark-mode .fc-col-header-cell-cushion {
            color: #e6e6e6;
            font-weight: 500;
        }


        /* กันกรณีถูก override */
        body.dark-mode .fc-theme-standard th {
            color: #e6e6e6;
        }


      


    .spacer-row {
  margin-top: 16px;
}





    </style>
</head>

<body class="p-0 light-mode">

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-0 border-bottom">
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
                    <li class="nav-item">
                        </li>
                </ul>

                <ul class="navbar-nav">

                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
                <i class="bi bi-car-front-fill me-1"></i>
                <span>Car Center</span>
            </a>

            <ul id="carMenu" class="nav nav-pills flex-column collapse show">
                <li class="nav-item"><a id="menu-car-center" href="#" class="nav-link"><i
                            class="bi bi-calendar-week"></i>
                        <span>All Booking</span></a></li>
                <li class="nav-item"><a id="menu-car-reserve" href="#" class="nav-link"><i
                            class="bi bi-calendar-check"></i>
                        <span>My Booking</span></a></li>
            </ul>

            <a class="h6 mt-1 mb-1 pb-1 collapsed-toggle" data-bs-toggle="collapse" href="#meetingMenu" role="button"
                aria-expanded="true" aria-controls="meetingMenu">
                <i class="bi bi-easel-fill me-1"></i>
                <span>Meeting Room</span>
            </a>

            <ul id="meetingMenu" class="nav nav-pills flex-column mb-auto collapse show">
                <li class="nav-item"><a id="menu-meeting-room" href="#" class="nav-link">
                        <i class="bi bi-calendar-week"></i><span>All Booking</span></a></li>
                <li class="nav-item">
                    <a id="menu-meeting-calendar" href="#" class="nav-link active" aria-current="page">
                        <i class="bi bi-calendar-check"></i><span>My Booking</span></a>
                </li>
                </ul>

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
                            <div class="card-footer">* คุณสามารถ กดเลือกรายการที่ Hiligh เพื่อดูรายละเอียดการจอง หรือ กดปุ่ม
                                + ข้างหน้าจอ เพื่อทำการจอง</div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card shadow mt-4">
                            <div class="card-header text-end">Mini Calendar</div>
                            <div class="card-body pt-0">
                                <div id="miniCalendar"></div>
                            </div>
                        </div>

                        <div class="card shadow mt-3">
                            <div class="card-body py-3">
                                <div class="row gx-0">
                                    <div class="col-sm-4">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input room-filter" id="filter_room_1"
                                                value="Meeting 1" checked>
                                            <label class="form-check-label" for="filter_room_1" style="white-space: nowrap;"> Meeting 1</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input room-filter" id="filter_room_2"
                                                value="Meeting 2" checked>
                                            <label class="form-check-label" for="filter_room_2" style="white-space: nowrap;"> Meeting 2</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input room-filter" id="filter_room_3"
                                                value="Meeting 3" checked>
                                            <label class="form-check-label" for="filter_room_3" style="white-space: nowrap;"> Meeting 3</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input room-filter" id="filter_room_4"
                                                value="Training Room 1 (Floor 3)" checked>
                                            <label class="form-check-label" for="filter_room_4" style="white-space: nowrap;"> Training Room 1 (Floor 3)</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input room-filter" id="filter_room_5"
                                                value="Training Room 3 (Floor 1)" checked>
                                            <label class="form-check-label" for="filter_room_5" style="white-space: nowrap;"> Training Room 3 (Floor 1)</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input room-filter" id="filter_room_6"
                                                value="ห้องปูน (Floor 3)" checked>
                                            <label class="form-check-label" for="filter_room_6" style="white-space: nowrap;"> ห้องปูน (Floor 3)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">Select room to display in Main Calendar</div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card p-3 mt-5 shadow" id="tableWrapper">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5>📋 ตารางการจองทั้งหมด</h5>
                            </div>

                            <div>
                                <table id="bookingTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Room</th>
                                            <th>Title</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Booking Name</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>


                    </div>


                </div>
            </div>

            <button id="toggleTable" class="fab"><i class="bi bi-table"></i></button>

            <button class="fab fab-add" data-bs-toggle="modal" data-bs-target="#bookingModal">
                <i class="bi bi-plus"></i></button>
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
                        <label>ชื่อการประชุม (Title)</label>
                        <input type="text" name="title" class="form-control" required />
                    </div>
                    <div class="mb-2">
                        <label>ห้องประชุม (Room)</label>
                        <select name="room" class="form-select" required>
                            <option value="Meeting 1">Meeting 1</option>
                            <option value="Meeting 2">Meeting 2</option>
                            <option value="Meeting 3">Meeting 3</option>
                            <option value="Training Room 1 (Floor 3)">Training Room 1 (Floor 3)</option>
                            <option value="Training Room 3 (Floor 1)">Training Room 3 (Floor 1)</option>
                            <option value="ห้องปูน (Floor 3)">ห้องปูน (Floor 3)</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>หัวข้อ/รายละเอียด (Subject)</label>
                        <input type="text" name="subject" class="form-control" required />
                    </div>
                    <div class="mb-2">
                        <label>วันที่ (Date)</label>
                        <input type="text" id="meeting_date" name="meeting_date" class="form-control" required />
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>เวลาเริ่ม (Start)</label>
                            <input type="text" id="start_time" name="start_time" class="form-control" required />
                        </div>
                        <div class="col">
                            <label>เวลาสิ้นสุด (End)</label>
                            <input type="text" id="end_time" name="end_time" class="form-control" required />
                        </div>
                    </div>
                    <div class="mt-2">
                        <label>ผู้จอง (Booked By)</label>
                        <input type="text" name="booked_by" class="form-control" required />
                    </div>
                    <div class="mt-2">
                        <label>หมายเหตุ (Note)</label>
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
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
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.excelHtml5.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const roomColors = {
                "Meeting 1": "#0d6efd",
                "Meeting 2": "#198754",
                "Meeting 3": "#fd7e14",
                "Training Room 1 (Floor 3)": "#6f42c1",
                "Training Room 3 (Floor 1)": "#dc3545",
                "ห้องปูน (Floor 3)": "#20c997"
            };
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
            initCalendars(); // 📌 แก้ไขส่วนนี้แล้ว
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
                        const parentDropdownToggle = activeLink.closest('.dropdown').find('.dropdown-toggle')
                            .first();
                        if (parentDropdownToggle.length) {
                            parentDropdownToggle.addClass('active');
                        }
                        const dropendToggle = activeLink.closest('.dropend').find(
                            '.dropdown-item.dropdown-toggle');
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
            // 🚩 ปรับปรุงฟังก์ชัน loadRoomFilterState
            function loadRoomFilterState() {
                const savedRoomStates = localStorage.getItem("roomFilterStates");
                let selectedRooms = [];
                let shouldSaveDefaultState = false;
                if (savedRoomStates) {
                    try {
                        const roomStates = JSON.parse(savedRoomStates);
                        $(".room-filter").each(function() {
                            const roomName = $(this).val();
                            const isChecked = roomStates.hasOwnProperty(roomName) ? roomStates[
                                roomName] : true;
                            $(this).prop("checked", isChecked);
                            if (isChecked) {
                                selectedRooms.push(roomName);
                            }
                        });
                    } catch (e) {
                        console.error("Error parsing room filter states from Local Storage:", e);
                        localStorage.removeItem("roomFilterStates");
                        shouldSaveDefaultState = true;
                    }
                }
                // 🚨 ถ้าไม่มีสถานะ (หรือมีข้อผิดพลาด) ให้บังคับติ๊กทั้งหมด
                if (!savedRoomStates || shouldSaveDefaultState) {
                    $(".room-filter").prop("checked", true);
                    selectedRooms = $(".room-filter").map(function() {
                        return this.value;
                    }).get();
                    saveRoomFilterState(); // บันทึกสถานะเริ่มต้นใหม่
                }
                return selectedRooms;
            }

            function initTheme() {
                applyTheme(darkMode);
                // document.getElementById("themeToggle").addEventListener("click", function() {
                //     darkMode = !darkMode;
                //     localStorage.setItem("darkMode", darkMode);
                //     applyTheme(darkMode);
                // });
            }

            function applyTheme(isDark) {
                const body = document.body;

                const profileThemeIcon = document.getElementById("profileThemeIcon");
                const profileThemeText = document.querySelector("#nav-profile-theme span");
                if (isDark) {
                    body.classList.add("dark-mode");
                    body.classList.remove("light-mode");
                    $('.light-mode-logo').css('display', 'none');
                    $('.dark-mode-logo').css('display', 'inline-block'); // หรือ 'block'

                    if (profileThemeIcon) profileThemeIcon.className = "bi bi-sun me-2";
                    if (profileThemeText) profileThemeText.textContent = "Switch to Light Mode";
                } else {
                    body.classList.add("light-mode");
                    body.classList.remove("dark-mode");

                    $('.dark-mode-logo').css('display', 'none');
                    $('.light-mode-logo').css('display', 'inline-block'); // หรือ 'block'

                    if (profileThemeIcon) profileThemeIcon.className = "bi bi-moon me-2";
                    if (profileThemeText) profileThemeText.textContent = "Switch to Dark Mode";
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
                const fpConfig = {
                    dateFormat: "Y-m-d",
                    onOpen: (selectedDates, dateStr, instance) => {
                        // เพิ่มคลาส dark-mode ถ้า body อยู่ใน dark-mode
                        if (document.body.classList.contains('dark-mode')) {
                            instance.calendarContainer.classList.add('dark-mode');
                        } else {
                            instance.calendarContainer.classList.remove('dark-mode');
                        }
                    }
                };
                flatpickr("#meeting_date", {
                    dateFormat: "Y-m-d"
                });
                flatpickr("#start_time", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i:s"
                });
                flatpickr("#end_time", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i:s"
                });
            }

            function mapEventData(e) {
                // หากไม่มีเวลาสิ้นสุดหรือเวลาเริ่มต้นกำหนด, ให้ถือว่าเป็น allDay
                const isAllDay = !e.start.includes('T') && !e.end.includes('T');
                // ถ้าเป็น AllDay, FullCalendar จะจัดการ End date ให้เป็นเที่ยงคืนของวันถัดไปโดยอัตโนมัติ
                // สำหรับการจองห้องประชุมควรใช้เวลาเริ่มและเวลาสิ้นสุด
                // ตรวจสอบว่าเป็นกิจกรรมหลายวันหรือไม่ (เช่น 2025-12-10T09:00:00 vs 2025-12-11T09:00:00)
                const isMultiDay = (e.start && e.end) && (getStartDay(e.start) !== getStartDay(e.end));
                return {
                    id: e.id,
                    title: e.title + " (" + e.room + ")",
                    start: e.start,
                    end: e.end,
                    extendedProps: e,
                    color: roomColors[e.room],
                    allDay: isAllDay, // ใช้ allDay จากข้อมูลจริง หากมี
                    display: 'auto',
                    startEditable: false, // ปิดการแก้ไข
                    durationEditable: false // ปิดการแก้ไข
                };
            }

            function showEventDetails(info) {
                let data = info.event.extendedProps;
                const formatTime = (datetime) => datetime ? datetime.substring(11).substring(0, 5) :
                    "-"; // แสดงแค่ HH:mm
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
            <div class="mb-2"><b>หมายเหตุ:</b> <span id="d_note">${data.note || "-"}</span></div> `;
                new bootstrap.Modal(document.getElementById("detailModal")).show();
            }

            function initCalendars() {
                const initialRooms = loadRoomFilterState();
                const eventSourceConfig = {
                    url: DATA_URL,
                    method: 'GET',
                    failure: function() {
                        console.error("Failed to fetch events from data.json");
                    },
                    // ใช้ success callback เพื่อ map ข้อมูลจาก JSON เป็นรูปแบบ Event ที่ต้องการ
                    success: function(rawEvents) {
                        // return rawEvents.map(mapEventData);
                        // 1. Map ข้อมูลก่อน
                        const events = rawEvents.map(mapEventData);
                        // 2. 🚨 สำคัญ: เรียก applyRoomFilter() ที่นี่เพื่อให้แน่ใจว่า FullCalendar
                        // มี Event ในระบบแล้ว (ใช้ filterDataTableByRooms() แทน)
                        // เนื่องจากเราจะใช้ filterDataTableByRooms() ใน initTable ให้เราใช้ตรรกะการกรองโดยตรง
                        const selectedRooms = initialRooms.length > 0 ? initialRooms : $(
                            ".room-filter:checked").map(function() {
                            return this.value;
                        }).get();
                        // กรอง Event ทันทีที่โหลด
                        return events.map(evt => {
                            const isVisible = selectedRooms.includes(evt.extendedProps.room);
                            evt.display = isVisible ? "auto" : "none";
                            return evt;
                        });
                    }
                };

                // 🚩 ตรรกะการปรับ Header Toolbar ตามขนาดหน้าจอ (สำคัญมาก)
                const isMobile = window.matchMedia("(max-width: 768px)").matches;

                // 1. Config สำหรับ Main Calendar
                const mainHeaderToolbar = isMobile ? {
                    // สำหรับมือถือ: ลด View buttons, เน้น prev/next/title
                    left: "prev,next",
                    // center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth,multiMonthYear"
                } : {
                    // สำหรับ Desktop: แสดงปุ่มทั้งหมด
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth,multiMonthYear"
                };

                calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
                    themeSystem: 'bootstrap5',
                    initialView: "dayGridMonth",
                    height: "auto",
                    headerToolbar: mainHeaderToolbar,
                    buttonText: {
                        today: "Today",
                        month: "Month",
                        week: "Week",
                        day: "Day",
                        listMonth: 'List',
                        multiMonthYear: 'Annual'
                    },
                    timeZone: 'local',
                    views: {
                        dayGridMonth: {
                            // เรากำหนดให้แสดงเฉพาะ 'month' แบบยาว
                            titleFormat: {
                                month: 'long'
                            }
                        },

                        // หากปฏิทินของคุณใช้ชื่อมุมมองเป็น 'month' แทน 'dayGridMonth'
                        // คุณสามารถลองใช้:
                        /*
                        month: {
                        	titleFormat: { month: 'long' }
                        }
                        */
                    },
                    events: eventSourceConfig, // ใช้ Object Config
                    eventClick: showEventDetails
                });

                const miniHeaderToolbar = isMobile ? {
                    left: "prev",
                    center: "title",
                    right: "next"
                } : {
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
                    events: eventSourceConfig, // ใช้ Object Config
                    eventClick: showEventDetails,
                    selectable: true,
                    dateClick: info => calendar.gotoDate(info.dateStr)
                });
                calendar.render();
                miniCal.render();
            }

            function initTable() {

                const initialRooms = loadRoomFilterState();
                applyRoomFilter(false);

                table = $("#bookingTable").DataTable({

                    // dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"B>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    // dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"fB>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    // ในส่วนของ function initTable()
                    // dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"fB>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
//                                                   ^-- ยังคงรวม f และ B ไว้ด้วยกัน

// dom: 
// '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
// '<"row"<"col-sm-12"B>>' +
// '<"row"<"col-sm-12"t>>' +
// '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
// ,

// dom: 
// '<"row"<"col-sm-12 col-md-7"l><"col-sm-12 col-md-3 "f><"col-sm-12 col-md-2 text-md-end"B>>' +
// '<"row spacer-row">' + 
// '<"row"<"col-sm-12"t>>' +
// '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
// ,


dom: 
'<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex align-items-center justify-content-end"fB>>' +
'<"row spacer-row">' + 
'<"row"<"col-sm-12"t>>' +
'<"row spacer-row">' + 
'<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

initComplete: function () {
            // เลือก div ที่มี class .dt-buttons (กลุ่มปุ่ม Export)
            // และเพิ่ม CSS margin-left 5px
            $(this.api().table().container()).find('.dt-buttons').css({
                'margin-left': '15px',
                'margin-bottom': '0' // ล้าง margin ล่าง
            });

            // ล้าง margin-right ของช่อง Search (เผื่อมีค่าเดิมติดมา)
            $(this.api().table().container()).find('.dataTables_filter').css({
                'margin-right': '0',
                'margin-bottom': '0'
            });
        },

                    buttons: [
                        {
                            extend: 'copyHtml5',
                            text: '<i class="bi bi-files"></i>',
                            className: 'btn btn-light btn-sm',
                            exportOptions: {
                                columns: ':visible' // เลือกเฉพาะคอลัมน์ที่มองเห็น
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="bi bi-file-earmark-excel"></i>',
                            className: 'btn btn-light btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="bi bi-filetype-csv"></i>',
                            className: 'btn btn-light btn-sm',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="bi bi-printer"></i>',
                            className: 'btn btn-light btn-sm',
                            exportOptions: {
                                columns: ':visible'
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
                            render: function(data, type, row) {
                                return data.substring(0, 10); // แสดงแค่วันที่
                            }
                        },
                        {
                            data: "end",
                            render: function(data, type, row) {
                                const startTime = row.start.substring(11, 16);
                                const endTime = data.substring(11, 16);
                                return `${startTime} - ${endTime}`;
                            }
                        },
                        {
                            data: "booked_by"
                        }
                    ],
                    // เปิดใช้งานการจดจำสถานะ
                    stateSave: true
                });
                applyTableVisibility(isTableVisible);
                // เมื่อ Datatable โหลดเสร็จแล้ว ให้โหลดและกรองตามสถานะ Checkbox ที่จำไว้
                // table.on('init', function() {
                //     loadRoomFilterState(true);
                // });
                table.on('init', function() {
                    // สร้าง Regex แบบ Exact Match
                    let searchVal;
                    if (initialRooms.length === 0) {
                        searchVal = "^$";
                    } else {
                        const escapedRooms = initialRooms.map(room => {
                            return room.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                        });
                        searchVal = "^(" + escapedRooms.join("|") + ")$";
                    }
                    // กรอง Datatable ด้วยสถานะที่โหลด
                    table.column(0).search(searchVal, true, false).draw();
                });
            }

            function updateDatatableButtonTheme(isDark) {
                if (!table) return; // ตรวจสอบว่าตารางถูกสร้างแล้ว
                const exportButtons = table.buttons().containers().find('.btn');
                
                if (isDark) {
                    exportButtons.removeClass('btn-light').addClass('btn-dark');
                } else {
                    exportButtons.removeClass('btn-dark').addClass('btn-light');
                }

               
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

                $("#nav-profile-theme").on("click", function(e) {
                    e.preventDefault();
                    // เรียกใช้ฟังก์ชันเดียวกับ FAB theme toggle
                    darkMode = !darkMode;
                    localStorage.setItem("darkMode", darkMode);
                    applyTheme(darkMode);

                    updateDatatableButtonTheme(darkMode);
                });

                $('#carMenu').on('hidden.bs.collapse', function() {
                    localStorage.setItem(CAR_MENU_STATE, 'false');
                });
                $('#carMenu').on('shown.bs.collapse', function() {
                    localStorage.setItem(CAR_MENU_STATE, 'true');
                });
                $('#meetingMenu').on('hidden.bs.collapse', function() {
                    localStorage.setItem(MEETING_MENU_STATE, 'false');
                });
                $('#meetingMenu').on('shown.bs.collapse', function() {
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
                    const parentDropdownToggle = $(this).closest('.dropdown').find('.dropdown-toggle')
                        .first();
                    parentDropdownToggle.addClass('active');
                    const dropendToggle = $(this).closest('.dropend').find(
                        '.dropdown-item.dropdown-toggle');
                    dropendToggle.addClass('active');
                    localStorage.setItem(NAVBAR_ACTIVE_KEY, clickedId);
                });
                // Dropdown Sub-menu on Hover (for desktop)
                $('.dropend').on('mouseenter', function() {
                    var $el = $(this);
                    var $menu = $el.find('.dropdown-menu');
                    $menu.addClass('show');
                    if ($menu.offset().left + $menu.width() > $(window).width()) {
                        // ถ้าเมนูจะล้นขวา ให้แสดงทางซ้าย
                        $menu.removeClass('dropdown-menu-end').addClass('dropdown-menu-start');
                    }
                }).on('mouseleave', function() {
                    var $el = $(this);
                    var $menu = $el.find('.dropdown-menu');
                    $menu.removeClass('show');
                    // รีเซ็ตคลาสเมื่อเมาส์ออก (เพื่อให้เปิดครั้งถัดไปถูกต้อง)
                    $menu.removeClass('dropdown-menu-start').addClass('dropdown-menu-end');
                });
                $(".room-filter").on("change", function() {
                    applyRoomFilter(false); // ซิงค์ Calendar ก่อน
                    filterDataTableByRooms(); // กรองตาราง
                    saveRoomFilterState();
                });
                // เมื่อมีการวาดตาราง (Search, Paging, Sort) ให้ซิงค์กับ Calendar
                // table.on("draw.dt", function() {
                //     syncCalendarWithDataTable();
                //     updateRoomFilterByTable();
                // });
                $("#bookingForm").on("submit", handleBookingSubmit);
                $("#toggleTable").on("click", function() {
                    const tableWrapper = $("#tableWrapper");
                    const newState = !tableWrapper.is(":visible");
                    applyTableVisibility(newState);
                    localStorage.setItem("isTableVisible", newState);
                    if (newState) {
                        // ถ้าตารางถูกเปิด ให้วาดใหม่เพื่อรีเฟรชข้อมูล/สถานะ
                        table.draw(false);
                    }
                });
            }

            function filterDataTableByRooms() {
                let selectedRooms = $(".room-filter:checked").map(function() {
                    return this.value;
                }).get();
                // 1. สร้างค่า Regex สำหรับคอลัมน์ Room ที่บังคับการจับคู่แบบตรงตัว (ใช้ ^ และ $)
                let searchVal;
                if (selectedRooms.length === 0) {
                    // หากไม่มีการเลือกห้องเลย ให้ค้นหาสตริงว่าง (ไม่มีรายการใดตรง)
                    searchVal = "^$";
                } else {
                    // สำคัญ: เพิ่ม ^ และ $ ให้ครอบชื่อห้องแต่ละชื่อ
                    // เช่น: selectedRooms = ["Meeting 1", "Meeting 3"]
                    // newRegex = "^(Meeting 1|Meeting 3)$"
                    const escapedRooms = selectedRooms.map(room => {
                        // escape อักขระพิเศษในชื่อห้อง (ถ้ามี) เช่น วงเล็บ ( )
                        return room.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                    });
                    searchVal = "^(" + escapedRooms.join("|") + ")$";
                }
                // 2. เคลียร์การค้นหาของคอลัมน์ 0 ก่อน
                table.column(0).search('');
                // 3. กรองคอลัมน์ 0 (Room) ด้วย Regex แบบ Exact Match
                // (search, regex, smart, case_insensitive)
                table.column(0).search(searchVal, true, false).draw();
                // 4. บังคับซิงค์ Calendar ตามผลลัพธ์ใหม่ของตาราง
                // (เนื่องจากการเรียก .draw() จะเรียก event 'draw.dt' และนำไปสู่ syncCalendarWithDataTable())
            }

            function applyRoomFilter(updateTable = true) {
                let selectedRooms = $(".room-filter:checked").map(function() {
                    return this.value;
                }).get();
                // 1. ตรรกะสำหรับ FullCalendar: แสดงเมื่อ Room อยู่ใน selectedRooms
                const filterFunc = evt => selectedRooms.includes(evt.extendedProps.room) ? "auto" : "none";
                // FullCalendar Filter
                calendar.getEvents().forEach(evt => evt.setProp("display", filterFunc(evt)));
                miniCal.getEvents().forEach(evt => evt.setProp("display", filterFunc(evt)));
                if (updateTable) {
                    filterDataTableByRooms();
                }
            }

            function syncCalendarWithDataTable() {
                // รับ id ของรายการที่แสดงผลในตารางหลังการกรอง/ค้นหา
                let visibleIds = table.rows({
                    search: "applied"
                }).data().toArray().map(item => String(item.id));
                const syncFunc = evt => visibleIds.includes(String(evt.id)) ? "auto" : "none";
                // ซ่อน Event ใน Calendar ที่ไม่อยู่ในตาราง
                calendar.getEvents().forEach(evt => evt.setProp("display", syncFunc(evt)));
                miniCal.getEvents().forEach(evt => evt.setProp("display", syncFunc(evt)));
            }
            let isTableSyncing = false;

            function updateRoomFilterByTable() {
                // ฟังก์ชันนี้ป้องกันการ Loop ระหว่าง Datatable search และ Room filter Checkbox
                if (isTableSyncing) return;
                let visibleData = table.rows({
                    search: "applied"
                }).data().toArray();
                let rooms = [...new Set(visibleData.map(item => item.room))]; // ห้องที่แสดงอยู่ในตารางปัจจุบัน
                if (table.search() === '' && table.column(0).search() === '') {
                    // ถ้าไม่มีการค้นหาใด ๆ เลย ให้ใช้ค่าเดิมจาก Local Storage
                    loadRoomFilterState(false);
                } else {
                    // ถ้ามีการค้นหา/กรองเกิดขึ้น ให้ซิงค์ Checkbox ตามผลลัพธ์ของตาราง
                    isTableSyncing = true;
                    $(".room-filter").each(function() {
                        this.checked = rooms.includes(this.value);
                    });
                    saveRoomFilterState();
                    isTableSyncing = false;
                }
            }

            function handleBookingSubmit(e) {
                e.preventDefault();
                const formData = new FormData(e.target);
                const bookingData = Object.fromEntries(formData.entries());
                // จำลองการจอง (ในระบบจริงต้องส่งไป Server)
                console.log("New Booking Data Submitted (Simulated):", bookingData);
                alert(`จองห้อง "${bookingData.room}" สำเร็จ! (Title: ${bookingData.title})`);
                bootstrap.Modal.getInstance(document.getElementById("bookingModal")).hide();
                $("#bookingForm")[0].reset();
                // ในระบบจริง เมื่อ Server ตอบกลับสำเร็จ ค่อยเรียก reload
                // ในโค้ดตัวอย่างนี้จะ reload เพื่อให้แสดงข้อมูลใหม่ (ถ้า data.json ถูกอัปเดต)
                table.ajax.reload(function() {
                    // เมื่อตารางโหลดเสร็จ ให้รีเฟรช Calendar
                    calendar.refetchEvents();
                    miniCal.refetchEvents();
                    // นำไปยังวันที่เพิ่งจอง
                    calendar.gotoDate(bookingData.meeting_date);
                    // กรองตารางใหม่เผื่อมีการเลือก Filter อยู่
                    filterDataTableByRooms();
                }, false);
            }
        });
    </script>
</body>

</html>