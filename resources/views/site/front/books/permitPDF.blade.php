<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มขอใช้ห้องเรียนสำนักคอม</title>
    <link rel="stylesheet" href="{{ asset('css/front/books/permitPDF.css') }}">
</head>
<body>
    <h1 class="center">แบบฟอร์มขอใช้ห้องเรียนสำนักคอม</h1>
    <div class="fontL"><b>1. ผู้ขออนุมัติใช้ห้องประชุม</b></div>
        <dd class="fontL">ชื่อ <span class="ml">{{ $data->fname }} {{ $data->lname }}</span> </dd>
        <dd class="fontL">Email <span class="ml">{{ $data->email }}</span> </dd>
        <dd class="fontL">เบอร์ภายใน <span class="ml">{{ $data->tel }}</span> </dd>
        <dd class="fontL">คณะ <span class="ml">{{ $data->faculty }}</span> </dd>
        <dd class="fontL">วิชา <span class="ml">{{ $data->subject }}</span> </dd>
        <dd class="fontL">รหัสวิชา <span class="ml">{{ $data->course_code }}</span> </dd>
        <dd class="fontL">ตอนเรียน <span class="ml">{{ $data->part }}</span> </dd>
    <div class="fontL"><b>2. วันที่ขอใช้</b></div>
        <dd class="fontL">
            <span class="ml">วัน</span> <span class="ml">{{ App\Classrooms::Droom($data->days) }}</span>
            <span class="ml">เวลา</span> <span class="ml">{{ date('H:i', strtotime($data->time_start)) }} </span> <span class="ml">ถึง</span> <span class="ml">{{ date('H:i', strtotime($data->time_end)) }}</span> </span>
        </dd>
    <div class="fontL"><b>3. จำนวนนักเรียน</b> <span class="ml">{{ $data->seats }}</span> <b><span class="ml">คน</span></b></div>
    
    <div class="fontL mt"><b>** หมายเหตุ</b>
        <span class="ml">กรุณาส่งแบบฟอร์มภายใน 15 วัน มิฉะนั้นการจองในครั้งนี้จะถูกยกเลิกโดยอัตโนมัติ</span>
    </div>

    <div style="margin-top: 70px;" class="right">
        <div style="margin-right: 20px;">ลงชื่อ .................................................................</div>
        <div style="margin-right: 20px;">(.........................................................................)</div>
        <div style="margin-right: 50px;">อาจารย์ผู้สอนประจำรายวิชา</div>
        <div style="margin-right: 20px;">วันที่ ..................../....................../......................</div>
    </div>

    <div style="margin-top: 70px;" class="right">
        <div style="margin-right: 20px;">ลงชื่อ .................................................................</div>
        <div style="margin-right: 20px;">(.........................................................................)</div>
        <div>ผู้อำนวยการสำนักคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</div>
        <div style="margin-right: 20px;">วันที่ ..................../....................../......................</div>
    </div>

</body>
</html>