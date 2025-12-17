<!DOCTYPE html>
<html>
<head>
    <title>My One-File Site</title>
    <style>
        /* All CSS code goes here */
        body { 
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 0;
        }
        .hidden { display: none; }
        .site-header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>

    <div id="header-placeholder" class="site-header">
        <h1>เว็บไซต์หน้าเดียว (Standalone)</h1>
        <nav>
            <a href="#home" style="color: white; margin: 0 10px;">หน้าหลัก</a> |
            <a href="#about" style="color: white; margin: 0 10px;">เกี่ยวกับ</a>
        </nav>
    </div>

    <div class="content">
        <img src="data:image/png;base64,iVBORw0KGg...[long encoded string]..." alt="Logo" style="max-width: 100px; display: block; margin-bottom: 20px;">
        
        <h2>หน้าหลัก</h2>
        <p>นี่คือเนื้อหาทั้งหมดของหน้าหลักที่รวมอยู่ในไฟล์ HTML เดียว</p>

        <section id="about" class="hidden">
            <h2>เกี่ยวกับเรา</h2>
            <p>ข้อมูลเกี่ยวกับบริษัท/โครงการของคุณ</p>
        </section>
    </div>
    
    <script>
        // โค้ด JavaScript สำหรับควบคุมการสลับหน้า (ถ้ามี)
        // เช่น การซ่อนและแสดงส่วนต่างๆ (Home/About) เมื่อคลิกลิงก์
        
        // ตัวอย่างการสลับไปหน้า About เมื่อคลิก
        document.querySelector('a[href="#about"]').addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('.content h2').textContent = 'เกี่ยวกับเรา';
            document.getElementById('about').classList.remove('hidden');
        });
        
        // หากไม่มีการควบคุมการแสดงผลที่ซับซ้อน ก็สามารถลบส่วน script นี้ทิ้งได้
    </script>
</body>
</html>