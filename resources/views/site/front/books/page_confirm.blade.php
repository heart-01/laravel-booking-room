<fieldset id="page_confirm">
    <div class="form-card">
      <div class="row">
        <div class="col-7">
          <h2 class="fs-title text-success">จองห้องเรียนสำเร็จ..</h2>
        </div>
        <div class="col-5">
          <h2 class="steps">Step 5 - 5</h2>
        </div>
      </div> 
      
      <div id="data_confirm" class="mt-3 container-fluid">
        <?= Form::open(array('route' => array('book.permitPDF'),'target' => '_blank')) ?>
          <div class="row mb-3">
            <div class="col-sm-12 col-md-6 text-left" style="font-size: 25px;">
              <a data-fancybox data-type="iframe" href="" id="con_name" class="fancybox mb-5">
                ห้องปฏิบัติการคอมพิวเตอร์ 407
              </a>
            </div>
            <div class="col-sm-12 col-md-6 d-none d-sm-none d-md-block d-lg-block text-left">
               
            </div>
          </div>
          <div class="text-left">
            <dl class="row">
              <dt class="col-sm-2">ชื่อ :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_fname', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_fname', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
    
              <dt class="col-sm-2">นามสกุล :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_lname', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_lname', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
            
              <dt class="col-sm-2">E-mail :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_email', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_email', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
    
              <dt class="col-sm-2">เบอร์ภายใน :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_tel', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_tel', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>

              <dt class="col-sm-2">คณะ :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_faculty', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_faculty', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>

              <dt class="col-sm-2">ภาควิชา :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_department', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_department', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
    
              <dt class="col-sm-2">วิชา :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_subject', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_subject', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
              
              <dt class="col-sm-2">รหัสวิชา :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_code', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_code', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
    
              <dt class="col-sm-2">ตอนเรียน :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_part', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_part', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
    
              <dt class="col-sm-2">จำนวนนักเรียน :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_seats', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_seats', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
    
              <dt class="col-sm-2">โปรแกรมที่ใช้ :</dt>
              <dd class="col-sm-10">
                <?= Form::select('con_Sof[]', App\Softwares::all()->pluck('softwares', 'softwares_id'), null, ['class' => 'form-control form-control-custom selectpicker con_Sof', 'disabled','multiple', 'required', 'dropupAuto' =>'false', 'data-size' =>'5', 'data-live-search' =>'true', 'title'=> 'เลือกโปรแกรมที่ใช้ในการสอน', 'id'=> 'con_Sof']); ?>
              </dd>
    
              <dt class="col-sm-2">โปรแกรมอื่น ๆ :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_otherSof', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_otherSof', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>

              <dt class="col-sm-2">ชื่อห้อง :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_Rname', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_Rname', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>

              <dt class="col-sm-2">วันจอง :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_DTs', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_DTs', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>

              <dt class="col-sm-2">เวลาจอง :</dt>
              <dd class="col-sm-10">
                <?= Form::text('con_DTe', null, ['class' => 'bg-white m-0 border-0', 'id'=> 'con_DTe', 'disabled', 'style'=> 'height: 20px; padding: 0px 0px 0px 0px;']); ?>
              </dd>
    
              <dt class="col-sm-2">สถานะ :</dt>
              <dd class="col-sm-10 text-warning"><i class="far fa-clock"></i> รออนุมัติ <small  class="form-text text-danger">* สถานะรออนุมัติ กรุณาส่งแบบฟอร์มภายใน 15 วัน มิฉะนั้นการจองในครั้งนี้จะถูกยกเลิกโดยอัตโนมัติ</small ></dd>
            </dl>
          </div>
          <?= Form::hidden('BookingsId', null, ['id' => 'BookingsLastIds'],); ?>  
          <!-- Submit -->
          <div class="text-left mb-3 d-none d-sm-none d-md-block d-lg-block">
            <button type="submit" id="btnPDF" class="btn btn-success btn-sm text-white"><i class="fas fa-download"></i> แบบฟอร์มขอใช้ห้อง</button>
        <?= Form::close() ?>
        <?= Form::open(array('route' => 'history.display.update','style' => 'display:inline;')) ?>
            <?= Form::hidden('BookingsId', null, ['id' => 'BookingsLastId'],); ?>  
            <button type="submit" id="btnEdit" class="btn btn-sm btn-warning text-white" style="margin-right: 100px;"><i class="fas fa-edit"></i> แก้ไขข้อมูลการจอง</button>
        <?= Form::close() ?>
            <button type="button" id="btnCancel" class="btn btn-danger btn-sm" style="margin-right: 100px;"><i class="far fa-times-circle"></i> ยกเลิกการจอง</button> 
          </div>
        
    
        <!-- Mobile -->
        <div class="d-block d-xl-none d-lg-none d-md-none">
          <div class="p-2">
            <button type="button" id="btnPDFsm" class="btn btn-sm btn-success btn-block text-white"><i class="fas fa-download"></i> แบบฟอร์มขอใช้ห้อง</button>
          </div>
          <div class="p-2">
            <button type="button" id="btnEditsm" class="btn btn-sm btn-warning btn-block text-white"><i class="fas fa-edit"></i> แก้ไขข้อมูลการจอง</button>
          </div>
          <div class="p-2">
            <button type="button" id="btnCancelsm" class="btn btn-sm btn-danger btn-block"><i class="far fa-times-circle"></i> ยกเลิกการจอง</button>
          </div>   
        </div>

      </div>
    </div>
</fieldset>