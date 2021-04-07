@extends('layouts.dashboard')
@section('content')
<!-- TailwindCSS -->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" type="text/css" rel="stylesheet">
<!-- Waves -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/node-waves@0.7.6/dist/waves.min.css" />

<div class="card kanin" id="page_questionPrototype">
    <div class="card-header">
        <div class="row">
            <h1 style="font-size: 20px;"><i class="far fa-edit"></i> แบบสอบถามต้นฉบับ</h1>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body kanin">
        <div class="row">
            <div class="col-md-12">   
                <a id="back-history" class="btn btn-secondary text-white" href="{{ route('assessmentForm') }}">
                    <i class="fas fa-chevron-left mr-1"></i> กลับไป
                </a>   
                <div class="form-group row float-right">          
                    <button class="btn btn-primary waves text-white btn-sm mb-3" data-toggle="modal" data-target="#showAdd"><i class="fas fa-plus-circle"></i> เพิ่ม</button>
                </div>
            </div>
            <div class="col-12">
                <?= Form::open(array('id' => 'frmQuestionPrototype')) ?>
                @foreach($data as $key => $row)
                <div class="bg-white w-full flex items-center p-2 rounded-xl shadow border mb-4">
                    <div class="flex-none w-16 h-16">
                        <button data-id="{{ $row->question_prototype_id }}" data-article="{{ $row->article }}" data-question="{{ $row->question }}" class="inline-block p-3 text-center text-black showEdit transition border bg-yellow-400 border-yellow-500 rounded-full waves hover:bg-yellow-500 focus:outline-none waves-effect">
                            <i class="far fa-edit w-6 h-2"></i>
                        </button>
                    </div>
                    <div class="flex-grow p-3">
                        <div class="kanin text-lg">
                            {{ $row->article }}. {{ $row->question }}
                            <?= Form::hidden('article[]', Crypt::encrypt($row->article),); ?>
                            <?= Form::hidden('question[]', Crypt::encrypt($row->question),); ?>
                        </div>
                        <div class="kanin mt-2 text-base">
                            <label class="inline-flex items-center mr-6">
                                <input type="radio" class="form-radio" name="{{ $key }}" value="1">
                                <span class="ml-2">1</span>
                            </label>
                            <label class="inline-flex items-center mr-6">
                                <input type="radio" class="form-radio" name="{{ $key }}" value="2">
                                <span class="ml-2">2</span>
                            </label>
                            <label class="inline-flex items-center mr-6">
                                <input type="radio" class="form-radio" name="{{ $key }}" value="3">
                                <span class="ml-2">3</span>
                            </label>
                            <label class="inline-flex items-center mr-6">
                                <input type="radio" class="form-radio" name="{{ $key }}" value="4">
                                <span class="ml-2">4</span>
                            </label>
                            <label class="inline-flex items-center mr-6">
                                <input type="radio" class="form-radio" name="{{ $key }}" value="5">
                                <span class="ml-2">5</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex-none w-16 h-16">
                        <button data-id="{{ $row->question_prototype_id }}" data-article="{{ $row->article }}" class="inline-block p-3 showDel text-center text-white transition bg-red-500 rounded-full shadow waves hover:shadow-lg hover:bg-red-600 focus:outline-none">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                @if($loop->last)
                <?= Form::hidden('loopLast', Crypt::encrypt($key), ['id' => 'loopLast'],); ?>
                <?= Form::hidden('semesters_id', Crypt::encrypt($semesters_id), ['id' => 'semesters_id'],); ?>
                <button type="submit" id="btnQuestionPrototype" class="btn btn-block btn-success mb-3 transition duration-300 ease-in-out focus:outline-none focus:shadow-outline motion-safe:hover:scale-110 bg-purple-700 hover:bg-violet-500 text-white font-normal py-2 px-4 mr-1 transform hover:-translate-y-1 hover:scale-110 rounded">
                    ใช้แบบฟอร์มนี้กับภาคการศึกษา <?php echo App\Semesters::term_year($semesters); ?>
                </button>
                @endif
                @endforeach  
                <?= Form::close() ?>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<div class="flex justify-center items-center">
    <img src="https://i.pinimg.com/originals/58/4b/60/584b607f5c2ff075429dc0e7b8d142ef.gif" id="loading" style="display:none;" width="150px;" />
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
@endif
@include('site/admin/questionPrototype/modal')
<!-- Other JS -->
<script src="{{ asset('js/admin/questionPrototype/modal.js') }}"></script>
<script>
    var config = {
          routes: {
            questionPrototype: "{{ route('question.prototype') }}",
            questionPrototype_del: "{{ route('question.prototype.del') }}",
            questionPrototype_setQuestion: "{{ route('question.prototype.setQuestion') }}",
          }
    };
</script>
<!-- Waves -->
<script src="https://cdn.jsdelivr.net/npm/node-waves@0.7.6/dist/waves.min.js"></script>
<script type="text/javascript">
  Waves.attach('.waves')
  Waves.init()
</script>
@endsection