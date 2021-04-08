@extends('layouts.front')

@section('sidebar')
  <hr style="margin-top: 65px;">
@endsection

@section('content')

    <style>
        .bt{
            margin-bottom: 480px;
        }
    </style>

    <div id="page_BookingUpdate" class="container">
        <a id="back-history" class="btn btn-secondary text-white mb-3" href="{{ route('history') }}">
            <i class="fas fa-chevron-left mr-1"></i> กลับไป
        </a>
        <h1 class="text-center mb-5" style="font-size: 30px;">แก้ไขข้อมูลการจองห้องเรียน</h1>
        <?= Form::open(array('id' => 'frmBookingUpdate')) ?>
        <div id="data_detail" class="row">
          <div class="form-group col-md-6 col-sm-12">
            <?= Form::label('fname', 'ชื่อ: *', ['class' => 'h5']); ?>
            <?= Form::text('fname', $data->fname, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ชื่อผู้สอน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[\.ก-๏a-zA-Z]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <?= Form::label('lname', 'นามสกุล: *', ['class' => 'h5']); ?>
            <?= Form::text('lname', $data->lname, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'นามสกุลผู้สอน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[\.ก-๏a-zA-Z]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <?= Form::label('email', 'E-mail: *', ['class' => 'h5']); ?>
            <?= Form::email('email', $data->email, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'อีเมล', 'autocomplete'=> 'off','maxlength' =>'50' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          </div>
          <div class="form-group col-md-6 col-sm-12">
            <?= Form::label('tel', 'เบอร์ภายใน: *', ['class' => 'h5']); ?>
            <?= Form::text('tel', $data->tel, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'เบอร์โทรติดต่อภายใน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[\-\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          </div>
          <div class="form-group col-md-3 col-sm-12">
            <?= Form::label('faculty', 'คณะ: *', ['class' => 'h5']); ?>
            <?= Form::text('faculty', $data->faculty, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ชื่อคณะ', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          </div>
          <div class="form-group col-md-3 col-sm-12">
            <?= Form::label('department', 'ภาควิชา: *', ['class' => 'h5']); ?>
            <?= Form::text('department', $data->department, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ชื่อภาควิชา', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          </div>
          <div class="form-group col-md-3 col-sm-12">
            <?= Form::label('subject', 'วิชา: *', ['class' => 'h5']); ?>
            <?= Form::text('subject', $data->subject, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ชื่อวิชาเรียน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          </div>
          <div class="form-group col-md-3 col-sm-12">
            <?= Form::label('course_code', 'รหัสวิชา: *', ['class' => 'h5']); ?>
            <?= Form::text('course_code', $data->course_code, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'รหัสวิชาเรียน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
            </div>
          <div class="form-group col-md-3 col-sm-12">
            <?= Form::label('part', 'ตอนเรียน: *', ['class' => 'h5']); ?>
            <?= Form::text('part', $data->part, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ตอนเรียนที่', 'autocomplete'=> 'off','maxlength' =>'50', 'required', 'style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
            {{-- <?= Form::number('part', $data->part, ['class' => 'form-control form-control-custom mb-3 bg-white input-no-spinner', 'placeholder' => 'ตอนเรียนที่', 'autocomplete'=> 'off','maxlength' =>'2','required','onKeyPress'=>'if(this.value.length==2) return false;','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?> --}}
          </div>
          <div class="form-group col-md-12 col-sm-12">
            <?= Form::label('selSoftwares', 'โปรแกรมที่ใช้ในการสอน: *(สามารถเลือกได้มากกว่า 1 โปรแกรม)', ['class' => 'h5']); ?>
            <?= Form::select('selSoftwares[]', App\Softwares::all()->pluck('softwares', 'softwares_id'), $selSoftwares, ['class' => 'form-control form-control-custom selectpicker', 'multiple', 'required', 'dropupAuto' =>'false', 'data-size' =>'5', 'data-live-search' =>'true', 'title'=> 'เลือกโปรแกรมที่ใช้ในการสอน']); ?>
          </div>
          <div class="form-group col-md-12 col-sm-12">
            <?= Form::label('otherSofware', 'โปรแกรมอื่น ๆ : ', ['class' => 'h5']); ?>
            <?= Form::text('otherSofware', isset($otherSofware[0])?$otherSofware[0]:null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'เช่น Microsoft Word , Adobe Premiere Pro', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\-\d,]+$' ,'style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
            <small  class="form-text text-muted">
              - Software ที่จะใช้ต้องไม่ละเมิดลิขสิทธิ์<br>
              - Software ที่จะใช้ต้องส่งแผ่นหรือไฟล์ติดตั้งมาที่สำนักคอมฯ ก่อนเปิดภาคเรียนอย่างน้อย 2 สัปดาห์
            </small >
          </div>
        </div>
        <?= Form::hidden('classID', $EncryptBookingsId, ['id' => 'classID'],); ?>
        <?= Form::hidden('classrooms', $nameClass, ['id' => 'classrooms'],); ?>

        <button type="submit" id="btnfrmBookingUpdate" class="btn btn-success btn-block mt-5"><i class="fas fa-calendar-check mr-1"></i> ยืนยัน</button>
        <?= Form::close() ?>

    </div>

    <div class="container text-center"><img src="https://i.pinimg.com/originals/58/4b/60/584b607f5c2ff075429dc0e7b8d142ef.gif" id="loading" style="display:none;" class="bt" width="150px;" /></div>

    <script>
        var config = {
              routes: {
                history: "{{ route('history') }}",
                bookUpdate: "{{ route('book.update') }}",
              }
        };
    </script>
    <script src="{{ asset('js/front/historyBook/displayUpdate.js') }}"></script>
@endsection