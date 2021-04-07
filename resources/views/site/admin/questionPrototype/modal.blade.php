<!-- modal Add -->
<div class="modal fade" id="showAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="font-family: kanit;">
            <div class="modal-header text-white bg-primary">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt"></i> เพิ่มแบบสอบถาม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?= Form::open(array('route' => 'question.prototype.store','id' => 'frmAdd')) ?>
                <div class="form-group">
                    <div class="form-group">
                        <?= Form::label('article', 'ข้อที่ : '); ?>
                        <?= Form::number('article', null, ['class' => 'form-control input-no-spinner', 'placeholder' => 'หัวข้อแบบสอบถาม', 'autocomplete'=> 'off','maxlength' =>'2','onKeyPress'=>'if(this.value.length==2) return false;','required']); ?>
                        <?= Form::label('question', 'คำถาม : '); ?>
                        <?= Form::text('question', null, ['class' => 'form-control', 'placeholder' => 'รายการคำถาม', 'autocomplete'=> 'off','maxlength' =>'100','required']); ?>
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
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="fas fa-pencil-alt"></i> แก้ไขแบบสอบถาม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= Form::open(array('route' => 'question.prototype.update')) ?>
                <div class="form-group">
                    <div class="form-group">
                        <?= Form::hidden('question_prototype_id-edit', null, ['id' => 'question_prototype_id-edit'],); ?>
                        <?= Form::label('article-edit', 'ข้อที่ : '); ?>
                        <?= Form::number('article-edit', null, ['class' => 'form-control input-no-spinner', 'placeholder' => 'หัวข้อแบบสอบถาม', 'autocomplete'=> 'off','maxlength' =>'2','onKeyPress'=>'if(this.value.length==2) return false;','required']); ?>
                        <?= Form::label('question-edit', 'คำถาม : '); ?>
                        <?= Form::text('question-edit', null, ['class' => 'form-control', 'placeholder' => 'รายการคำถาม', 'autocomplete'=> 'off','maxlength' =>'100','required']); ?>
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
            $('#article').trigger('focus');
        });
        $('#showEdit').on('shown.bs.modal', function() {
            $('#article-edit').trigger('focus');
        });
    });
</script>