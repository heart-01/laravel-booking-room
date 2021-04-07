@extends('layouts.front')

@section('sidebar')
  <hr style="margin-top: 65px;">
@endsection

@section('content')    
    <div class="container" style="margin-bottom: 150px;">
        <h1 class="text-center mb-5" style="font-size: 30px;">ข้อมูลสำหรับการติดต่อ</h1>
        <hr>

        <div class="text-center mb-5 mt-5 h5">
            <img src="{{ asset('images/front/logo_icit.png') }}" width="300" alt="logo_icit">

            <p><b><i class="fa fa-home"></i> ห้องเรียน </b></p>
            <p><i class="fa fa-user"></i> คุณกนก บุญพันธ์จันที</p>
            <p><i class="fa fa-envelope-o"></i> kanokb@kmutnb.ac.th</p>
            <p><i class="fa fa-phone-square"></i> 02-555-2000 ต่อ 2211</p>
            
            
            สำนักคอมพิวเตอร์และเทคโนโลยีสารสนเทศ<br>
            มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ<br>
            1518 ถนนประชาราษฎร์ 1 แขวงวงศ์สว่าง เขตบางซื่อ กทม. 10800<br>
        </div>
    </div>
@endsection