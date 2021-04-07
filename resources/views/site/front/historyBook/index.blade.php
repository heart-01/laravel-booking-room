@extends('layouts.front')

@section('sidebar')
  <hr style="margin-top: 65px;">
@endsection

@section('content')
<style>
  .fixCol{
    position:sticky;
    left:0px;
    background-color:rgb(255, 255, 255);
  }
</style>
    <!-- TailwindCSS -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" type="text/css" rel="stylesheet">

    @livewireStyles
    <div class="container" style="margin-bottom: 480px;">
        <h1 class="text-center mb-5" style="font-size: 30px;">ประวัติการจองห้องเรียน</h1>
        @livewire('front.bookings-table')

        <div class="flex justify-center items-center">
          <img src="https://i.pinimg.com/originals/58/4b/60/584b607f5c2ff075429dc0e7b8d142ef.gif" id="loading" style="display:none;" width="150px;" />
        </div>
    </div>
    @livewireScripts

<!-- Other JS -->
<script>
  var config = {
        routes: {
          book_cancel: "{{ route('book.cancel') }}",
          history: "{{ route('history') }}",
        }
  };
</script>

<script src="{{ asset('js/front/historyBook/index.js') }}"></script>

@endsection