<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DaisyUI + Flatpickr inside Modal (Fixed)</title>

  <!-- DaisyUI + Tailwind -->
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  <!-- Flatpickr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <style>
    /* ให้ popup อยู่บนสุด */
    .flatpickr-calendar {
      z-index: 999999 !important;
      border-radius: 0.75rem;
      box-shadow: 0 4px 16px rgba(0,0,0,0.25);
    }
  </style>
</head>
<body class="min-h-screen bg-base-200 flex flex-col items-center justify-center">

  <button class="btn btn-primary" onclick="my_modal.showModal()">เปิดฟอร์ม</button>

  <!-- Modal -->
  <dialog id="my_modal" class="modal">
    <div class="modal-box">
      <h3 class="font-bold text-lg mb-4">เลือกวันที่ (Flatpickr)</h3>

      <label class="form-control w-full mb-4">
        <div class="label">
          <span class="label-text">วันที่</span>
        </div>
        <input id="dateInput" type="text" class="input input-bordered w-full" placeholder="เลือกวันที่..." />
      </label>

      <div class="modal-action">
        <form method="dialog">
          <button class="btn">ปิด</button>
        </form>
      </div>
    </div>
  </dialog>

  <script>
    // ✅ แก้จุด popup อยู่ใต้ modal โดยใช้ appendTo: document.body
    flatpickr("#dateInput", {
      dateFormat: "Y-m-d",
      defaultDate: "today",
      allowInput: true,
      appendTo: document.body // สำคัญมาก!
    });
  </script>
</body>
</html>
