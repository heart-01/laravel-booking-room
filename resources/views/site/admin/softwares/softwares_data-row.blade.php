@foreach($data as $row)
<tr>
    <td class="text-center">{{ $row->softwares_id}}</td>
    <td>{{ $row->softwares}}</td>
    <td class="text-center">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu text-center">
            <div class="dropdown-divider"></div>
            <button data-softwares_id="{{ $row->softwares_id}}" data-softwares="{{ $row->softwares}}" class="btn btn-warning text-white btn-sm btn-block mr-3 showEdit" ><i class="fas fa-pencil-alt"></i> แก้ไข</button>
            <div class="dropdown-divider"></div>
            <button data-id="{{ $row->softwares_id}}" data-softwares="{{ $row->softwares}}" type="button" class="btn btn-danger btn-sm btn-block softwares_delete" ><i class="fas fa-trash"></i> ลบ</button>
            <div class="dropdown-divider"></div>
        </div>
    </td>
</tr>
@endforeach

<script src="{{ asset('/js/admin/softwares/softwares_data-row.js') }}" type="text/javascript"></script>