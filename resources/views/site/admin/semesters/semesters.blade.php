@extends('layouts.dashboard')

@section('content')

<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h4><i class="fas fa-school"></i> ภาคการศึกษา</h4>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            @include('site/admin/semesters/semesters_pagination')
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="semesters_id" />
            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        </div>
    </div>
    <!-- /.card-body -->
</div>

@include('site/admin/semesters/semesters_modal')

<script>
    var config = {
        routes: {
            semesters: "{{ route('semesters') }}",
            fetch_data: "{{ route('semesters.fetch_data') }}",
            pagination_link: "{{ route('semesters.pagination_link') }}",
            semesters_status: "{{ route('semesters.semesters_status') }}",
            semesters_update: "{{ route('semesters.update') }}",
            semesters_del: "{{ route('semesters.semesters_del') }}",
        },
        images: {
            DatepickerThai: "{{ asset('images/DatepickerThai/calendar.gif') }}",
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

<script src="{{ asset('/js/admin/semesters/semesters.js') }}" type="text/javascript"></script>

@endsection