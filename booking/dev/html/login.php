<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Meeting Room Booking</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    
    <style>
        /* นำเข้าฟอนต์จากโปรแกรมหลัก */
        @import 'https://cdn.jsdelivr.net/gh/lazywasabi/thai-web-fonts@7/fonts/LINESeedSansTH/LINESeedSansTH.css';
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Quicksand:wght@300..700&display=swap');

        /* ตัวแปรธีม: ต้องสอดคล้องกับ main.html */
        :root {
            --font-main: "Quicksand", "LINE Seed Sans TH", sans-serif;
            --bg-light: #fff;
            --text-light: #000;
            --bg-dark: #121212;
            --text-dark: #fff;
            --card-dark: #1f1f1f;
            --border-dark: #333;
        }

        /* การตั้งค่า Layout พื้นฐาน */
        html, body {
            height: 100%;
            /* ลบ display:flex, justify-content, align-items ออกจาก body */
            /* เพราะจะไปใส่ใน .container แทน เพื่อให้ควบคุมง่ายกว่า */
            font-family: var(--font-main);
            transition: background-color 0.3s, color 0.3s;
        }
        
        /* 🔥 NEW: .container ที่จะจัดให้ content อยู่ตรงกลางและใช้ความสูงเต็มที่ */
        .container {
            flex-grow: 1; /* ให้ container ขยายเต็มพื้นที่ที่เหลือใน body */
            display: flex; /* ใช้ flexbox จัดกึ่งกลาง card */
            justify-content: center;
            align-items: center;
            height: 100%; /* สำคัญมากเพื่อให้จัดกึ่งกลางแนวตั้งได้ */
        }

        
        .logo-subtext {
    /* ทำให้ข้อความย่อยลอยออกมาจาก Flow */
    position: absolute;
    /* จัดกึ่งกลางแนวนอน */
    left: 50%;
    transform: translateX(-50%);
    /* กำหนดตำแหน่งจากด้านบนเพื่อให้อยู่ตรงกลาง/ทับโลโก้ */
    /* ปรับค่า top เพื่อควบคุมการทับ (125px เป็นค่าประมาณสำหรับโลโก้ 150px) */
    top: 150px; /* ปรับค่านี้เพื่อให้ข้อความอยู่ใต้ตัวโลโก้ CMO */
    width: 100%; /* สำคัญสำหรับการจัดกึ่งกลางแนวนอน */
    line-height: 1; /* ปรับ line-height หากจำเป็น */
}

/* ปรับระยะห่างด้านล่างของโลโก้หลักให้น้อยลง */
.app-logo {
    margin-bottom: 0 !important; /* ยกเลิก mb-3/mb-4 ของ Bootstrap */
}


        /* Light Mode (ค่าเริ่มต้น) */
        body.light-mode {
            background-color: #f8f9fa; /* สีพื้นหลังสว่าง */
            color: var(--text-light);
        }
        
        /* สไตล์ Card สำหรับ Login Form */
        .login-card {
            /* ไม่ต้องกำหนด width ตรงนี้แล้ว เพราะจะใช้ Bootstrap col classes แทน */
            /* padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s; */

            padding: 40px; 
    border-radius: 12px;
    /* 🔥 แก้ไข: เพิ่มเงาให้ชัดเจนและนุ่มนวลขึ้นใน Light Mode */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); 
    transition: box-shadow 0.3s;
        }

        body.dark-mode .login-card {
    background-color: var(--card-dark) !important;
    border: 1px solid var(--border-dark);
    /* 🔥 แก้ไข: ใช้เงาที่เข้มและกว้างขึ้นเล็กน้อยสำหรับ Dark Mode */
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.7); 
}
        
        /* ลบ Media Query ที่เคยจำกัด width ออกไป */

        /* --- Dark Mode Styles --- */
        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        body.dark-mode .login-card {
            background-color: var(--card-dark) !important;
            border: 1px solid var(--border-dark);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }

        body.dark-mode .text-muted {
             /* ใช้สีเทาอ่อนมาก เช่น #ccc หรือ #aaa */
            color: #ccc !important; 
        }

        body.dark-mode #loginForm,
    body.dark-mode #loginForm label {
        color: var(--text-dark) !important; /* บังคับใช้สีขาว (#fff) กับ Label และข้อความทั้งหมดในฟอร์ม */
    }
        
        body.dark-mode .form-control {
            background-color: #2a2a2a;
            border-color: #555;
            color: var(--text-dark);
        }
        
        body.dark-mode .form-control:focus {
             background-color: #2a2a2a;
             border-color: #0d6efd;
             color: var(--text-dark);
        }

        body.dark-mode .input-group-text {
        background-color: #343a40; /* สีเทาเข้ม */
        border-color: #555; /* ขอบสีเดียวกับ Input */
        color: var(--text-dark); /* ไอคอนเป็นสีขาว */
    }

    body.dark-mode .btn-primary {
        /*
         * ตัวเลือกที่ 1: ใช้สีที่สว่างขึ้น (เช่น สีฟ้าที่สว่างกว่า Bootstrap standard)
         * ตัวเลือกที่ 2: ใช้สีเขียวหรือสีอื่นที่เป็น Accent Color
         */
        
        /* ตัวอย่าง: ใช้สีน้ำเงินที่สว่างกว่าเดิมเล็กน้อย (#3498db) */
        background-color: #3498db; 
        border-color: #3498db; 
        color: #fff; /* ข้อความบนปุ่มยังคงเป็นสีขาว */
    }
    
    /* สไตล์เมื่อนำเมาส์ไปชี้ (Hover) เพื่อให้ดูมีการตอบสนอง */
    body.dark-mode .btn-primary:hover {
        background-color: #2980b9; /* สีเข้มลงเล็กน้อยเมื่อ Hover */
        border-color: #2980b9;
    }
    body.dark-mode .form-control::placeholder { /* สำหรับมาตรฐาน */
        color: #999; 
        opacity: 1; /* ตรวจสอบให้แน่ใจว่าไม่มี opacity ลดลง */
    }
    
    /* สำหรับเบราว์เซอร์เก่า (Webkit/Firefox) */
    body.dark-mode .form-control:-ms-input-placeholder { /* IE 10-11 */
        color: #999;
    }
    body.dark-mode .form-control::-ms-input-placeholder { /* Edge */
        color: #999;
    }

    body.dark-mode h4 {
        color: var(--text-dark) !important; /* ให้ h4 เป็นสีขาว */
    }
    
    /* 🔥 NEW: การันตีสีสว่างสำหรับข้อความรอง "ระบบจองห้องประชุม" */
    body.dark-mode .text-muted {
         color: #ccc !important; /* ใช้สีเทาอ่อนที่สว่างขึ้น */
    }
        
        /* ปุ่มสลับธีม */
        #themeToggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: background-color 0.3s;
            z-index: 1000; /* ให้ปุ่มอยู่ด้านบนเสมอ */
        }
        #themeToggle:hover { background-color: #495057; }

    </style>
