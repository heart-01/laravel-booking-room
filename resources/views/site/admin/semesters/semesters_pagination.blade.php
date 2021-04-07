<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary text-white btn-sm mb-3" data-toggle="modal" data-target="#showAdd"><i class="fas fa-plus-circle"></i> เพิ่ม</button>
        <div class="form-group row float-right">
            <label for="serach" class="col-sm-3 col-form-label col-form-label-sm">Search : </label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="serach" id="serach" placeholder="ค้นหาภาคการศึกษา">
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <table class="table table-bordered table-responsive-sm table-hover dataTable dtr-inline text-center" role="grid">
            <thead>
                <tr role="row">
                    <th width="10%" class="sorting hand" tabindex="0" data-sorting_type="desc" data-column_name="semesters_id" >รหัส <span id="semesters_id_icon"><i class="fas fa-arrow-up"></i></span></th>
                    <th width="20%" class="sorting hand" tabindex="0" data-sorting_type="desc" data-column_name="semesters" >ภาคการศึกษาที่ <span id="semesters_icon"><i class="fas fa-arrow-up"></i></span></th>
                    <th width="20%" class="sorting hand" tabindex="0" data-sorting_type="desc" data-column_name="semesters_start" >เวลาเริ่มภาคเรียน <span id="semesters_start_icon"><i class="fas fa-arrow-up"></i></span></th>
                    <th width="20%" class="sorting hand" tabindex="0" data-sorting_type="desc" data-column_name="semesters_end" >เวลาสิ้นสุดภาคเรียน <span id="semesters_end_icon"><i class="fas fa-arrow-up"></i></span></th>
                    <th width="10%" >สถานะ </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @include('site/admin/semesters/semesters_data-row')
            </tbody>
        </table>
    </div>
</div>
<div class="row" id="pagination-link">
    @include('site/admin/semesters/semesters_pagination-link')
</div>