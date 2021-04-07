<!-- modal Add -->
<div class="modal fade" id="showAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="font-family: kanit;">
            <div class="modal-header text-white bg-primary">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt"></i> เพิ่มภาคการศึกษา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?= Form::open(array('route' => 'semesters.store','id' => 'frmAdd')) ?>
                <div class="form-group">
                    <div class="form-group">
                        <?= Form::label('term', 'เทอม : '); ?>
                        <?= Form::select('term', ['1' => '1', '2' => '2'], null, ['class' => 'form-control mb-2','placeholder' => 'เลือกเทอมการศึกษา' ,'required']);?>
                        <?= Form::label('year', 'ปีการศึกษา : '); ?>
                        <?= Form::select('year', App\Semesters::selectYear(), null, ['class' => 'form-control mb-2','placeholder' => 'เลือกปีการศึกษา' ,'required']);?>
                        <?= Form::label('semesters_start', 'วันเริ่มภาคเรียน : '); ?>
                        <input class="input-medium form-control mb-2" name="semesters_start" type="text" data-provide="datepicker" data-date-language="th-th" data-date-start-date="{{date('d/m/Y')}}" autocomplete="off" required>
                        <?= Form::label('semesters_end', 'วันสิ้นสุดภาคเรียน : '); ?>
                        <input class="input-medium form-control mb-2" name="semesters_end" type="text" data-provide="datepicker" data-date-language="th-th" data-date-start-date="{{date('d/m/Y')}}" autocomplete="off" required>
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
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-pencil-alt"></i> แก้ไขภาคการศึกษา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= Form::open(array('route' => 'semesters.update')) ?>
                <div class="form-group">
                    <div class="form-group">
                        <?= Form::hidden('semesters_id-edit', null, ['id' => 'semesters_id-edit'],); ?>
                        <?= Form::label('term-edit', 'เทอม : '); ?>
                        <?= Form::select('term-edit', ['1' => '1', '2' => '2'], null, ['class' => 'form-control mb-2','placeholder' => 'เลือกเทอมการศึกษา' ,'required']);?>
                        <?= Form::label('year-edit', 'ปีการศึกษา : '); ?>
                        <?= Form::select('year-edit', App\Semesters::selectYear(), null, ['class' => 'form-control mb-2','placeholder' => 'เลือกปีการศึกษา' ,'required']);?>
                        <?= Form::label('semesters_start_edit', 'วันเริ่มภาคเรียน : '); ?>                        
                        <input class="input-medium form-control mb-2" id="semesters_start_edit" name="semesters_start_edit" type="text"  data-provide="datepicker" data-date-language="th-th" data-date-start-date="{{date('d/m/Y')}}" autocomplete="off" required>
                        <?= Form::label('semesters_end_edit', 'วันสิ้นสุดภาคเรียน : '); ?>
                        <input class="input-medium form-control mb-2" id="semesters_end_edit" name="semesters_end_edit" type="text" data-provide="datepicker" data-date-language="th-th" data-date-start-date="{{date('d/m/Y')}}" autocomplete="off" required>
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
            $('#name').trigger('focus');
        });
    });
</script>
<script src="{{ asset('/js/admin/semesters/semesters_modal.js') }}" type="text/javascript"></script>