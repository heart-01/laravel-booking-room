<!-- modal Add -->
<div class="modal fade" id="showAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="font-family: kanit;">
            <div class="modal-header text-white bg-primary">
                <h5 class="modal-title" id="exampleModalLabel"><i class="nav-icon fas fa-chalkboard-teacher"></i> ห้องเรียน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?= Form::open(array('route' => 'classrooms.store','id' => 'frmAdd')) ?>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-group">
                            <?= Form::label('classrooms', 'ชื่อห้องเรียน : *'); ?>
                            <?= Form::text('classrooms', null, ['class' => 'form-control mb-3', 'placeholder' => 'ชื่อห้องเรียน', 'autocomplete'=> 'off','maxlength' =>'100','pattern' =>'^[ก-๏\sa-zA-Z]+$' ,'required']); ?>
                            <?= Form::label('numbers', 'หมายเลขห้อง : *'); ?>
                            <?= Form::text('numbers', null, ['class' => 'form-control mb-3', 'placeholder' => 'หมายเลขห้อง', 'autocomplete'=> 'off','maxlength' =>'100','pattern' =>'^[0-9]+$' ,'required']); ?>
                            <?= Form::label('seats', 'จำนวนที่นั่ง : *'); ?>
                            <?= Form::text('seats', null, ['class' => 'form-control mb-3', 'placeholder' => 'จำนวนที่นั่ง', 'autocomplete'=> 'off','maxlength' =>'100','pattern' =>'^[0-9]+$' ,'required']); ?>
                            <hr class="mb-3 mt-5">
                            <small  class="form-text text-muted">
                                * เว้นว่างหากไม่มีช่วงเวลางดจอง *
                            </small >
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <?= Form::label('prohibitDS', 'งดจองช่วงวัน : '); ?>
                                    <?= Form::select('prohibitDS', App\Classrooms::prohibitDate() , 0, ['class' => 'form-control']); ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <?= Form::label('prohibitTS', 'เวลา : '); ?>
                                    <?= Form::select('prohibitTS', App\Classrooms::prohibitTime() , 0, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'data-size' =>'3', 'data-live-search' =>'true',]); ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <?= Form::label('prohibitDE', 'ถึงวัน : '); ?>
                                    <?= Form::select('prohibitDE', App\Classrooms::prohibitDate() , 0, ['class' => 'form-control']); ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <?= Form::label('prohibitTE', 'เวลา : '); ?>
                                    <?= Form::select('prohibitTE', App\Classrooms::prohibitTime() , 0, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'data-size' =>'3', 'data-live-search' =>'true',]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>       
                <button type="submit" class="btn btn-success text-white"><i class="fas fa-sign-in-alt"></i> ยืนยัน</button>
            </div>
            <?= Form::close() ?>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="showEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="font-family: kanit;">
            <div class="modal-header text-white bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-pencil-alt"></i> แก้ไขห้องเรียน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= Form::open(array('route' => 'classrooms.update')) ?>
                <div class="form-group">
                    <div class="form-group">
                        <?= Form::label('classrooms-edit', 'ชื่อห้องเรียน : *'); ?>
                        <?= Form::text('classrooms-edit', null, ['class' => 'form-control mb-3', 'placeholder' => 'ชื่อห้องเรียน', 'autocomplete'=> 'off','maxlength' =>'100','pattern' =>'^[ก-๏\sa-zA-Z]+$' ,'required']); ?>
                        <?= Form::label('numbers-edit', 'หมายเลขห้อง : *'); ?>
                        <?= Form::text('numbers-edit', null, ['class' => 'form-control mb-3', 'placeholder' => 'หมายเลขห้อง', 'autocomplete'=> 'off','maxlength' =>'100','pattern' =>'^[0-9]+$' ,'required']); ?>
                        <?= Form::label('seats-edit', 'จำนวนที่นั่ง : *'); ?>
                        <?= Form::text('seats-edit', null, ['class' => 'form-control mb-3', 'placeholder' => 'จำนวนที่นั่ง', 'autocomplete'=> 'off','maxlength' =>'100','pattern' =>'^[0-9]+$' ,'required']); ?>
                        <?= Form::hidden('classrooms_id-edit', null, ['id' => 'classrooms_id-edit'],); ?>
                        <hr class="mb-3 mt-5">
                        <small  class="form-text text-muted">
                            * เว้นว่างหากไม่มีช่วงเวลางดจอง *
                        </small >
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <?= Form::label('prohibitDS-edit', 'งดจองช่วงวัน : '); ?>
                                <?= Form::select('prohibitDS-edit', App\Classrooms::prohibitDate() , 0, ['class' => 'form-control']); ?>
                            </div>
                            <div class="form-group col-md-3">
                                <?= Form::label('prohibitTS-edit', 'เวลา : '); ?>
                                <?= Form::select('prohibitTS-edit', App\Classrooms::prohibitTime() , 0, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'data-size' =>'3', 'data-live-search' =>'true',]); ?>
                            </div>
                            <div class="form-group col-md-3">
                                <?= Form::label('prohibitDE-edit', 'ถึงวัน : '); ?>
                                <?= Form::select('prohibitDE-edit', App\Classrooms::prohibitDate() , 0, ['class' => 'form-control']); ?>
                            </div>
                            <div class="form-group col-md-3">
                                <?= Form::label('prohibitTE-edit', 'เวลา : '); ?>
                                <?= Form::select('prohibitTE-edit', App\Classrooms::prohibitTime() , 0, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'data-size' =>'3', 'data-live-search' =>'true',]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>       
                <button type="submit" class="btn btn-success text-white"><i class="fas fa-sign-in-alt"></i> ยืนยัน</button>
            </div>
            <?= Form::close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#showAdd').on('shown.bs.modal', function() {
            $('#classrooms').trigger('focus');
        });
    });
</script>
<script src="{{ asset('/js/admin/classrooms/classrooms_modal.js') }}" type="text/javascript"></script>