@extends('layouts.dashboard')

@section('content')
<!-- TailwindCSS -->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" type="text/css" rel="stylesheet">
@livewireStyles

<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h1 style="font-size: 20px;"><i class="far fa-file-alt"></i> แบบประเมินความพึงพอใจ</h1>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @livewire('admin.semesters-table')
    </div>
    <!-- /.card-body -->
</div>

<!-- Other JS -->
@livewireScripts
@if (session()->has('Warning'))
    <script>
        Swal.fire("<span class='kanin'><?php echo session()->get('Warning'); ?></span>", "", "warning");
    </script>
@endif
@endsection