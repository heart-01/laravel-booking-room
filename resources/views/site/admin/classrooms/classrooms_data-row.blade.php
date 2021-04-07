@foreach($data as $row)
<tr>
    <td class="text-center">{{ $row->classrooms_id}}</td>
    <td>{{ $row->classrooms}}</td>
    <td>{{ $row->numbers}}</td>
    <td>{{ $row->seats}}</td>
    <td class="text-red" ><?php echo App\Classrooms::prohibit($row->prohibit_Start,$row->prohibit_End); ?></td>
    <td>
        <div data-id="{{ $row->classrooms_id}}" data-status="{{ $row->status}}" class="classrooms_status bootstrap-switch-null bootstrap-switch-undefined bootstrap-switch-undefined bootstrap-switch-undefined bootstrap-switch-undefined bootstrap-switch-undefined bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate" style="width: 88px;">
            <div class="bootstrap-switch-container" style="width: 130px; @if($row->status == 0) margin-left: -43px; @elseif($row->status == 1) margin-left: 0px; @endif">
                <span class="bootstrap-switch-handle-on bootstrap-switch-success" style="width: 43px;">ON</span>
                <span class="bootstrap-switch-label" style="width: 43px;">&nbsp;</span>
                <span class="bootstrap-switch-handle-off bootstrap-switch-danger" style="width: 43px;">OFF</span>
                <input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="" data-off-color="danger" data-on-color="success">
            </div>
        </div>
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-info-circle"></i> ข้อมูล
        </button>
        <div class="dropdown-menu text-center">
            <div class="dropdown-divider"></div>
            <a data-fancybox data-type="iframe" href="{{ url('/classrooms/addSupport/'.$row->classrooms.' '.$row->numbers.'/'.$row->classrooms_id) }}" class="btn btn-success text-white btn-sm btn-block fancybox" >
                <i class="fas fa-broom"></i> สิ่งอำนวยความสะดวก
            </a>
            <div class="dropdown-divider"></div>
            <a data-fancybox data-type="iframe" href="{{ url('/classrooms/addSoftwares/'.$row->classrooms.' '.$row->numbers.'/'.$row->classrooms_id) }}" class="btn btn-dark btn-sm btn-block fancybox" >
                <i class="nav-icon fas fa-laptop-code"></i> ซอฟแวร์
            </a>
            <div class="dropdown-divider"></div>
            <a data-fancybox data-type="iframe" href="{{ url('/classrooms/addImage/'.$row->classrooms.' '.$row->numbers.'/'.$row->classrooms_id.'/'.$row->numbers) }}" class="btn btn-info btn-sm btn-block fancybox" >
                <i class="fas fa-images"></i> รูปภาพ
            </a>
            <div class="dropdown-divider"></div>
        </div>
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu text-center">
            <div class="dropdown-divider"></div>
            <button data-classrooms_id="{{ $row->classrooms_id}}" data-classrooms="{{ $row->classrooms}}" data-numbers="{{ $row->numbers}}" data-seats="{{ $row->seats}}" data-prohibitDS="{{ App\Classrooms::dataProhibit($row->prohibit_Start,1) }}" 
                data-prohibitTS="{{ App\Classrooms::dataProhibit($row->prohibit_Start,2) }}" data-prohibitDE="{{ App\Classrooms::dataProhibit($row->prohibit_End,3) }}" data-prohibitTE="{{ App\Classrooms::dataProhibit($row->prohibit_End,4) }}"
                 class="btn btn-warning text-white btn-sm btn-block mr-3 showEdit" ><i class="fas fa-pencil-alt"></i> แก้ไข
            </button>
            <div class="dropdown-divider"></div>
            <button data-id="{{ $row->classrooms_id}}" data-classrooms="{{ $row->classrooms}}" data-numbers="{{ $row->numbers}}" type="button" class="btn btn-danger btn-sm btn-block classrooms_delete" ><i class="fas fa-trash"></i> ลบ</button>
            <div class="dropdown-divider"></div>
        </div>
    </td>
</tr>
@endforeach

<script src="{{ asset('/js/admin/classrooms/classrooms_data-row.js') }}" type="text/javascript"></script>