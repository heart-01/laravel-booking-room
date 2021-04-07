@extends('layouts.dashboard')
@section('content')
<!-- TailwindCSS -->
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" type="text/css" rel="stylesheet">
<!-- Waves -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/node-waves@0.7.6/dist/waves.min.css" />

<div class="card kanin">
    <div class="card-header">
        <div class="row">
            <h1 style="font-size: 20px;"><i class="far fa-edit"></i> แบบสอบถาม</h1>
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

            @foreach($data as $key => $row)
            <div class="bg-white w-full flex items-center p-2 rounded-xl shadow border mb-4">
                <div class="flex-none w-16 h-16">
                    <button data-id="{{ $row->question_id }}" data-article="{{ $row->article }}" data-question="{{ $row->question }}" class="inline-block p-3 text-center text-black showEdit transition border bg-yellow-400 border-yellow-500 rounded-full waves hover:bg-yellow-500 focus:outline-none waves-effect">
                        <i class="far fa-edit w-6 h-2"></i>
                    </button>
                </div>
                <div class="flex-grow p-3">
                    <div class="kanin text-lg">
                        {{ $row->article }}. {{ $row->question }}
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
                    <button data-id="{{ $row->question_id }}" data-article="{{ $row->article }}" class="inline-block p-3 showDel text-center text-white transition bg-red-500 rounded-full shadow waves hover:shadow-lg hover:bg-red-600 focus:outline-none">
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            @if($loop->last)
            <?= Form::hidden('loopLast', $key, ['id' => 'loopLast'],); ?>
            @endif
            @endforeach  
        </div>
    </div>
    <!-- /.card-body -->
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
@include('site/admin/question/modal')
<!-- Other JS -->
<script src="{{ asset('js/admin/question/modal.js') }}"></script>
<script>
    var config = {
          routes: {
            question: "{{ url('/question/'.Crypt::encrypt($semesters_id).'/'.Crypt::encrypt($classrooms_id)) }}",
            question_del: "{{ route('question.del') }}",
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