<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AS Brand Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center">

  <div class="card w-full max-w-lg shadow-xl bg-base-100">
    <div class="card-body">
      <h2 class="card-title text-xl font-bold mb-4">จัดการแบรนด์ (AS Brand)</h2>
      
      <!-- ฟอร์ม -->
      <form action="#" method="POST" class="space-y-4">
        
        <!-- Brand Name -->
        <div>
          <label class="label">
            <span class="label-text font-semibold">ชื่อแบรนด์</span>
          </label>
          <input type="text" name="brand" placeholder="เช่น Dell, Lenovo" 
                 class="input input-bordered w-full" required />
        </div>

        <!-- Create By -->
        <div>
          <label class="label">
            <span class="label-text font-semibold">สร้างโดย</span>
          </label>
          <input type="text" name="create_by" placeholder="เช่น system หรือ admin" 
                 class="input input-bordered w-full" />
        </div>

        <!-- Update By -->
        <div>
          <label class="label">
            <span class="label-text font-semibold">แก้ไขโดย</span>
          </label>
          <input type="text" name="update_by" placeholder="ชื่อผู้แก้ไขล่าสุด" 
                 class="input input-bordered w-full" />
        </div>

        <!-- ปุ่ม -->
        <div class="flex justify-end gap-2 mt-4">
          <button type="reset" class="btn btn-ghost">ยกเลิก</button>
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
