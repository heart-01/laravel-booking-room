<!doctype html>
<html lang="en">
  <head>
    <title>Image</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script> 
    <!--Fancybox-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" />
    <!--Selected-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  </head>
  <body class="kanin" style="max-width: 1000px;height:800px;">
    <style>
        .kanin {
            font-family: 'Kanit', sans-serif;
        }
        .bootstrap-select .btn[data-id="con_Sof"] {
          background: #fff; cursor: default; border: 0px solid #ccc; padding: 0px 0px 0px 0px; height: 23px; clip: rect(0px 300px 23px 0px); position: absolute; left: 0px; bottom: -8px; color: black;
        }
    </style>
    <div class="col-2"></div>
    <div class="container-fluid col-10">
        <div class="row mb-3 mt-5">
            <div class="col-12 text-center" style="font-size: 25px;">
                <a data-fancybox data-type="iframe" href="{{ url('/showDetail/'.$href) }}" id="con_name" class="fancybox mb-5">
                    {{ $nameClass }}
                </a>
            </div>
        </div>
        <div class="text-left">
            <dl class="row">
            <dt class="col-sm-2">ชื่อ :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_fname', $data->fname, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_lname', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">นามสกุล :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_lname', $data->lname, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_fname', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>
            
            <dt class="col-sm-2">E-mail :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_email', $data->email, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_email', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">เบอร์ภายใน :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_tel', $data->tel, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_tel', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">คณะ :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_faculty', $data->faculty, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_faculty', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">ภาควิชา :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_department', $data->department, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_department', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">วิชา :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_subject', $data->subject, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_subject', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>
            
            <dt class="col-sm-2">รหัสวิชา :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_code', $data->course_code, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_code', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">ตอนเรียน :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_part', $data->part, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_part', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">จำนวนนักเรียน :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_seats', $data->seats, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_seats', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">โปรแกรมที่ใช้ :</dt>
            <dd class="col-sm-10">
                <?= Form::select('con_Sof[]', App\Softwares::all()->pluck('softwares', 'softwares_id'), $selSoftwares, ['class' => 'form-control form-control-custom selectpicker con_Sof', 'disabled','multiple', 'required', 'dropupAuto' =>'false', 'data-size' =>'5', 'data-live-search' =>'true', 'title'=> 'เลือกโปรแกรมที่ใช้ในการสอน', 'id'=> 'con_Sof']); ?>
            </dd>

            <dt class="col-sm-2">โปรแกรมอื่น ๆ :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_otherSof', isset($otherSofware[0])?$otherSofware[0]:null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_otherSof', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">ชื่อห้อง :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_Rname', $classrooms, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_Rname', 'disabled', 'style'=> 'height: 20px; width:300px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">วันจอง :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_DTs', App\Classrooms::Droom($data->days), ['class' => 'bg-white m-0 border-0', 'id'=> 'con_DTs', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">เวลาจอง :</dt>
            <dd class="col-sm-10">
                <?= Form::text('con_DTe', date('H:i', strtotime($data->time_start)).' - '.date('H:i', strtotime($data->time_end)), ['class' => 'bg-white m-0 border-0', 'id'=> 'con_DTe', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
            </dd>

            <dt class="col-sm-2">สถานะ :</dt>
            <dd class="col-sm-10 text-warning"><?php echo App\Classrooms::status($data->status); ?>
                @if($data->status==1) <small  class="form-text text-danger">* สถานะรออนุมัติ กรุณาส่งแบบฟอร์มภายใน 15 วัน มิฉะนั้นการจองในครั้งนี้จะถูกยกเลิกโดยอัตโนมัติ</small > @endif
            </dd>
            </dl>
        </div>
    </div>
    <!-- Selected -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  </body>
</html>