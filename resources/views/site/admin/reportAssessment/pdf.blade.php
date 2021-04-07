<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีพอร์ตแบบประเมินความพึงพอใจ {{ $semesters }}  {{ $classrooms }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin/reportPDF.css') }}">
</head>
<body>
    <h3 style="text-align: center;">รีพอร์ตแบบประเมินความพึงพอใจ {{ $semesters }}  {{ $classrooms }}</h3>
    <table width='100%' style='border-collapse: collapse; border: 0px;'>
        <tr>
            <th class="bor fz active" >ลำดับ</th>
            <th class="bor fz active" >ชื่อ</th>
            <th class="bor fz active" >คำถาม</th>
            <th class="bor fz active" >คะแนน</th>
            <th class="bor fz active" >วันที่ทำแบบประเมิน</th>
        </tr>
        @foreach($data_assessment as $key => $row)
            @if ($loop->first)
                <?php $ck = $row->suggestion; ?>
            @endif

            @if($ck != $row->suggestion)
            <tr>
                <td colspan="5" style="text-align: left;" class="bor fz" >&nbsp;ข้อเสนอแนะ : {{ $ck }}</td>
            </tr>
            @endif

            <tr>
                <td class="bor fz" >{{ $key+1 }}</td>
                <td class="bor fz" style="text-align: left;" >&nbsp;&nbsp;&nbsp;{{ $row->name }}</td>
                <td class="bor fz" style="text-align: left;" >&nbsp;&nbsp;&nbsp;{{ $row->question }}</td>
                <td class="bor fz" >{{ $row->score }}</td>
                <td class="bor fz" >{{ date('d-m-Y', strtotime('+543 year', strtotime($row->assCreate))) }}</td>
            </tr>

            @if ($loop->last)
            <tr>
                <td colspan="5" style="text-align: left;" class="bor fz" >&nbsp;ข้อเสนอแนะ : {{ $ck }}</td>
            </tr>
            @endif

            <?php $ck = $row->suggestion; ?>
        @endforeach
    </table>
</body>
</html>