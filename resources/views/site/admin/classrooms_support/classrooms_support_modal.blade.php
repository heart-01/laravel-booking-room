<!-- modal Add -->
<div class="modal fade" id="showAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="font-family: kanit;">
            <div class="modal-header text-white bg-primary">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-broom"></i> สิ่งอำนวยความสะดวก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?= Form::open(array('route' => 'classrooms_support.store','id' => 'frmAdd')) ?>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-group">
                            <?= Form::label('classrooms_support', 'ชื่อสิ่งอำนวยความสะดวก : '); ?>
                            <?= Form::text('classrooms_support', null, ['class' => 'form-control', 'placeholder' => 'ชื่อสิ่งอำนวยความสะดวก', 'autocomplete'=> 'off','maxlength' =>'100','pattern' =>'^[ก-๏\sa-zA-Z]+$' ,'required']); ?>
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
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-pencil-alt"></i> แก้ไขรายการซอฟแวร์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= Form::open(array('route' => 'classrooms_support.update')) ?>
                <div class="form-group">
                    <div class="form-group">
                        <?= Form::label('classrooms_support-edit', 'ชื่อสิ่งอำนวยความสะดวก : '); ?>
                        <?= Form::text('classrooms_support-edit', null, ['class' => 'form-control', 'placeholder' => 'ชื่อสิ่งอำนวยความสะดวก', 'autocomplete'=> 'off','maxlength' =>'100','pattern' =>'^[ก-๏\sa-zA-Z]+$' ,'required']); ?>
                        <?= Form::hidden('classrooms_support_id-edit', null, ['id' => 'classrooms_support_id-edit'],); ?>
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
            $('#classrooms_support').trigger('focus');
        });
    });
</script>
<script src="{{ asset('/js/admin/classrooms_support/classrooms_support_modal.js') }}" type="text/javascript"></script>