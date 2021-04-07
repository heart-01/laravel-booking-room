<div class="row">
    <div class="col-md-12">        
        <a href="{{ route('question.prototype') }}" class="btn btn-success text-white btn-sm mb-3"><i class="far fa-copy"></i> คัดลอกแบบฟอร์ม</a>        
        <div class="form-group row float-right d-none d-sm-none d-md-block d-lg-block">
            <div class="col-sm-12">
                <select wire:model="perPage" class="form-control form-control-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="form-group row float-right d-none d-sm-none d-md-block d-lg-block">
            <div class="col-sm-12">
                <select wire:model="orderAsc" class="form-control form-control-sm">
                    <option value="0">เรียงมากไปน้อย</option>
                    <option value="1">เรียงน้อยไปมาก</option>
                </select>
            </div>
        </div>
        <div class="form-group row float-right">
            <label for="serach" class="col-sm-3 col-form-label col-form-label-sm">Search : </label>
            <div class="col-sm-9">
                <input type="text" wire:model.debounce.300ms="search" class="form-control form-control-sm" placeholder="ค้นหาภาคการศึกษา">
            </div>
        </div>
    </div>
    <div class="container" style="margin-bottom: 10px;">
        @if($data->isNotEmpty())
            <div class="row text-center">            
                @foreach($data as $row)
                    <div class="col-12">
                        {{-- <button type="button" onclick="window.location.href='{{ url('/question/'.Crypt::encrypt($row->semesters_id)) }}'" class="btn-primary mb-3 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline motion-safe:hover:scale-110 bg-purple-700 hover:bg-violet-500 text-white font-normal py-2 px-4 mr-1 transform hover:-translate-y-1 hover:scale-110 rounded">
                            แบบประเมินปีการศึกษา <?php echo App\Semesters::term_year($row->semesters); ?>
                        </button> --}}
                        
                        <div class="btn-group dropright">
                            <button type="button" class="btn btn-secondary dropdown-toggle mb-3 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline motion-safe:hover:scale-110 bg-purple-700 hover:bg-violet-500 text-white font-normal py-2 px-4 mr-1 transform hover:-translate-y-1 hover:scale-110 rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                แบบประเมินปีการศึกษา <?php echo App\Semesters::term_year($row->semesters); ?>
                            </button>
                            <div class="dropdown-menu">
                                <!-- Dropdown menu links -->
                                @foreach($classrooms as $rooms)
                                    <a class="dropdown-item" href="{{ url('/question/'.Crypt::encrypt($row->semesters_id).'/'.Crypt::encrypt($rooms->classrooms_id)) }}">{{ $rooms->classrooms }} {{ $rooms->numbers }}</a>
                                    <div class="dropdown-divider"></div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            {!! $data->links() !!}
        @else
            <p class="col-12 text-center">อ๊ะ! ไม่พบข้อมูลแบบประเมินความพึงพอใจ  🙁</p>
        @endif
    </div>
</div>