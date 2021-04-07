@foreach($data as $row)
<tr>
    <td class="text-center">{{ $row->semesters_id}}</td>
    <td><?php echo App\Semesters::term_year($row->semesters); ?></td>
    <td><?php echo App\Semesters::thai_date($row->semesters_start, 1,false); ?></td>
    <td><?php echo App\Semesters::thai_date($row->semesters_end, 1,false); ?></td>
    <td>
        <div data-id="{{ $row->semesters_id}}" data-semesters_end="{{ $row->semesters_end}}" data-status="{{ $row->semesters_status}}" class="semesters_status bootstrap-switch-null bootstrap-switch-undefined bootstrap-switch-undefined bootstrap-switch-undefined bootstrap-switch-undefined bootstrap-switch-undefined bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate" style="width: 88px;@if($row->semesters_end < date("Y-m-d"))pointer-events:none;@endif">
            <div class="bootstrap-switch-container" style="width: 130px; @if($row->semesters_status == 0) margin-left: -43px; @elseif($row->semesters_status == 1) margin-left: 0px; @endif">
                <span class="bootstrap-switch-handle-on bootstrap-switch-success" style="width: 43px;">ON</span>
                <span class="bootstrap-switch-label" style="width: 43px;">&nbsp;</span>
                <span class="bootstrap-switch-handle-off bootstrap-switch-danger" style="width: 43px;">OFF</span>
                <input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="" data-off-color="danger" data-on-color="success">
            </div>
        </div>
    </td>
    <td class="text-center">
        <button type="button" @if($row->semesters_end < date("Y-m-d")) disabled @endif class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu text-center">
            <div class="dropdown-divider"></div>
            <button @if($row->semesters_end < date("Y-m-d")) disabled @endif data-semesters_id="{{ $row->semesters_id}}" data-semesters="{{ $row->semesters}}" data-semesters_start="{{ App\Semesters::change_date($row->semesters_start) }}" data-semesters_end="{{ App\Semesters::change_date($row->semesters_end) }}" class="btn btn-warning text-white btn-sm btn-block mr-3 showEdit" ><i class="fas fa-pencil-alt"></i> แก้ไข</button>
            <div class="dropdown-divider"></div>
            <button @if($row->semesters_end < date("Y-m-d")) disabled @endif data-id="{{ $row->semesters_id}}" data-semesters=<?php echo App\Semesters::term_year($row->semesters); ?> type="button" class="btn btn-danger btn-sm btn-block semesters_delete" ><i class="fas fa-trash"></i> ลบ</button>
            <div class="dropdown-divider"></div>
        </div>
    </td>
</tr>
@endforeach

<script src="{{ asset('/js/admin/semesters/semesters_data-row.js') }}" type="text/javascript"></script>