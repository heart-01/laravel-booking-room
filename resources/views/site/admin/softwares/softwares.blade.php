@extends('layouts.dashboard')

@section('content')

<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h4><i class="nav-icon fas fa-laptop-code"></i> รายการซอฟแวร์</h4>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            @include('site/admin/softwares/softwares_pagination')
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="softwares_id" />
            <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        </div>
    </div>
    <!-- /.card-body -->
</div>

@include('site/admin/softwares/softwares_modal')

<script>
    var config = {
        routes: {
            softwares: "{{ route('softwares') }}",
            fetch_data: "{{ route('softwares.fetch_data') }}",
            pagination_link: "{{ route('softwares.pagination_link') }}",
            softwares_update: "{{ route('softwares.update') }}",
            softwares_del: "{{ route('softwares.softwares_del') }}",
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

<script src="{{ asset('/js/admin/softwares/softwares.js') }}" type="text/javascript"></script>

@endsection