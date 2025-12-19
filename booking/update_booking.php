<?php
header('Content-Type: application/json');

// 1. เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูลเดิมของคุณ
require_once 'db.php';

// 2. รับค่าที่ส่งมาจาก Ajax
$id = isset($_POST['id']) ? $_POST['id'] : '';
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$room = $_POST['room'];
$note = $_POST['note'];

// ตรวจสอบว่ามี ID ส่งมาหรือไม่
if (empty($id)) {
    echo json_encode(['success' => false, 'message' => 'ไม่พบ ID รายการที่ต้องการแก้ไข']);
    exit();
}

try {
    // 3. เตรียมคำสั่ง SQL (เปลี่ยนชื่อตาราง 'bookings' ให้ตรงกับ database จริงของคุณ)
    // เราจะไม่ update status, booked_by, operating_unit เพราะเป็นค่าคงที่ในที่นี้
    $sql = "UPDATE bookings SET 
                title = :title, 
                start = :start, 
                end = :end, 
                room = :room, 
                note = :note 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    // 4. ผูกตัวแปรและรันคำสั่ง (Execute)
    $result = $stmt->execute([
        ':title' => $title,
        ':start' => $start,
        ':end' => $end,
        ':room' => $room,
        ':note' => $note,
        ':id' => $id
    ]);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'บันทึกการแก้ไขเรียบร้อยแล้ว']);
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่สามารถบันทึกข้อมูลได้']);
    }

} catch (PDOException $e) {
    // กรณีเกิด Error จาก Database
    echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
}
?>