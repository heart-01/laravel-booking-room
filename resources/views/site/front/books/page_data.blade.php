<fieldset id="page_data">
  <div class="form-card">
    <div class="row mb-5">
      <div class="col-7">
        <h2 class="fs-title">กรอกข้อมูลเพื่อค้นหาห้องว่าง</h2>
      </div>
      <div class="col-5">
        <h2 class="steps">Step 1 - 5</h2>
      </div>
    </div>
    
    <?= Form::label('semester', 'ภาคการศึกษา '.$txtHeader, ['class' => 'h5 mb-5']); ?>
    <div id="div-semester" class="form-group mb-5">
      <?= Form::select('semester', [$semesters => $txt_semesters], $semesters, ['class' => 'form-control form-control-custom selectpicker', 'dropupAuto' =>'false', 'data-size' =>'5',
      'data-live-search' =>'false', 'title'=> 'เลือกภาคการศึกษา']); ?>
    </div>

    <div class="form-row mb-5">
      <div id="dDroom" class="form-group col-md-2">
          <?= Form::label('Droom', 'วันจองห้อง :* ', ['class' => 'h5']); ?>
          <?= Form::select('Droom', App\Classrooms::Droom(), null, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'data-size' =>'6',
          'data-live-search' =>'false', 'title'=> 'เลือกวันที่จองห้อง']); ?>
      </div>
      <div id="dTroomS" class="form-group col-md-2">
          <?= Form::label('TroomS', 'เวลา :* ', ['class' => 'h5']); ?>
          <?= Form::select('TroomS', App\Classrooms::Troom(), null, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'data-size' =>'7',
          'data-live-search' =>'false', 'title'=> 'ตั้งแต่เวลา']); ?>
      </div>
      <div id="dTroomE" class="form-group col-md-2">
          <?= Form::label('TroomE', 'ถึง :* ', ['class' => 'h5']); ?>
          <?= Form::select('TroomE', App\Classrooms::Troom(), null, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'data-size' =>'7',
          'data-live-search' =>'false', 'title'=> 'ถึงเวลา']); ?>
      </div>
      <?= Form::hidden('semesters_id', $semesters_id, ['id'=> 'semesters_id']); ?>
    </div>

    {{-- <div class="form-group mt-5 mb-5">
      <?= Form::label('DTroom', 'วันเวลาที่ใช้ห้อง: *', ['class' => 'h5']); ?>
      <div id="DTusing" class="pull-right date-border">
        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
        <span id="DTshow"></span>
        <?= Form::hidden('DTroomS', null, ['id'=> 'DTroomS']); ?>
        <?= Form::hidden('DTroomE', null,  ['id'=> 'DTroomE']); ?>
      </div>
    </div>&nbsp; --}}

    <div class="form-group mb-5">
      <?= Form::label('seats', 'จำนวนนักศึกษา: *', ['class' => 'h5']); ?>
      <?= Form::number('seats', null, ['class' => 'form-control mb-3 bg-white input-no-spinner', 'placeholder' => 'กรอกเลขจำนวนนักศึกษา', 'autocomplete'=> 'off','maxlength' =>'3','required','onKeyPress'=>'if(this.value.length==3) return false;','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
    </div>

    <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}" ></div>
  </div> 

  <button id="next-data" class="next action-button mt-5">
    ถัดไป <i class="fas fa-sign-in-alt ml-1"></i>
  </button>    

</fieldset>