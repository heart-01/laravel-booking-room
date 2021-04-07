<div id="divBookings">
    <div class="form-row mb-3">
        <div class="form-group col-md-6">
            <label for="search">ค้นหา</label>
            <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="ค้นหา หมายเลขห้องเรียน , ภาคการศึกษา">
        </div>
        <div class="form-group col-md-2">
            <label for="orderBy">เรียงตาม</label>
            <select wire:model="orderBy" class="form-control">
                <option value="bookings_id">การจองล่าสุด</option>
                <option value="semesters">ภาคการศึกษา</option>
                <option value="classrooms">ชื่อห้องเรียน</option>
                <option value="bookSeats">จำนวนนักศึกษา</option>
                <option value="bookSta">สถานะการจองห้องเรียน</option>
                <option value="creatBook">วันที่ส่งเรื่องจองห้องเรียน</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="orderAsc">จาก</label>
            <select wire:model="orderAsc" class="form-control">
                <option value="0">มากไปน้อย</option>
                <option value="1">น้อยไปมาก</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="perPage">แสดง</label>
            <select wire:model="perPage" class="form-control">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    @if($data->isNotEmpty())
    {{-- Desktop --}}
    <div class="d-none d-sm-none d-md-none d-lg-block">
        <table class="table-auto w-full mb-6 table-responsive-sm">
            <tbody>
                <tr>
                    <th class="px-4 py-2">ภาคเรียน</th>
                    <th class="px-4 py-2">ชื่อห้อง</th>
                    <th class="px-4 py-2">จำนวนนักศึกษา</th>
                    <th class="px-4 py-2">วันจอง</th>
                    <th class="px-4 py-2">เวลาจอง</th>
                    <th class="px-4 py-2">สถานะ</th>
                    <th class="px-4 py-2">วันที่ส่งเรื่องจอง</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                @foreach($data as $row)
                    <tr>
                        <td class="border px-4 py-2"><?php echo App\Semesters::term_year($row->semesters); ?></td>
                        <td class="border px-4 py-2">{{ $row->classrooms }} {{ $row->numbers }}</td>
                        <td class="border px-4 py-2">{{ $row->bookSeats }}</td>
                        <td class="border px-4 py-2">{{ App\Classrooms::Droom($row->days) }}</td>
                        <td class="border px-4 py-2">{{ date('H:i', strtotime($row->time_start)) }} - {{ date('H:i', strtotime($row->time_end)) }}</td>
                        <td class="border px-4 py-2"><?php echo App\Classrooms::status($row->bookSta); ?></td>
                        <td class="border px-4 py-2">{{ date('d M Y, H:i', strtotime($row->creatBook)) }}</td>
                        <td class="border px-4 py-2">
                            <button type="button" class="btn btn-primary dropdown-toggle" @if($row->bookSta==0||$row->bookSta==3) disabled @endif data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu text-center">
                                <div class="dropdown-divider"></div>
                                <a data-fancybox data-type="iframe" href="{{ url('/history/'.Crypt::encrypt($row->bookings_id)) }}" class="fancybox btn-sm btn-block btn btn-primary" ><i class="fas fa-table"></i> แสดงข้อมูลการจอง</a> 
                                <div class="dropdown-divider"></div>
                                <?= Form::open(array('route' => array('book.permitPDF'),'target' => '_blank','style' => 'display:inline;')) ?>
                                    <?= Form::hidden('BookingsId', Crypt::encrypt($row->bookings_id) ); ?> 
                                    <button type="submit" @if($row->bookSta==0||$row->bookSta==3) disabled @endif class="btn btn-success text-white btn-sm btn-block mr-3" ><i class="fas fa-download"></i> แบบฟอร์มขอใช้ห้อง</button>
                                <?= Form::close() ?>
                                <div class="dropdown-divider"></div>
                                <?= Form::open(array('route' => 'history.display.update','style' => 'display:inline;')) ?>
                                    <?= Form::hidden('BookingsId', Crypt::encrypt($row->bookings_id) ); ?> 
                                    <button type="submit" @if($row->bookSta==0||$row->bookSta==3) disabled @endif class="btn btn-warning text-white btn-sm btn-block mr-3" ><i class="fas fa-edit"></i> แก้ไขข้อมูลการจอง</button>
                                <?= Form::close() ?>
                                <div class="dropdown-divider"></div>
                                <button type="button" @if($row->bookSta==0||$row->bookSta==3) disabled @endif data-BookingsId=<?php echo Crypt::encrypt($row->bookings_id); ?> class="btn btn-danger btn-sm btn-block btnCancel" ><i class="fas fa-ban"></i> ยกเลิกการจอง</button>
                                <div class="dropdown-divider"></div>
                            </div>    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- Mobile --}}
    <pre class="d-block d-sm-block d-md-block d-lg-none">
        <table class="table-auto w-full mb-6 table-responsive-sm">
            <tbody>
                <tr>
                    <th class="px-4 py-2 fixCol">ภาคเรียน</th>
                    <th class="px-4 py-2">ชื่อห้อง</th>
                    <th class="px-4 py-2">จำนวนนักศึกษา</th>
                    <th class="px-4 py-2">วันจอง</th>
                    <th class="px-4 py-2">เวลาจอง</th>
                    <th class="px-4 py-2">สถานะ</th>
                    <th class="px-4 py-2">วันที่ส่งเรื่องจอง</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                @foreach($data as $row)
                    <tr>
                        <td class="border px-4 py-2 fixCol">{{ $row->semesters }}</td>
                        <td class="border px-4 py-2">{{ $row->classrooms }} {{ $row->numbers }}</td>
                        <td class="border px-4 py-2">{{ $row->bookSeats }}</td>
                        <td class="border px-4 py-2">{{ App\Classrooms::Droom($row->days) }}</td>
                        <td class="border px-4 py-2">{{ date('H:i', strtotime($row->time_start)) }} - {{ date('H:i', strtotime($row->time_end)) }}</td>
                        <td class="border px-4 py-2"><?php echo App\Classrooms::status($row->bookSta); ?></td>
                        <td class="border px-4 py-2">{{ date('d M Y, H:i', strtotime($row->creatBook)) }}</td>
                        <td class="border px-4 py-2"><?php echo '<a data-fancybox data-type="iframe" href="'.url('/history/'.Crypt::encrypt($row->bookings_id)).'" class="fancybox btn btn-primary btn-sm" ><i class="fas fa-table"></i> แสดงข้อมูลการจอง</a>'?> <?= Form::open(array('route' => array('book.permitPDF'),'target' => '_blank','style' => 'display:inline;')) ?><?= Form::hidden('BookingsId', Crypt::encrypt($row->bookings_id) ); ?><?php echo '<button type="submit" '.(($row->bookSta==0||$row->bookSta==3)?'disabled':"").' class="btn btn-success text-white btn-sm mr-3" ><i class="fas fa-download"></i> แบบฟอร์มขอใช้ห้อง</button>' ?><?= Form::close() ?><?= Form::open(array('route' => 'history.display.update','style' => 'display:inline;')) ?><?= Form::hidden('BookingsId', Crypt::encrypt($row->bookings_id) ); ?><?php echo '<button type="submit" '.(($row->bookSta==0||$row->bookSta==3)?'disabled':"").' class="btn btn-warning text-white btn-sm mr-3" ><i class="fas fa-edit"></i> แก้ไขข้อมูลการจอง</button>' ?><?= Form::close() ?><?php echo '<button type="button" '.(($row->bookSta==0||$row->bookSta==3)?'disabled':"").' data-BookingsId='.Crypt::encrypt($row->bookings_id).' class="btn btn-danger btn-sm btnCancel" ><i class="fas fa-ban"></i> ยกเลิกการจอง</button>'?></td>
                    </tr>
                @endforeach
            </tbody>
        </table></pre>
        {!! $data->links() !!}
    @else
        <p class="text-center">อ๊ะ! ไม่พบประวัติการจองห้องเรียน 🙁</p>
    @endif
</div>