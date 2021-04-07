@foreach($data as $row)
<tr>
    <td class="text-center">{{ $row->classrooms_support_id}}</td>
    <td>{{ $row->classrooms_support}}</td>
    <td class="text-center">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu text-center">
            <div class="dropdown-divider"></div>
            <button data-classrooms_support_id="{{ $row->classrooms_support_id}}" data-classrooms_support="{{ $row->classrooms_support}}" class="btn btn-warning text-white btn-sm btn-block mr-3 showEdit" ><i class="fas fa-pencil-alt"></i> แก้ไข</button>
            <div class="dropdown-divider"></div>
            <button data-id="{{ $row->classrooms_support_id}}" data-classrooms_support="{{ $row->classrooms_support}}" type="button" class="btn btn-danger btn-sm btn-block classrooms_support_delete" ><i class="fas fa-trash"></i> ลบ</button>
            <div class="dropdown-divider"></div>
        </div>
    </td>
</tr>
@endforeach

<script src="{{ asset('/js/admin/classrooms_support/classrooms_support_data-row.js') }}" type="text/javascript"></script>