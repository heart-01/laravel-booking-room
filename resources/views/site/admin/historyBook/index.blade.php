@extends('layouts.dashboard')

@section('content')
<style>
  .fixCol{
    position:sticky;
    left:0px;
    background-color:rgb(255, 255, 255);
  }
</style>
    @forelse($notificat_is_admin as $notification)
          <div class="alert alert-{{ $notification->data['details']['color'] }}" role="alert">
            [ {{ date('d-m-Y เวลา H:i', strtotime($notification->created_at)) }} ]<div class="d-block d-sm-block d-md-block d-lg-none"></div>
            <strong ><i class="fas fa-envelope ml-5 mr-1"></i> {{ $notification->data['details']['body'] }}</strong><div class="d-block d-sm-block d-md-block d-lg-none"></div>
            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
              <i class="far fa-envelope-open mr-1" style="text-decoration:none;"></i>Mark as read
            </a>
            <div class="d-block d-sm-block d-md-block d-lg-none"><br></div>
          </div>
        @if($loop->last)
            <a href="#" id="mark-all" class="btn btn-info mb-5">
              <i class="fas fa-envelope-open-text mr-1" style="text-decoration:none;"></i>Mark all as read
            </a>
        @endif
    @empty
        {{-- <div class="alert alert-secondary alert-dismissible fade show" role="alert">
          <strong><i class="fas fa-comment-dots"></i></strong> ไม่มีการแจ้งเตือนใหม่.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> --}}
    @endforelse
    
    <!-- TailwindCSS -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" type="text/css" rel="stylesheet">

    @livewireStyles

    <div class="card kanin">
      <div class="card-header">
          <div class="row text-center">
              <h1 class="col-12" style="font-size: 30px;">ประวัติการจองห้อง</h1>
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <div class="container" style="margin-bottom: 10px;">
            @livewire('admin.bookings-table')

            <div class="flex justify-center items-center">
              <img src="https://i.pinimg.com/originals/58/4b/60/584b607f5c2ff075429dc0e7b8d142ef.gif" id="loading" style="display:none;" width="150px;" />
            </div>
        </div>
    
      </div>
      <!-- /.card-body -->
    </div>

<!-- Other JS -->
@livewireScripts
<script>
  var config = {
        routes: {
          book_cancel: "{{ route('book.cancel') }}",
          history: "{{ route('dashboard') }}",
          book_approve: "{{ route('admin.history.approve') }}",
        }
  };
</script>
@if(!empty($notificat_is_admin))
    <script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('admin.markNotification') }}", {
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
    </script>
@endif

<script src="{{ asset('js/admin/historyBook/index.js') }}"></script>

@endsection