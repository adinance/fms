<?php
header('Content-Type: application/json');
require_once 'db.php'; // เรียกไฟล์เชื่อมต่อฐานข้อมูลตัวเดิม

try {
    // 1. รับค่าช่วงเวลาจาก FullCalendar (เพื่อดึงเฉพาะเดือนที่จะแสดงผล)
    $start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-d');
    $end = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d', strtotime('+1 month'));

    // 2. คำสั่ง SQL: ดึงข้อมูลตรงๆ จากตาราง room_booking ได้เลย ไม่ต้อง JOIN
    // ตรวจสอบชื่อ Table ให้ตรงกับใน Database ของคุณ (สมมติว่าชื่อ room_booking)
    $sql = "SELECT * FROM room_booking ";
            // WHERE start >= :start AND end <= :end";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['start' => $start, 'end' => $end]);
    
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3. แปลงข้อมูลใส่ Array
    $events = [];

    foreach ($bookings as $row) {
        $events[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'subject' => $row['subject'],
            
            // แปลงรูปแบบวันที่ให้มี 'T' คั่นตามมาตรฐาน ISO8601 (FullCalendar ชอบแบบนี้)
            'start' => str_replace(' ', 'T', $row['start']), 
            'end' => str_replace(' ', 'T', $row['end']),
            
            // ดึงชื่อห้องจาก Database มาใช้ได้เลย เพราะตอนนี้เก็บเป็นชื่อแล้ว
            'room' => $row['room'], 
            
            'operating_unit' => $row['operating_unit'],
            'booked_by' => $row['booked_by'],
            'booked_time' => $row['booked_time'],
            'status' => $row['status'],
            'note' => $row['note']
        ];
    }

    // 4. ส่งค่ากลับเป็น JSON
    echo json_encode($events);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>