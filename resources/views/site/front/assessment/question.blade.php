@extends('layouts.front')

@section('sidebar')
  <hr style="margin-top: 65px;">
@endsection

@section('content')
<!-- TailwindCSS -->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" type="text/css" rel="stylesheet">

<div class="container" id="page_question">
    <div class="col-md-12 mb-2">   
        <a id="back-history" class="btn btn-secondary text-white" href="{{ route('assessment') }}">
            <i class="fas fa-chevron-left mr-1"></i> กลับไป
        </a>
    </div>
    <div class="card border-0">
        <div class="card-header">
            <div class="row">
                <div class="text-center col-12">
                    <h1 style="font-size: 20px;">{{ $classrooms }} {{ $numbers }}</h1>
                </div>            
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body kanin">
            <?= Form::open(array('id' => 'frmAssessment')) ?>
            <div class="row">
                @foreach($data_question as $key => $row)
                    <div class="bg-white w-full flex items-center p-2 rounded-xl shadow border mb-4">
                        <div class="flex-grow p-3">
                            <div class="kanin text-lg">
                                {{ $row->article }}. {{ $row->question }}
                                <?= Form::hidden('question_id[]', Crypt::encrypt($row->question_id),); ?>
                            </div>
                            <div class="kanin mt-2 text-base">
                                <label class="inline-flex items-center mr-6">
                                    <input type="radio" class="form-radio" name="req{{ $key }}" value="1" required>
                                    <span class="ml-2">1</span>
                                </label>
                                <label class="inline-flex items-center mr-6">
                                    <input type="radio" class="form-radio" name="req{{ $key }}" value="2" required>
                                    <span class="ml-2">2</span>
                                </label>
                                <label class="inline-flex items-center mr-6">
                                    <input type="radio" class="form-radio" name="req{{ $key }}" value="3" required>
                                    <span class="ml-2">3</span>
                                </label>
                                <label class="inline-flex items-center mr-6">
                                    <input type="radio" class="form-radio" name="req{{ $key }}" value="4" required>
                                    <span class="ml-2">4</span>
                                </label>
                                <label class="inline-flex items-center mr-6">
                                    <input type="radio" class="form-radio" name="req{{ $key }}" value="5" required>
                                    <span class="ml-2">5</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    @if($loop->last)
                        <?= Form::hidden('loopLast', Crypt::encrypt($key), ['id' => 'loopLast'],); ?>
                        <?= Form::hidden('assessment_form_id', Crypt::encrypt($assessment_form_id), ['id' => 'assessment_form_id'],); ?>
                    @endif
                @endforeach 
                <div class="bg-white w-full flex items-center p-2 rounded-xl shadow border mb-4">
                    <div class="flex-grow p-3">
                        <div class="kanin text-lg">
                            <?= Form::label('suggestion', 'ข้อเสนอแนะอื่น ๆ', ['class' => 'h5']); ?>
                        </div>
                        <div class="kanin mt-2 text-base">
                            <?= Form::text('suggestion', null, ['class' => 'form-control mb-3 bg-white', 'placeholder' => 'กรอกข้อมูลข้อเสนอแนะ', 'autocomplete'=> 'off','maxlength' =>'255','style'=> 'border-radius: 15px; border: 1px solid #ccc;']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="btnAssessment" class="btn btn-block btn-success mb-3 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline motion-safe:hover:scale-110 bg-purple-700 hover:bg-violet-500 text-white font-normal py-2 px-4 mr-1 transform hover:-translate-y-1 hover:scale-110 rounded">
                Submit
            </button>
            <?= Form::close() ?>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<div class="flex justify-center items-center">
    <img src="https://i.pinimg.com/originals/58/4b/60/584b607f5c2ff075429dc0e7b8d142ef.gif" id="loading" style="display:none;" width="150px;" />
</div>

{{-- JS --}}
<script>
    $(document).ready(function () {
        $("#frmAssessment").submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: "<span class='kanin'>ยืนยันการส่งแบบฟอร์ม</span>",
                text: "", 
                icon: "question",
                iconColor: '#28a745',
                width: 700,
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                confirmButtonText: 'ตกลง',
                cancelButtonColor: '#d33',
                cancelButtonText: 'ยกเลิก'
            })
            .then((result) => {
                if (result.isConfirmed) {  
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('assessment.store') }}",
                        data: formData,
                        cache: false, 
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function(){
                            $("#page_question").fadeOut(10);
                            $("#loading").removeAttr('style');    
                            $("#btnAssessment").css('cursor', 'not-allowed');
                            $("#btnAssessment").prop('disabled', true);
                        },
                        success: function(result) { console.log(result);
                            //afterSend
                            $("#page_question").removeAttr('style'); 
                            $("#loading").css('display', 'none');
                            $("#btnAssessment").css('cursor','default');
                            $("#btnAssessment").removeAttr('disabled'); 
                            
                            if(result == 'success'){
                                Swal.fire({
                                    title: "<span class='kanin'>ส่งข้อมูลแบบประเมิน เรียบร้อย..</span>",
                                    text: "",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500,
                                }).then(()=> {
                                    window.location.href = "{{ route('assessment') }}";
                                }); 
                            }else{
                                Swal.fire({
                                    title: "<span class='kanin'>ไม่สามารถส่งข้อมูลแบบประเมินได้<br>โปรดติดต่อผู้ดูแลระบบ..</span>",
                                    text: "", 
                                    icon: "error",
                                    iconColor: '#d33',
                                    width: 700,
                                    showCancelButton: true,
                                    confirmButtonColor: '#28a745',
                                    confirmButtonText: 'ตกลง',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: 'ยกเลิก'
                                })
                                .then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('assessment') }}";
                                    }
                                });
                            }       
                        } //close success
                    });
                }
            });
        });
    });
</script>

@endsection

@section('footer')
  <div class="mb-5"></div>
@endsection