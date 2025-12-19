<?php
// save_booking.php
header('Content-Type: application/json');
require_once 'db.php'; // เรียกไฟล์เชื่อมต่อฐานข้อมูลตัวเดิม

// ตรวจสอบว่าเป็น Request แบบ POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

try {
    // 1. รับค่าจาก Form Data (ชื่อตัวแปรต้องตรงกับ name="..." ใน HTML input)
    $title = $_POST['title'] ?? '';
    $room = $_POST['room'] ?? ''; // ชื่อห้อง เช่น "Meeting 1"
    // $operating_unit = $_POST['operating_unit'] ?? '';
    $operating_unit = 'Information Technology' ?? '';
    $start = $_POST['start'] ?? '';
    $end = $_POST['end'] ?? '';
    // $booked_by = $_POST['booked_by'] ?? '';
    $booked_by = 'Adinan Hayeedaramae' ?? '';
    $note = $_POST['note'] ?? '';
    $status = $_POST['status'] ?? 'Draft';
    
    // รับค่า subject (ถ้าในฟอร์มไม่มีให้ใส่ค่าว่าง หรือแก้โค้ดส่วนนี้ออก)
    $subject = $_POST['subject'] ?? ''; 

    // 2. Validation ตรวจสอบค่าว่าง (ปรับเพิ่มลดได้ตามต้องการ)
    if (empty($title) || empty($room) || empty($start) || empty($end) || empty($booked_by)) {
        throw new Exception('กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน');
    }

    // 3. เตรียมคำสั่ง SQL Insert
    // booked_time ใช้ NOW() เพื่อเก็บเวลาปัจจุบันที่บันทึก
    $sql = "INSERT INTO room_booking 
            (title, subject, room, operating_unit, booked_by, start, end, status, note, booked_time) 
            VALUES 
            (:title, :subject, :room, :operating_unit, :booked_by, :start, :end, :status, :note, NOW())";

    $stmt = $pdo->prepare($sql);

    // 4. ผูกตัวแปรและรันคำสั่ง (Execute)
    $result = $stmt->execute([
        ':title' => $title,
        ':subject' => $subject,
        ':room' => $room,
        ':operating_unit' => $operating_unit,
        ':booked_by' => $booked_by,
        ':start' => $start,
        ':end' => $end,
        ':status' => $status,
        ':note' => $note
    ]);

    // 5. ส่งผลลัพธ์กลับไปที่หน้าเว็บ
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'จองห้องสำเร็จ!']);
    } else {
        throw new Exception('ไม่สามารถบันทึกข้อมูลได้');
    }

} catch (Exception $e) {
    // กรณีเกิด Error (เช่น Database เชื่อมต่อไม่ได้ หรือ SQL ผิด)
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>