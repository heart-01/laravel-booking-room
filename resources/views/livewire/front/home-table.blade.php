<div>
    @if($count_bookings != 0)
    <div class="mb-5">
        <div class="alert alert-primary" role="alert" style="font-size: 25px;font-weight: 600">
            ◆ ตารางการจองห้องเรียน ภาคการศึกษา <?php echo App\Semesters::term_year($data_bookings->pluck('semesters')[0]); ?></h1>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-10">
                <label for="search">ค้นหา</label>
                <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="ค้นหา ชื่อห้องเรียน, ชื่ออาจารย์, รหัสวิชา, ชื่อวิชา, วันจอง">
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

        @if($count_search != 0)
        <pre>
            <table class="table table-auto table-responsive-sm table-bordered kanin">
                <tbody>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อห้อง</th>
                        <th scope="col">รหัสวิชา</th>
                        <th scope="col">ชื่อวิชา</th>
                        <th scope="col">อาจารย์ผู้สอน</th>
                        <th scope="col">นักศึกษา</th>
                        <th scope="col">วันจอง</th>
                        <th scope="col">เวลาจอง</th>
                    </tr>
                    @foreach($search_bookings as $key => $row)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $row->classrooms }} {{ $row->numbers }}</td>
                        <td>{{ $row->course_code }}</td>
                        <td>{{ $row->subject }}</td>
                        <td>{{ $row->fname }} {{ $row->lname }}</td>
                        <td>{{ $row->bookingSeats }}</td>
                        <td>{{ App\Classrooms::Droom($row->days) }}</td>
                        <td>{{ date('H:i', strtotime($row->time_start)).' - '.date('H:i', strtotime($row->time_end)) }}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </pre>
        {!! $search_bookings->links() !!}
        @else
        <p class="text-center">อ๊ะ! ไม่พบประวัติการจองห้องเรียน 🙁</p>
        @endif
        
    </div>
    @endif
</div>
