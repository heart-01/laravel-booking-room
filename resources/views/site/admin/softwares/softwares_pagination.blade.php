<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary text-white btn-sm mb-3" data-toggle="modal" data-target="#showAdd"><i class="fas fa-plus-circle"></i> เพิ่ม</button>
        <div class="form-group row float-right">
            <label for="serach" class="col-sm-3 col-form-label col-form-label-sm">Search : </label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="serach" id="serach" placeholder="ค้นหารายการซอฟแวร์">
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <table class="table table-bordered table-responsive-sm table-hover dataTable dtr-inline text-center" role="grid">
            <thead>
                <tr role="row">
                    <th width="10%" class="sorting hand" tabindex="0" data-sorting_type="desc" data-column_name="softwares_id" >รหัส <span id="softwares_id_icon"><i class="fas fa-arrow-up"></i></span></th>
                    <th width="20%">ชื่อซอฟแวร์</th>
                    <th width="20%" >Action</th>
                </tr>
            </thead>
            <tbody>
                @include('site/admin/softwares/softwares_data-row')
            </tbody>
        </table>
    </div>
</div>
<div class="row" id="pagination-link">
    @include('site/admin/softwares/softwares_pagination-link')
</div>