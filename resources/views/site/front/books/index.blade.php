@extends('layouts.front')

@section('sidebar')
  <hr style="margin-top: 65px;">
@endsection

@section('content')
<!-- Other CSS -->
<link rel="stylesheet" href="{{ asset('css/front/books/index.css') }}">
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
<style>
  .bootstrap-select .btn {
    background: #fff; cursor: pointer; padding: 5px 10px; border-radius: 15px; border: 1px solid #ccc; width: 100%; height: 40px;
  }
  .bootstrap-select .btn[data-id="con_Sof"] {
    background: #fff; cursor: default; border: 0px solid #ccc; padding: 0px 0px 0px 0px; height: 23px; clip: rect(0px 300px 23px 0px); position: absolute; left: 0px; bottom: -8px; color: black;
  }
  .date-border{
    background: #fff; cursor: pointer; padding: 5px 10px; border-radius: 15px; border: 1px solid #ccc; width: 100%; height: 40px;
  }
  .txt-border{
    border-radius: 15px; border: 1px solid #ccc;
  }
</style>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 text-center p-0 mt-3 mb-2">
      <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
        <h2 id="heading">ระบบจองห้องปฏิบัติการคอมพิวเตอร์</h2>
        <p class="p-head">กรอกข้อมูลในแบบฟอร์มทั้งหมดเพื่อไปยังขั้นตอนถัดไป</p>
        <div id="msform">
          <!-- progressbar -->
          <ul id="progressbar">
            <li class="active" id="data">ค้นหาห้อง</li>
            <li id="room">เลือกห้องว่าง</li>
            <li id="info">ข้อมูลห้อง</li>
            <li id="detail">กรอกข้อมูลการจองห้อง</li>
            <li id="confirm">สำเร็จ</li>
          </ul>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
          </div> <br>
          <!-- Page_data -->
          @include('site/front/books/page_data')

          <!-- Page_room -->
          @include('site/front/books/page_room')

          <!-- Page_info -->
          @include('site/front/books/page_info')

          <!-- Page_detail -->
          @include('site/front/books/page_detail')

          <!-- Page_confirm -->
          @include('site/front/books/page_confirm')
          
          <!-- Page_confirm -->
          <div><img src="https://i.pinimg.com/originals/58/4b/60/584b607f5c2ff075429dc0e7b8d142ef.gif" id="loading" width="150px;" style="display:none;"/></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Other JS -->
<script>
  var config = {
        routes: {
          page_data: "{{ route('book.page_data') }}",
          page_roomDetail: "{{ url('/showDetail/') }}",
          page_infoDetail: "{{ route('book.page_info') }}",
          page_confirmDetail: "{{ route('book.page_confirm') }}",
          book: "{{ route('book') }}",      
          history: "{{ route('history') }}",
          book_update: "{{ route('book.update') }}",
          book_cancel: "{{ route('book.cancel') }}",
        },
        image: {
          img_room: "{{ asset('images/front/room/') }}",
        },
        js: {
          page_room: "{{ asset('js/front/books/page_room.js') }}",
          page_info: "{{ asset('js/front/books/page_info.js') }}",
          page_detail: "{{ asset('js/front/books/page_detail.js') }}",
        }
  };
  //Index
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;
  var current = 1;
  var steps = $("fieldset").length;

  setProgressBar(current);

  function setProgressBar(curStep){
      var percent = parseFloat(100 / steps) * curStep;
      percent = percent.toFixed();
      $(".progress-bar").css("width",percent+"%")
  }
</script>

<script src="{{ asset('js/front/books/index.js') }}"></script>

@endsection