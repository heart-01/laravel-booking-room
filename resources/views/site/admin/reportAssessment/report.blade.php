@extends('layouts.dashboard')

@section('content')

<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h4><i class="fas fa-file-invoice mr-3"></i> รีพอร์ตแบบประเมินความพึงพอใจ {{ $semesters }}  {{ $classrooms }}</h4>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-md-12">
                    <a id="back-history" class="btn btn-secondary text-white col-md-2 col-lg-2 col-xl-1 d-none d-sm-none d-md-block d-lg-block" href="{{ route('report.assessment') }}">
                        <i class="fas fa-chevron-left mr-1"></i> กลับไป
                    </a>
                    <div class="form-group row float-right">
                        <?= Form::open(array('route' => 'report.assessment.report.pdf','target' => '_blank','style' => 'display:inline;')) ?>
                            <?= Form::hidden('semesters', Crypt::encrypt($semesters)); ?>  
                            <?= Form::hidden('semesters_id', Crypt::encrypt($semesters_id)); ?>  
                            <?= Form::hidden('classrooms', Crypt::encrypt($classrooms)); ?>  
                            <?= Form::hidden('classrooms_id', Crypt::encrypt($classrooms_id)); ?>  
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
                                <th>คำถาม</th>
                                <th>คะแนน</th>
                                <th>วันที่ทำแบบประเมิน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_assessment as $key => $row)
                                @if ($loop->first)
                                    <?php $ck = $row->suggestion; ?>
                                @endif

                                @if($ck != $row->suggestion)
                                <tr>
                                    <td colspan="5" style="text-align: left;" >ข้อเสนอแนะ : {{ $ck }}</td>
                                </tr>
                                @endif

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td style="text-align: left;" >{{ $row->name }}</td>
                                    <td style="text-align: left;" >{{ $row->article }}. {{ $row->question }}</td>
                                    <td>{{ $row->score }}</td>
                                    <td>{{ date('d-m-Y', strtotime('+543 year', strtotime($row->assCreate))) }}</td>
                                </tr>

                                @if ($loop->last)
                                <tr>
                                    <td colspan="5" style="text-align: left;" >ข้อเสนอแนะ : {{ $ck }}</td>
                                </tr>
                                @endif

                                <?php $ck = $row->suggestion; ?>
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