@extends('layouts.dashboard')

@section('content')

<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h4><i class="fas fa-broom"></i> สิ่งอำนวยความสะดวก</h4>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            @include('site/admin/classrooms_support/classrooms_support_pagination')
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="classrooms_support_id" />
            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        </div>
    </div>
    <!-- /.card-body -->
</div>

@include('site/admin/classrooms_support/classrooms_support_modal')

<script>
    var config = {
        routes: {
            classrooms_support: "{{ route('classrooms_support') }}",
            fetch_data: "{{ route('classrooms_support.fetch_data') }}",
            pagination_link: "{{ route('classrooms_support.pagination_link') }}",
            classrooms_support_update: "{{ route('classrooms_support.update') }}",
            classrooms_support_del: "{{ route('classrooms_support.classrooms_support_del') }}",
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

<script src="{{ asset('/js/admin/classrooms_support/classrooms_support.js') }}" type="text/javascript"></script>

@endsection