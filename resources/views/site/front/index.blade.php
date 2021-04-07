@extends('layouts.front')

@section('content')

<!-- TailwindCSS -->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" type="text/css" rel="stylesheet">
@livewireStyles
    @livewire('front.home-table')
@livewireScripts

<div class="alert alert-primary" role="alert" style="font-size: 25px;font-weight: 600">
    ◆ ห้องเรียนทั้งหมด
</div>
<div class="row">
    @foreach($data_classrooms as $row)
    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-5">
        <div class="card" style="width: 100%;">
            <a data-fancybox data-type="iframe" href="{{ url('/showDetail/'.$row->classrooms.' '.$row->numbers.'/'.$row->classrooms_id) }}" class="fancybox" >
                <img class="card-img-top" src="{{ asset('images/front/room/'.$row->image) }}" height="190px" width="50px" alt="Card image cap">
            </a>            
            <div class="card-body text-center">
                <p class="card-title" style="font-size: 18px;">{{ $row->classrooms }}</p>
                <table class="card-table table border-bottom-0">
                    <tr>
                        <td class="border-right" >หมายเลขห้อง</td>
                        <td>{{ $row->numbers }}</td>
                    </tr>
                    <tr>
                        <td class="border-right" >จำนวนที่นั่ง</td>
                        <td>{{ $row->seats }}</td>
                    </tr>
                    @if($row->prohibit_Start!='NULL#NULL' && $row->prohibit_End!='NULL#NULL')
                    <tr class="text-danger">
                        <td class="border-right" >งดจอง</td>
                        <td><?php echo App\Classrooms::prohibit($row->prohibit_Start,$row->prohibit_End); ?></td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="2">
                            <a data-fancybox data-type="iframe" href="{{ url('/showDetail/'.$row->classrooms.' '.$row->numbers.'/'.$row->classrooms_id) }}" class="fancybox btn btn-success btn-block">
                                <i class="fas fa-info-circle mr-1"></i> รายละเอียด
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</div>

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
@elseif (session()->has('Error'))
    <script>
        Swal.fire("<span class='kanin'><?php echo session()->get('Error'); ?></span>", "", "error");
    </script>
@endif

<script src="{{ asset('js/front/main/main.js') }}"></script>

@endsection