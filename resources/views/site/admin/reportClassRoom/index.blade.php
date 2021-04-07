@extends('layouts.dashboard')

@section('content')
<style>
    .bootstrap-select .btn {
        background: #fff; cursor: pointer; padding: 5px 10px; border-radius: 15px; border: 1px solid #ccc; width: 100%; height: 40px;
    }
</style>

<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h4><i class="fas fa-file-invoice mr-3"></i> รีพอร์ตห้องเรียน</h4>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row" style="margin-bottom: 200px;">
                <div class="col-lg-3"></div>
                <div class="col-sm-12 col-lg-6">
                    <?= Form::open(array('route' => 'report.classroom.report')) ?>
                        <?= Form::label('semesters', 'ภาคการศึกษา ', ['class' => 'h5 mt-5']); ?>                    
                        <div class="form-group">
                            <?= Form::select('semesters', $semesters, null, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'required', 'data-size' =>'5', 'data-live-search' =>'true', 'title'=> 'เลือกภาคการศึกษา']); ?>
                        </div>

                        <?= Form::label('classrooms', 'ห้องเรียน ', ['class' => 'h5 mt-3']); ?>  
                        <div class="form-group">
                            <?= Form::select('classrooms', $classrooms, null, ['class' => 'form-control selectpicker', 'dropupAuto' =>'false', 'required', 'data-size' =>'5', 'data-live-search' =>'true', 'title'=> 'เลือกห้องเรียน']); ?>
                        </div>

                        <?= Form::label('status', 'สถานะการจองห้องเรียน ', ['class' => 'h5 mt-3']); ?>  
                        <div class="form-group">
                            <?= Form::select('status[]', ['0'=> 'ยกเลิก', '1'=> 'รออนุมัติ', '2'=> 'อนุมัติ', '3'=> 'สิ้นสุด'], null, ['class' => 'form-control selectpicker', 'multiple', 'dropupAuto' =>'false', 'required', 'data-size' =>'5', 'data-live-search' =>'true', 'title'=> 'เลือกสถานะการจองห้องเรียน']); ?>
                        </div>

                        <div class="form-group text-center mt-5">
                            <button type="submit" class="btn btn-success text-white"><i class="fas fa-search"></i> ค้นหา</button>
                        </div>                        
                    <?= Form::close() ?>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </div>
</div>   
<!-- /.card-body -->

@if (session()->has('Warning'))
    <script>
        Swal.fire("<span class='kanin'><?php echo session()->get('Warning'); ?></span>", "", "warning");
    </script>
@endif

@endsection