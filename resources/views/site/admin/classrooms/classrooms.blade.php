@extends('layouts.dashboard')

@section('content')
<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h4><i class="nav-icon fas fa-chalkboard-teacher"></i> ห้องเรียน</h4>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            @include('site/admin/classrooms/classrooms_pagination')
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="classrooms_id" />
            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        </div>
    </div>
    <!-- /.card-body -->
</div>

@include('site/admin/classrooms/classrooms_modal')

<script>
    var config = {
        routes: {
            classrooms: "{{ route('classrooms') }}",
            fetch_data: "{{ route('classrooms.fetch_data') }}",
            pagination_link: "{{ route('classrooms.pagination_link') }}",
            classrooms_status: "{{ route('classrooms.classrooms_status') }}",
            classrooms_update: "{{ route('classrooms.update') }}",
            classrooms_del: "{{ route('classrooms.classrooms_del') }}",
        },
    };
</script>

@if (session()->has('Success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: "<span class='kanin'><?php echo session()->get('Success'); ?></span>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@elseif (session()->has('Warning'))
    <script>
        Swal.fire("<span class='kanin'><?php echo session()->get('Warning'); ?></span>", "", "warning");
    </script>
@endif

<script src="{{ asset('/js/admin/classrooms/classrooms.js') }}" type="text/javascript"></script>

@endsection