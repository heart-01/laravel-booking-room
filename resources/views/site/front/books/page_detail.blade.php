<fieldset id="page_detail">
    <div class="form-card">
      <div class="row">
        <div class="col-7">
          <h2 class="fs-title">กรอกรายละเอียดการจองห้อง:</h2>
        </div>
        <div class="col-5">
          <h2 class="steps">Step 4 - 5</h2>
        </div>
        <div class="d-flex ml-3 mb-5">
          <button id="back-detail" class="previous action-button-previous mr-auto p-2">
            <i class="fas fa-chevron-left mr-1"></i> กลับไป
          </button>
        </div>
      </div>
      <?= Form::open(array('id' => 'frmBooking')) ?>
      <div id="data_detail" class="row">
        <div class="form-group col-md-6 col-sm-12">
          <?= Form::label('fname', 'ชื่อ: *', ['class' => 'h5']); ?>
          <?= Form::text('fname', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ชื่อผู้สอน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[\.ก-๏a-zA-Z]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <?= Form::label('lname', 'นามสกุล: *', ['class' => 'h5']); ?>
          <?= Form::text('lname', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'นามสกุลผู้สอน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[\.ก-๏a-zA-Z]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <?= Form::label('email', 'E-mail: *', ['class' => 'h5']); ?>
          <?= Form::email('email', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'อีเมล', 'autocomplete'=> 'off','maxlength' =>'50' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
        </div>
        <div class="form-group col-md-6 col-sm-12">
          <?= Form::label('tel', 'เบอร์ภายใน: *', ['class' => 'h5']); ?>
          <?= Form::text('tel', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'เบอร์โทรติดต่อภายใน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[\-\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
        </div>
        <div class="form-group col-md-3 col-sm-12">
          <?= Form::label('faculty', 'คณะ: *', ['class' => 'h5']); ?>
          <?= Form::text('faculty', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ชื่อคณะ', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
        </div>
        <div class="form-group col-md-3 col-sm-12">
          <?= Form::label('subject', 'วิชา: *', ['class' => 'h5']); ?>
          <?= Form::text('subject', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ชื่อวิชาเรียน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
        </div>
        <div class="form-group col-md-3 col-sm-12">
          <?= Form::label('course_code', 'รหัสวิชา: *', ['class' => 'h5']); ?>
          <?= Form::text('course_code', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'รหัสวิชาเรียน', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\d]+$' ,'required','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          </div>
        <div class="form-group col-md-3 col-sm-12">
          <?= Form::label('part', 'ตอนเรียน: *', ['class' => 'h5']); ?>
          <?= Form::text('part', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'ตอนเรียนที่', 'autocomplete'=> 'off','maxlength' =>'50', 'required', 'style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          {{-- <?= Form::number('part', null, ['class' => 'form-control mb-3 bg-white input-no-spinner', 'placeholder' => 'ตอนเรียนที่', 'autocomplete'=> 'off','maxlength' =>'2','required','onKeyPress'=>'if(this.value.length==2) return false;','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?> --}}
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <?= Form::label('selSoftwares', 'โปรแกรมที่ใช้ในการสอน: *(สามารถเลือกได้มากกว่า 1 โปรแกรม)', ['class' => 'h5']); ?>
          <?= Form::select('selSoftwares[]', App\Softwares::all()->pluck('softwares', 'softwares_id'), null, ['class' => 'form-control form-control-custom selectpicker', 'multiple', 'required', 'dropupAuto' =>'false', 'data-size' =>'5', 'data-live-search' =>'true', 'title'=> 'เลือกโปรแกรมที่ใช้ในการสอน']); ?>
        </div>
        <div class="form-group col-md-12 col-sm-12">
          <?= Form::label('otherSofware', 'โปรแกรมอื่น ๆ : ', ['class' => 'h5']); ?>
          <?= Form::text('otherSofware', null, ['class' => 'form-control form-control-custom mb-3 bg-white', 'placeholder' => 'เช่น Microsoft Word , Adobe Premiere Pro', 'autocomplete'=> 'off','maxlength' =>'50','pattern' =>'^[ก-๏\sa-zA-Z\-\d,]+$' ,'style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
          <small  class="form-text text-muted">
            - Software ที่จะใช้ต้องไม่ละเมิดลิขสิทธิ์<br>
            - Software ที่จะใช้ต้องส่งแผ่นหรือไฟล์ติดตั้งมาที่สำนักคอมฯ ก่อนเปิดภาคเรียนอย่างน้อย 2 สัปดาห์
          </small >
        </div>
      </div>
      <?= Form::hidden('classID', null, ['id' => 'classID'],); ?>  
      <?= Form::hidden('semesters_id', null, ['id' => 'semesters_ids'],); ?>  
      <?= Form::hidden('days', null, ['id' => 'days'],); ?>  
      <?= Form::hidden('time_start', null, ['id' => 'time_start'],); ?>  
      <?= Form::hidden('time_end', null, ['id' => 'time_end'],); ?>  
      <?= Form::hidden('seat', null, ['id' => 'seat'],); ?>  
      <?= Form::hidden('classroomsName', null, ['id' => 'classroomsName'],); ?>  
      <button id="next-detail" type="submit" class="next action-button mt-5 bg-success">
        <i class="fas fa-calendar-check mr-1"></i> ยืนยัน
      </button>
      <?= Form::close() ?>
    </div> 
</fieldset>