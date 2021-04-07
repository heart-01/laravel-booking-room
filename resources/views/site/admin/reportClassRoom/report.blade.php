@extends('layouts.dashboard')

@section('content')

<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h4><i class="fas fa-file-invoice mr-3"></i> รีพอร์ต <?php echo App\Semesters::term_year($data_bookings[0]->semesters); ?>  {{ $data_bookings[0]->classrooms }} {{ $data_bookings[0]->numbers }}</h4>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-md-12">
                    <a id="back-history" class="btn btn-secondary text-white col-md-2 col-lg-2 col-xl-1 d-none d-sm-none d-md-block d-lg-block" href="{{ route('report.classroom') }}">
                        <i class="fas fa-chevron-left mr-1"></i> กลับไป
                    </a>
                    <div class="form-group row float-right">
                        <?= Form::open(array('route' => 'report.classroom.report.pdf','target' => '_blank','style' => 'display:inline;')) ?>
                            <?= Form::hidden('semesters', Crypt::encrypt($data_bookings[0]->semesters)); ?> 
                            <?= Form::hidden('semesters_id', Crypt::encrypt($semesters_id)); ?>  
                            <?= Form::hidden('classrooms', Crypt::encrypt($data_bookings[0]->classrooms.' '.$data_bookings[0]->numbers)); ?> 
                            <?= Form::hidden('classrooms_id', Crypt::encrypt($classrooms_id)); ?> 
                            <?= Form::hidden('status', Crypt::encrypt($status)); ?> 
                            <button type="submit" class="btn btn-success text-white" ><i class="fas fa-download"></i> PDF</button>
                        <?= Form::close() ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table table-bordered table-responsive-lg table-hover dataTable dtr-inline text-center" role="grid">
                        <thead>
                            <tr role="row">
                                <th>ลำดับ</th>
                                <th>ชื่อ</th>
                                <th>คณะ</th>
                                <th>รหัสวิชา</th>
                                <th>วิชา</th>
                                <th>ตอน</th>
                                <th>นักศึกษา</th>
                                <th>วัน</th>
                                <th>เวลา</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_bookings as $key => $row)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $row->fname }} {{ $row->lname }}</td>
                                <td>{{ $row->faculty }}</td>
                                <td>{{ $row->course_code }}</td>
                                <td>{{ $row->subject }}</td>
                                <td>{{ $row->part }}</td>
                                <td>{{ $row->bookingSeats }}</td>
                                <td>{{ App\Classrooms::Droom($row->days) }}</td>
                                <td>{{ date('H:i', strtotime($row->time_start)).' - '.date('H:i', strtotime($row->time_end)) }}</td>
                                <td>{{ App\Classrooms::status($row->bookingStatus,1) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
<!-- /.card-body -->

@endsection