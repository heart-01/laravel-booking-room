<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีพอร์ต <?php echo App\Semesters::term_year($semesters); ?>  {{ $classrooms }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin/reportPDF.css') }}">
</head>
<body>
    <h3 style="text-align: center;">รีพอร์ต <?php echo App\Semesters::term_year($semesters); ?>  {{ $classrooms }}</h3>
    <table width='100%' style='border-collapse: collapse; border: 0px;'>
        <tr>
            <th class="bor fz active" >ลำดับ</th>
            <th class="bor fz active" >อาจารย์ผู้สอน</th>
            <th class="bor fz active" >คณะ</th>
            <th class="bor fz active" >ภาควิชา</th>
            <th class="bor fz active" >รหัสวิชา</th>
            <th class="bor fz active" >วิชา</th>
            <th class="bor fz active" >ตอน</th>
            <th class="bor fz active" >นักศึกษา</th>
            <th class="bor fz active" >วัน</th>
            <th class="bor fz active" >เวลา</th>
            <th class="bor fz active" >สถานะ</th>
        </tr>
        @foreach($data_bookings as $key => $row)
        <tr>
            <td class="bor fz" >{{ $key+1 }}</td>
            <td class="bor fz" >{{ $row->fname }} {{ $row->lname }}</td>
            <td class="bor fz" >{{ $row->faculty }}</td>
            <td class="bor fz" >{{ $row->department }}</td>
            <td class="bor fz" >{{ $row->course_code }}</td>
            <td class="bor fz" >{{ $row->subject }}</td>
            <td class="bor fz" >{{ $row->part }}</td>
            <td class="bor fz" >{{ $row->bookingSeats }}</td>
            <td class="bor fz" >{{ App\Classrooms::Droom($row->days) }}</td>
            <td class="bor fz" >{{ date('H:i', strtotime($row->time_start)).' - '.date('H:i', strtotime($row->time_end)) }}</td>
            <td class="bor fz" >{{ App\Classrooms::status($row->bookingStatus,1) }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>