</head>
<body class="light-mode">
    
    <button id="themeToggle" title="สลับโหมดมืด/สว่าง"><i class="bi bi-moon"></i></button>

    <div class="container"> 
        <div class="card login-card col-11 col-md-8 col-lg-6 col-xl-4"> 
            <div class="text-center mb-4">
                <img src="images/logo-black.png" alt="CMO Logo Light" 
                    class="app-logo light-logo rounded-circle mb-3"
                    data-logo-type="light" width="150px">
                
                <img src="images/logo-white.png" alt="CMO Logo Dark" 
                    class="app-logo dark-logo rounded-circle mb-3 d-none"
                    data-logo-type="dark" width="150px">

                    <br>
<!-- <h4 class="mb-0">CMO</h4> -->
                <!-- <small class="text-muted">Facilities Management Service</small> -->

                <div class="logo-subtext">
            <small class="text-muted">Facilities Management Service</small>
        </div>
            </div>

            <form id="loginForm">
                <div class="mb-3">
                    <label for="username" class="form-label">USERNAME</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="username" placeholder="กรอกชื่อผู้ใช้งาน" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="กรอกรหัสผ่าน" required>
                    </div>
                </div>
                
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i> LOGIN
                    </button>
                </div>
                
                <!-- <div class="text-center">
                     <a href="#" class="text-muted small">ลืมรหัสผ่าน?</a>
                </div> -->
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let darkMode = localStorage.getItem("darkMode") === "true";
            
            // 1. Initial Theme Load
            applyTheme(darkMode);

            // 2. Theme Toggle Handler
            document.getElementById("themeToggle").addEventListener("click", function() {
                darkMode = !darkMode;
                localStorage.setItem("darkMode", darkMode);
                applyTheme(darkMode);
            });

            // 3. Apply Theme Function
            function applyTheme(isDark) {
                const body = document.body;
                const toggleBtn = document.getElementById("themeToggle");

                const lightLogo = document.querySelector('.light-logo');
            const darkLogo = document.querySelector('.dark-logo');

                if (isDark) {
                    body.classList.add("dark-mode");
                    body.classList.remove("light-mode");
                    toggleBtn.innerHTML = '<i class="bi bi-sun"></i>';

                    

                if (lightLogo) lightLogo.classList.remove('d-none');
                if (darkLogo) darkLogo.classList.add('d-none');
                } else {
                    body.classList.add("light-mode");
                    body.classList.remove("dark-mode");
                    toggleBtn.innerHTML = '<i class="bi bi-moon"></i>';

                  if (lightLogo) lightLogo.classList.add('d-none');
                if (darkLogo) darkLogo.classList.remove('d-none');
                }
            }

            // 4. Login Form Submission Handler (สำหรับการจำลอง)
            $("#loginForm").on("submit", function(e) {
                e.preventDefault();
                const username = $("#username").val();
                const password = $("#password").val();
                
                if (username && password) {
                    alert("เข้าสู่ระบบสำเร็จ! (Username: " + username + ")");
                    // ในโค้ดจริง: จะส่งข้อมูลไปตรวจสอบที่ Server และเปลี่ยนไปหน้าหลัก
                    // window.location.href = "index.html"; 
                } else {
                    alert("กรุณากรอกชื่อผู้ใช้งานและรหัสผ่าน");
                }
            });
        });
    </script>
</body>
</html>